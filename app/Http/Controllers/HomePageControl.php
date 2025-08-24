<?php
namespace App\Http\Controllers;

use App\Models\GeneralDetail;
use App\Models\RegisterPost;
use App\Models\Slider;
use App\Models\TermsAndPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomePageControl extends Controller
{
    // Fetch all sliders for display
    public function index()
    {
        $sliders = Slider::all();
        return response()->json($sliders);
    }
    public function list()
    {
        return view('admin.sliders');
    }
    public function registerPost()
    {
        $register = RegisterPost::where('id',1)->first();
        return view('admin.register-to-post',compact('register'));
    }
    public function generalDetails()
    {
        $general = GeneralDetail::where('id',1)->first();
        return view('admin.general-details',compact('general'));
    }
    public function registerPostStore(Request $request)
    {
        try {
            // Validate request inputs
            $validated = $request->validate([
                'title' => 'required|string',
                'subtitle' => 'required|string',
                'btn' => 'required|string',
                'property_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp',
            ]);
    
            // Retrieve the existing record
            $slider = RegisterPost::find(1);
    
            if (!$slider) {
                return redirect()->back()->withErrors('Register Property Section not found.');
            }
    
            // Check if an image is uploaded and update only if it exists
            if ($request->hasFile('property_image')) {
                // Delete the old image if it exists
                if ($slider->image && file_exists(public_path('images/' . $slider->image))) {
                    unlink(public_path('images/' . $slider->image));
                }
    
                // Upload the new image
                $imageName = time() . '.' . $request->file('property_image')->extension();
                $request->file('property_image')->move(public_path('images'), $imageName);
    
                // Update the image field
                $slider->image = $imageName;
            }
    
            // Update other fields
            $slider->title = $request->title;
            $slider->subtitle = $request->subtitle;
            $slider->btn = $request->btn;
    
            // Save the changes
            $slider->save();
    
            return redirect()->back()->with('success', 'Register Property Section updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Register Property Section failed: ' . $e->getMessage());
            return redirect()->back()->withErrors('Failed to update Register Property Section. Please try again.');
        }
    }
    public function generalDetailsStore(Request $request)
    {
        // dd($request->all());
        try {
            $validated = $request->validate([
                'address' => 'required|string',
                'description' => 'required|string',
                'phone' => 'required',
                'email' => 'required',
                'facebook' => 'required|string',
                'twitter' => 'required|string',
                'linkedin' => 'required|string',
                'instagram' => 'required|string',
                'map' => 'required',
                'property_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp',
            ]);
    
            $slider = GeneralDetail::find(1);
    
            if (!$slider) {
                return redirect()->back()->withErrors(' General Information not found.');
            }
    
            if ($request->hasFile('property_image')) {
                if ($slider->image && file_exists(public_path('images/' . $slider->image))) {
                    unlink(public_path('images/' . $slider->image));
                }
                $imageName = time() . '.' . $request->file('property_image')->extension();
                $request->file('property_image')->move(public_path('images'), $imageName);
                $slider->logo = $imageName;
            }
    
            $slider->address = $request->address; 
            $slider->description = $request->description; 
            $slider->email = $request->email;
            $slider->phone = $request->phone;
            $slider->instagram = $request->instagram;
            $slider->linkedin = $request->linkedin;
            $slider->twitter = $request->twitter;
            $slider->facebook = $request->facebook;
            $slider->embaded = $request->map;
            $slider->save();
    
            return redirect()->back()->with('success', 'General Information updated successfully!');
        } catch (\Exception $e) {
dd($e->getMessage());
            \Log::error('General Information failed: ' . $e->getMessage());
            return redirect()->back()->withErrors('Failed to update General Information. Please try again.');
        }
    }
    

    public function show($id)
    {
        $slider = Slider::findOrFail($id);
        return response()->json($slider);
    }

    // Store new slider
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $slider = Slider::create([
            'image' => $imageName,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($slider);
    }

    // Update existing slider
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
    
        Log::info("Request Data: ", $request->all()); // Debug request data
        Log::info("ID: " . $id);
    
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
    
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $slider->image = $imageName;
        }
    
        $slider->title = $request->title;
        $slider->description = $request->description;
    
        $slider->save();
    
        return response()->json($slider);
    }
    

    // Delete slider
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        
        return response()->json('Slider deleted successfully');
    }
    public function termsConditions()
    {
        $terms = TermsAndPolicy::findOrFail(1); // Fetch terms using the model
        return view('admin.terms', compact('terms'));
    }

    // Display Privacy Policy
    public function privacyPolicy()
    {
        $policy = TermsAndPolicy::findOrFail(2); 
        return view('admin.policy', compact('policy'));
    }
    public function termsConditionsUpdate(Request $request)
    {
        $validated = $request->validate([
            'terms_conditions' => 'required|string',
        ]);

        try {
            TermsAndPolicy::updateOrCreate(
                ['id' => 1], // Target the specific entry
                ['content' => $validated['terms_conditions'], 'updated_at' => now()]
            );

            return redirect()->back()->with('success', 'Terms and Conditions updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Terms update failed: ' . $e->getMessage());
            return redirect()->back()->withErrors('Failed to update Terms and Conditions. Please try again.');
        }
    }

    // Update Privacy Policy
    public function privacyPolicyUpdate(Request $request)
    {
        $validated = $request->validate([
            'privacy_policy' => 'required|string',
        ]);

        try {
            TermsAndPolicy::updateOrCreate(
                ['id' => 2], // Target the specific entry
                ['content' => $validated['privacy_policy'], 'updated_at' => now()]
            );

            return redirect()->back()->with('success', 'Privacy Policy updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Privacy policy update failed: ' . $e->getMessage());
            return redirect()->back()->withErrors('Failed to update Privacy Policy. Please try again.');
        }
    }
}
<?php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ServicesControl extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services', compact('services'));
    }
    public function getServices() {
            $services = Service::all();
            return response()->json($services);
    }
    

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string', 
            'serviceIcon' => 'nullable|string', // For storing the icon string
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
            $imagePath = 'uploads/services/'.$imageName; // Store image name in the array
        }
        // Create the service
        $service = Service::create([
            'title' => $request->name,
            'description' => $request->description,
            'icon' => $request->serviceIcon, // Store the icon name
            'image' => $imagePath, // Store the image path
        ]);
    
        // Redirect back with a success message
        return redirect()->route('service.index')->with('success', 'Service created successfully!');
    }
    

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'serviceIcon' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $service = Service::findOrFail($id);
        $imagePath = $service->image;

        if ($request->hasFile('image')) {
            if ($imagePath && Storage::exists('public/' . $imagePath)) {
                Storage::delete('public/' . $imagePath);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
            $imagePath = 'uploads/services/'.$imageName;
        }
// dd($imageName);
        $service->update([
            'title' => $request->name,
            'description' => $request->description,
            'icon' => $request->serviceIcon,
            'image' => $imagePath,
        ]);

        return redirect()->route('service.index')->with('success', 'Service Updated successfully!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        // Delete image from storage
        if ($service->image && Storage::exists('public/' . $service->image)) {
            Storage::delete('public/' . $service->image);
        }

        $service->delete();
        return redirect()->route('service.index')->with('success', 'Service Deleted successfully!');
    }
}

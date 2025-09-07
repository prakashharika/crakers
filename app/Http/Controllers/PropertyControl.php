<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Buyer;
use App\Models\LandOwner;
use App\Models\Order;
use App\Models\OrderPackage;
use App\Models\PropertiesList;
use App\Models\Property;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PropertyControl extends Controller
{
    public function view()
    {
        // dd("hii");
        return view('admin.property');
    }
    public function sellerview()
    {
        return view('seller.property');
    }

    public function index()
    {

        $properties = Property::orderBy('sort_order')->get();
        return response()->json($properties);
    }
    public function sellerindex()
    {
        $properties = Property::where('status', 1)->orderBy('sort_order')->get();
        return response()->json($properties);
    }
    public function userProfile()
    {
        $user = Buyer::where('email', Auth::guard('seller')->user()->email)->first();
        return view('view.profile', compact('user'));
    }
    public function userUpdate(Request $request)
    {
        $user = Auth::guard('seller')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
        ]);

        // Alternative method using DB query
        \DB::table('buyers')
            ->where('id', $user->id)
            ->update($validated);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
    public function list($id)
    {
        $products = Product::latest()->paginate(10);
        return view('admin.properties', compact('products'));
    }
    public function ordersList()
    {
        // Get all orders with relationships
        $orders = Order::with(['product', 'buyer', 'address'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('order_id');

        return view('admin.orders', compact('orders'));
    }
    public function Advertisement()
    {

        $advertisementsWithSeller = Advertisement::with(['property', 'seller'])
            ->whereNotNull('seller_id')
            ->get();

        $advertisementsWithoutSeller = Advertisement::with('property')
            ->whereNull('seller_id')
            ->get();
        $properties = PropertiesList::whereNull('land_owner_id')->get();
        return view('admin.advertisement', compact('properties', 'advertisementsWithSeller', 'advertisementsWithoutSeller'));
    }
    public function AdvertisementStore(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties_lists,id',
            'ad_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated = [];
        $path = public_path('advertisement');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        if ($request->hasFile('ad_image')) {
            $image = $request->file('ad_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move($path, $imageName);
            $validated['ad_image'] = 'advertisement/' . $imageName;
        }

        if ($request->id) {
            $advertisement = Advertisement::findOrFail($request->id);
            $advertisement->property_id = $request->property_id;
            if (isset($validated['ad_image'])) {
                $advertisement->ad_image = $validated['ad_image'];
            }
            $advertisement->save();

            return redirect()->route('admin.advertisement')->with('success', 'Advertisement updated successfully.');
        } else {
            Advertisement::create([
                'property_id' => $request->property_id,
                'ad_image' => isset($validated['ad_image']) ? $validated['ad_image'] : null,
            ]);

            return redirect()->route('admin.advertisement')->with('success', 'Advertisement created successfully.');
        }
    }


    public function advertisementDestroy(Advertisement $advertisement)
    {
        try {
            if (file_exists(public_path($advertisement->ad_image))) {
                unlink(public_path($advertisement->ad_image));
            }
            $advertisement->delete();
            return response()->json(['success' => true, 'message' => 'Advertisement deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error occurred while deleting the advertisement.']);
        }
    }

    public function sellerAdvertisement()
    {
        $user = Auth::guard('seller')->user();
        $properties = LandOwner::where('id', $user->id)
            ->with('PropertiesList')
            ->first();
        $advertisement = Advertisement::where('seller_id', $user->id)->first();
        return view('seller.advertisement', compact('properties', 'advertisement'));
    }
    public function sellerAdvertisementStore(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties_lists,id',
            'ad_image' => 'required|image|max:2048',
        ]);

        $sellerId = Auth::guard('seller')->id();

        $path = public_path('advertisement');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $validated = [];

        if ($request->hasFile('ad_image')) {
            $image = $request->file('ad_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move($path, $imageName);
            $validated['image'] = 'advertisement/' . $imageName;
        }

        $advertisement = Advertisement::where('seller_id', $sellerId)->first();

        if ($advertisement) {
            $advertisement->update([
                'property_id' => $request->property_id,
                'ad_image' => $validated['image'] ?? $advertisement->ad_image, // Keep the old image if no new image
            ]);

            $message = 'Advertisement updated successfully.';
        } else {
            Advertisement::create([
                'property_id' => $request->property_id,
                'ad_image' => $validated['image'],
                'seller_id' => $sellerId,
            ]);

            $message = 'Advertisement added successfully.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function sellerlist($id)
    {
        $user = Auth::guard('seller')->user();
        // dd($user);
        $property = Property::where('id', $id)->first();
        $properties = LandOwner::where('id', $user->id)
            ->whereHas('PropertiesList', function ($query) use ($id) {
                $query->where('property_id', $id);
            })
            ->with('PropertiesList')
            ->first();
        // foreach($properties->PropertiesList as $pro){
        //     dump($pro->title);    
        // }
        // die();
        if (empty($property)) {
            return redirect()->back();
        }
        $package = OrderPackage::where('land_owner_id', $user->id)
            ->where('payment_status', 'success')
            ->where('status', 'active')
            ->first();

        if (!isset($package) || $package == null) {
            return redirect()->back()->with('error', 'You do not have an active plan to access this feature. Please upgrade your package.');
        }
        if ($package->LandOwner->PropertiesList->count() >= $package->no_property) {
            return redirect()->back()->with('error', 'Your current plan has reached the maximum property upload limit. Please upgrade your package for additional uploads.');
        }
        // dd($package);
        return view('seller.properties', compact('properties', 'property', 'package'));
    }
    public function myPackages()
    {
        $user = Auth::guard('seller')->user();
        $packages = OrderPackage::where('land_owner_id', $user->id)
            ->orderByDesc('created_at')
            // ->where('payment_status', 'success')
            // ->where('status', 'active')
            ->get();

        return view('seller.my-pakages', compact('packages'));
    }
    public function sellerpropertyadd($id)
    {
        $property = Property::where('id', $id)->first();
        $user = Auth::guard('seller')->user();
        $package = OrderPackage::where('land_owner_id', $user->id)
            ->where('payment_status', 'success')
            ->where('status', 'active')
            ->first();

        if (empty($property)) {
            return redirect()->back();
        }
        if (!isset($package) || $package == null) {
            return redirect()->back()->with('error', 'You do not have an active plan to access this feature. Please upgrade your package.');
        }

        if ($package->LandOwner->PropertiesList->count() >= $package->no_property) {
            return redirect()->back()->with('error', 'Your current plan has reached the maximum property upload limit. Please upgrade your package for additional uploads.');
        }


        return view('seller.properties-add', compact('property', 'package'));
    }
    public function add($id)
    {
        $property = Property::where('id', $id)->first();

        if (empty($property)) {
            return redirect()->back();
        }
        return view('admin.properties-add', compact('property'));
    }
    public function propertyStore(Request $request)
    {
        // dd($request->all());
        try {
            $validatedData = $request->validate([
                'propertyId' => 'required',
                'title' => 'required|string|max:255',
                'area' => 'required|string',
                'configuration' => 'required|string|max:255',
                'price' => 'required',
                'price_text' => 'required|string',
                'address' => 'required|string',
                'location' => 'required|string',
                'total_floors' => 'required|string',
                'facing' => 'required|string|max:255',
                'property_age' => 'required|string',
                'near_by_places' => 'required|string',
                // 'status' => 'required|boolean',
                'about_property' => 'required|string',
                'features' => 'required|string',
                'future_property' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $images = [];
        $videos = [];

        for ($i = 1; $i <= 7; $i++) {
            if ($request->hasFile('image' . $i)) {
                $image = $request->file('image' . $i);
                $imageName = time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/properties/images'), $imageName);
                $images[] = $imageName;
            }
        }
        for ($i = 1; $i <= 2; $i++) {
            if ($request->input('video_option' . $i) == 'upload' && $request->hasFile('video_file' . $i)) {
                $video = $request->file('video_file' . $i);
                $videoName = time() . '_video_' . $i . '.' . $video->getClientOriginalExtension();
                $video->move(public_path('uploads/properties/videos'), $videoName);
                $videos[] = $videoName;
            } elseif ($request->input('video_option' . $i) == 'link' && $request->input('video_link' . $i)) {
                $videos[] = $request->input('video_link' . $i);
            }
        }

        $property = new PropertiesList();
        $property->property_id = $request->propertyId;
        $property->title = $request->title;
        $property->area = $request->area;
        $property->configuration = $request->configuration;
        $property->price = $request->price;
        $property->price_text = $request->price_text;
        $property->address = $request->address;
        $property->location = $request->location;
        $property->total_floors = $request->total_floors;
        $property->facing = $request->facing;
        $property->property_age = $request->property_age;
        $property->near_by_places = $request->near_by_places;
        $property->status = '1';
        $property->about_property = $request->about_property;
        $property->features = $request->features;
        $property->images = json_encode($images);
        $property->videos = json_encode($videos);

        $property->save();

        return redirect()->route('property-list', ['id' => $request->propertyId])->with('success', 'Property created successfully!');
    }

    public function propertyEdit($id)
    {
        $property = PropertiesList::findOrFail($id);
        return view('admin.properties-edit', compact('property'));
    }
    public function propertyStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:properties_lists,id',
            'status' => 'required|integer|in:0,1',
        ]);
        $property = PropertiesList::find($validated['id']);
        $property->status = $validated['status'];
        $property->save();
        return response()->json(['message' => 'Status updated successfully.']);
    }
    public function propertySellerEdit($id)
    {
        $property = PropertiesList::findOrFail($id);
        $user = Auth::guard('seller')->user();
        $package = OrderPackage::where('land_owner_id', $user->id)
            ->where('payment_status', 'success')
            ->where('status', 'active')
            ->first();

        if (empty($property)) {
            return redirect()->back();
        }
        if (!isset($package) || $package == null) {
            return redirect()->back()->with('error', 'You do not have an active plan to access this feature. Please upgrade your package.');
        }
        return view('seller.properties-edit', compact('property', 'package'));
    }

    public function propertyView($id)
    {
        $property = PropertiesList::findOrFail($id);
        return view('admin.properties-view', compact('property'));
    }
    public function propertySellerView($id)
    {
        $property = PropertiesList::findOrFail($id);
        return view('seller.properties-view', compact('property'));
    }

    public function propertySellerStore(Request $request)
    {
        // dd($request->all());
        try {
            $validatedData = $request->validate([
                'propertyId' => 'required',
                'title' => 'required|string|max:255',
                'area' => 'required|string',
                'configuration' => 'required|string|max:255',
                'price' => 'required',
                'price_text' => 'required|string',
                'address' => 'required|string',
                'location' => 'required|string',
                'total_floors' => 'required|string',
                'facing' => 'required|string|max:255',
                'property_age' => 'required|string',
                'near_by_places' => 'required|string',
                'about_property' => 'required|string',
                'features' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $id = $request->propertyId;
        $property = Property::where('id', $id)->first();
        $user = Auth::guard('seller')->user();
        $package = OrderPackage::where('land_owner_id', $user->id)
            ->where('payment_status', 'success')
            ->where('status', 'active')
            ->first();

        if (empty($property)) {
            return redirect()->back();
        }
        if (!isset($package) || $package == null) {
            return redirect()->back()->with('error', 'You do not have an active plan to access this feature. Please upgrade your package.');
        }

        if ($package->LandOwner->PropertiesList->count() >= $package->no_property) {
            return redirect()->back()->with('error', 'Your current plan has reached the maximum property upload limit. Please upgrade your package for additional uploads.');
        }
        $property = new PropertiesList;

        $images = [];
        $videos = [];

        for ($i = 1; $i <= $package->upto_images; $i++) {
            if ($request->hasFile('image' . $i)) {
                $image = $request->file('image' . $i);
                $imageName = time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/properties/images'), $imageName);
                $images[] = $imageName;
            }
        }
        if (isset($package->upto_videos) && $package->upto_videos != 0 && $package->upto_videos != null) {
            for ($i = 1; $i <= $package->upto_videos; $i++) {
                if ($request->input('video_option' . $i) == 'upload' && $request->hasFile('video_file' . $i)) {
                    $video = $request->file('video_file' . $i);
                    $videoName = time() . '_video_' . $i . '.' . $video->getClientOriginalExtension();
                    $video->move(public_path('uploads/properties/videos'), $videoName);
                    $videos[] = $videoName;
                } elseif ($request->input('video_option' . $i) == 'link' && $request->input('video_link' . $i)) {
                    $videos[] = $request->input('video_link' . $i);
                }
            }
        }
        $property->property_id = $request->propertyId;
        $property->title = $request->title;
        $property->area = $request->area;
        $property->configuration = $request->configuration;
        $property->price = $request->price;
        $property->price_text = $request->price_text;
        $property->address = $request->address;
        $property->location = $request->location;
        $property->total_floors = $request->total_floors;
        $property->facing = $request->facing;
        $property->property_age = $request->property_age;
        $property->near_by_places = $request->near_by_places;
        $property->status = '1';
        $property->about_property = $request->about_property;
        $property->features = $request->features;
        $property->land_owner_id = $user->id;

        $property->images = json_encode($images);
        $property->videos = json_encode($videos);
        // $property->image2 = isset($images[1]) ? $images[1] : $property->image2;
        // $property->image3 = isset($images[2]) ? $images[2] : $property->image3;
        // $property->image4 = isset($images[3]) ? $images[3] : $property->image4;
        // $property->image5 = isset($images[4]) ? $images[4] : $property->image5;
        // $property->image6 = isset($images[5]) ? $images[5] : $property->image6;
        // $property->image7 = isset($images[6]) ? $images[6] : $property->image7;

        // $property->video1 = isset($videos[0]) ? $videos[0] : $property->video1;
        // $property->video2 = isset($videos[1]) ? $videos[1] : $property->video2;

        $property->save();

        return redirect()->route('property-seller-list', ['id' => $property->property_id])->with('success', 'Property deleted successfully!');
    }

    public function propertyFutureStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:properties_lists,id',
            'status' => 'required|integer|in:0,1',
        ]);

        $property = PropertiesList::findOrFail($validated['id']);

        if ($validated['status'] == 0) {
            $property->future_property = 0;
            $property->save();

            return response()->json([
                'success' => true,
                'message' => 'Property Removed Future Property List successfully.',
                'property' => $property,
            ]);
        }

        $property->future_property = 1;
        $property->save();

        return response()->json([
            'success' => true,
            'message' => 'Property Added Future Property List successfully.',
            'property' => $property,
        ]);
    }

    public function propertySellerFutureUpdate(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:properties_lists,id',
            'status' => 'required|integer|in:0,1',
        ]);

        $user = Auth::guard('seller')->user();
        $package = OrderPackage::where('land_owner_id', $user->id)
            ->where('payment_status', 'success')
            ->where('status', 'active')
            ->first();
        $property = PropertiesList::findOrFail($validated['id']);
        if (!$package) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have an active plan to access this feature. Please upgrade your package.',
            ], 403);
        }

        $propertyCount = $package->LandOwner->PropertiesList->count();
        if ($propertyCount >= $package->no_property) {
            return response()->json([
                'success' => false,
                'message' => 'Your current plan has reached the maximum property upload limit. Please upgrade your package for additional uploads.',
            ], 403);
        }
        if ($validated['status'] == 0) {
            $property->future_property = 0;
            $property->save();

            return response()->json([
                'success' => true,
                'message' => 'Property Removed Future Property List successfully.',
                'property' => $property,
            ]);
        }


        $futureListingLimit = $package->future_listing ?? 0;
        $currentFutureListingCount = PropertiesList::where('land_owner_id', $user->id)
            ->where('future_property', 1)
            ->count();

        if ($futureListingLimit < 0 || $currentFutureListingCount >= $futureListingLimit) {
            return response()->json([
                'success' => false,
                'message' => 'You have reached the maximum limit for future property listings under your current plan.',
            ], 403);
        }

        $property->future_property = 1;
        $property->save();

        return response()->json([
            'success' => true,
            'message' => 'Property Added Future Property List successfully.',
            'property' => $property,
        ]);
    }

    public function propertyUpdate(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'propertyId' => 'required',
                'title' => 'required|string|max:255',
                'area' => 'required|string',
                'configuration' => 'required|string|max:255',
                'price' => 'required',
                'price_text' => 'required|string',
                'address' => 'required|string',
                'location' => 'required|string',
                'total_floors' => 'required|string',
                'facing' => 'required|string|max:255',
                'property_age' => 'required|string',
                'near_by_places' => 'required|string',
                // 'status' => 'required|boolean',
                'about_property' => 'required|string',
                'features' => 'required|string',
                'future_property' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Retrieve the property
        $property = PropertiesList::findOrFail($id);
        if (empty($property)) {
            return redirect()->back();
        }

        $images = json_decode($property->images, true) ?? [];

        for ($i = 1; $i <= 7; $i++) {
            if ($request->hasFile('image' . $i)) {
                $image = $request->file('image' . $i);
                $imageName = time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/properties/images'), $imageName);
                $images[$i - 1] = $imageName;
            }
        }

        $videos = [];

        for ($i = 1; $i <= 2; $i++) {
            if ($request->input('video_option' . $i) == 'upload' && $request->hasFile('video_file' . $i)) {
                $video = $request->file('video_file' . $i);
                $videoName = time() . '_video_' . $i . '.' . $video->getClientOriginalExtension();
                $video->move(public_path('uploads/properties/videos'), $videoName);
                $videos[$i - 1] = $videoName; // Store uploaded video
            } elseif ($request->input('video_option' . $i) == 'link' && $request->input('video_link' . $i)) {
                $videos[$i - 1] = $request->input('video_link' . $i); // Store the YouTube link
            }
        }


        $property->title = $request->title;
        $property->area = $request->area;
        $property->configuration = $request->configuration;
        $property->price = $request->price;
        $property->price_text = $request->price_text;
        $property->address = $request->address;
        $property->location = $request->location;
        $property->total_floors = $request->total_floors;
        $property->facing = $request->facing;
        $property->property_age = $request->property_age;
        $property->near_by_places = $request->near_by_places;
        $property->status = '1';
        $property->future_property = $request->future_property;
        $property->about_property = $request->about_property;
        $property->features = $request->features;
        $property->images = json_encode($images);
        $property->videos = json_encode($videos);

        $property->save();

        return redirect()->route('property-list', ['id' => $property->property_id])->with('success', 'Property deleted successfully!');
    }

    public function propertySellerUpdate(Request $request, $id)
    {
        // dd($request->all());
        try {
            $validatedData = $request->validate([
                'propertyId' => 'required',
                'title' => 'required|string|max:255',
                'area' => 'required|string',
                'configuration' => 'required|string|max:255',
                'price' => 'required',
                'price_text' => 'required|string',
                'address' => 'required|string',
                'location' => 'required|string',
                'total_floors' => 'required|string',
                'facing' => 'required|string|max:255',
                'property_age' => 'required|string',
                'near_by_places' => 'required|string',
                'about_property' => 'required|string',
                'features' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $property = PropertiesList::findOrFail($id);
        $user = Auth::guard('seller')->user();
        $package = OrderPackage::where('land_owner_id', $user->id)
            ->where('payment_status', 'success')
            ->where('status', 'active')
            ->first();

        if (empty($property)) {
            return redirect()->back();
        }

        $images = json_decode($property->images, true) ?? [];

        for ($i = 1; $i <= $package->upto_images; $i++) {
            if ($request->hasFile('image' . $i)) {
                $image = $request->file('image' . $i);
                $imageName = time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/properties/images'), $imageName);
                $images[$i - 1] = $imageName;
            }
        }

        $videos = [];

        if (isset($package->upto_videos) && $package->upto_videos != 0 && $package->upto_videos != null) {
            for ($i = 1; $i <= $package->upto_videos; $i++) {
                if ($request->input('video_option' . $i) == 'upload' && $request->hasFile('video_file' . $i)) {
                    $video = $request->file('video_file' . $i);
                    $videoName = time() . '_video_' . $i . '.' . $video->getClientOriginalExtension();
                    $video->move(public_path('uploads/properties/videos'), $videoName);
                    $videos[$i - 1] = $videoName; // Store uploaded video
                } elseif ($request->input('video_option' . $i) == 'link' && $request->input('video_link' . $i)) {
                    $videos[$i - 1] = $request->input('video_link' . $i); // Store the YouTube link
                }
            }
        }

        $property->title = $request->title;
        $property->area = $request->area;
        $property->configuration = $request->configuration;
        $property->price = $request->price;
        $property->price_text = $request->price_text;
        $property->address = $request->address;
        $property->location = $request->location;
        $property->total_floors = $request->total_floors;
        $property->facing = $request->facing;
        $property->property_age = $request->property_age;
        $property->near_by_places = $request->near_by_places;
        $property->status = '1';
        $property->about_property = $request->about_property;
        $property->features = $request->features;

        $property->images = json_encode($images);
        $property->videos = json_encode($videos);

        $property->save();

        return redirect()->route('property-seller-list', ['id' => $property->property_id])
            ->with('success', 'Property updated successfully!');
    }

    public function propertyDelete($id)
    {
        $property = PropertiesList::findOrFail($id);

        $property->delete();

        return redirect()->route('property-list', ['id' => $property->property_id])->with('success', 'Property deleted successfully!');
    }
    public function propertySellerDelete($id)
    {
        $property = PropertiesList::findOrFail($id);
        $property->delete();
        return redirect()->route('property-seller-list', ['id' => $property->property_id])->with('success', 'Property deleted successfully!');
    }


    public function show($id)
    {
        $property = Property::findOrFail($id);
        return response()->json($property);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tamil_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer',
            'status' => 'required|integer|in:0,1',
        ]);

        // Generate the slug from the name
        $validated['slug'] = Str::slug($validated['name']);

        // Handle image upload
        $path = public_path('properties');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move($path, $imageName);
            $validated['image'] = 'properties/' . $imageName;
        }

        $property = Property::create($validated);

        return response()->json($property);
    }



    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        $totalPropertiesCount = Property::count();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'tamil_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer|lte:' . $totalPropertiesCount,
            'status' => 'required|integer|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        // ✅ Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);

        // ✅ Handle image upload
        $path = public_path('properties');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move($path, $imageName);
            $validated['image'] = 'properties/' . $imageName;
        }

        $property->update($validated);

        return response()->json($property);
    }



    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return response()->json(['message' => 'Property deleted successfully']);
    }
}

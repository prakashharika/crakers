<?php


// app/Http/Controllers/PackageController.php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    public function index()
    {
        $package1 = Package::find(1); 
        $package2 = Package::find(2); 
        $package3 = Package::find(3); 
        return view('admin.packages.index',compact('package1','package2','package3'));
    }

    public function edit($id)
    {

        // Retrieve the specific package (Basic, Professional, or Premium)
        $package = Package::findOrFail($id);

        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'price' => 'required|numeric',
            // 'price_type' => 'required|in:month,year',
            'no_property_listing' => 'nullable|string',
            'property_visibility_days' => 'nullable|string',
            'upto_images' => 'nullable|string',
            'future_listing_days' => 'nullable|string',
            'upto_video' => 'nullable|string',
            'button_title' => 'nullable|string',
        ]);
    
        $package = Package::findOrFail($request->package_id);
    
        // Update fields with text-value pairs
        $package->no_property_listing = $request->no_property_listing;
        $package->property_visibility_days = $request->property_visibility_days;
        $package->upto_images = $request->upto_images;
        $package->future_listing_days = $request->future_listing_days;
        $package->upto_video = $request->upto_video;
        $package->extra_features = array_filter(array_map('trim', explode("\n", $request->extra_features[0])));
        $package->not_included = array_filter(array_map('trim', explode("\n", $request->not_included[0])));
    
    
        // Update other fields
        $package->title = $request->title;
        $package->content = $request->content;
        $package->price = $request->price;
        // $package->price_type = $request->price_type;
        $package->button_title = $request->button_title;
        $package->save();
    
        return redirect()->route('packages.index', ['id' => $package->id])->with('success', 'Package updated successfully');
    }
    
}

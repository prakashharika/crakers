<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
{
    $products = Product::latest()->paginate(10); 
   return view('admin.properties', compact('products'));

}
    public function create()
    {
        return view('admin.properties-add'); 
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'tamil_name' => 'nullable|string|max:255',
        'base_price' => 'required|numeric|min:0',
        'selling_price' => 'required|numeric|min:0',
        'packet_or_box' => 'required|in:packet,box',
        'quantity' => 'required|integer|min:0',
        'description' => 'required|string',
        'items' => 'required|string',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    // Auto-generate slug from name
    $slug = Str::slug($request->name);
    $originalSlug = $slug;
    $counter = 1;
    while (\App\Models\Product::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $counter++;
    }

    // Handle image upload
    $imagePaths = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $filename);
            $imagePaths[] = 'uploads/' . $filename;
        }
    }

    // Save product
    $product = Product::create([
        'name' => $request->name,
        'tamil_name' => $request->tamil_name,
        'base_price' => $request->base_price,
        'selling_price' => $request->selling_price,
        'packet_or_box' => $request->packet_or_box,
        'quantity' => $request->quantity,
        'description' => $request->description,
        'slug' => $slug,
        'items' => $request->items,
        'images' => $imagePaths,
    ]);

    return redirect()->route('property-list', ['id' => $product->id])->with('success', 'Product created successfully!');
}



    public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('admin.properties-edit', compact('product'));
}


 public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'tamil_name' => 'nullable|string|max:255',
        'base_price' => 'required|numeric|min:0',
        'selling_price' => 'required|numeric|min:0',
        'packet_or_box' => 'required|in:packet,box',
        'quantity' => 'required|integer|min:0',
        'description' => 'required|string',
        'items' => 'required|string|max:255',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

   
    $slug = Str::slug($request->name);
    $originalSlug = $slug;
    $counter = 1;

    while (
        \App\Models\Product::where('slug', $slug)
            ->where('id', '!=', $product->id)
            ->exists()
    ) {
        $slug = $originalSlug . '-' . $counter++;
    }

    // Update fields
    $product->name = $validated['name'];
    $product->tamil_name = $validated['tamil_name'];
    $product->base_price = $validated['base_price'];
    $product->selling_price = $validated['selling_price'];
    $product->packet_or_box = $validated['packet_or_box'];
    $product->quantity = $validated['quantity'];
    $product->description = $validated['description'];
    $product->slug = $slug;
    $product->items = $validated['items'];

    // Merge new images with existing
    $existingImages = is_array($product->images) ? $product->images : json_decode($product->images, true) ?? [];

    if ($request->hasFile('images')) {
        $newImagePaths = [];

        foreach ($request->file('images') as $image) {
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $filename);
            $newImagePaths[] = 'uploads/' . $filename;
        }

        $allImages = array_merge($existingImages, $newImagePaths);
        $product->images = $allImages;
    }

    $product->save();

    return redirect()->route('property-list', ['id' => $product->id])
        ->with('success', 'Product updated successfully.');
}



public function destroy($id)
{
    $product = Product::findOrFail($id);

  
    if (is_array($product->images)) {
        foreach ($product->images as $imagePath) {
            $fullPath = public_path($imagePath);
            if (file_exists($fullPath)) {
                @unlink($fullPath); 
            }
        }
    } else {
       
        $images = json_decode($product->images, true);
        if (is_array($images)) {
            foreach ($images as $imagePath) {
                $fullPath = public_path($imagePath);
                if (file_exists($fullPath)) {
                    @unlink($fullPath);
                }
            }
        }
    }

    $product->delete();

     return redirect()->route('property-list', ['id' => $product->id])->with('success', 'Product deleted successfully.');
}

}

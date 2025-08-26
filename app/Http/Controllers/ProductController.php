<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Support\Str;

class ProductController extends Controller
{

public function index(Request $request, $categoryId = null)
{
    $query = Product::with('category')->latest();

    if ($categoryId) {
        $query->where('category_id', $categoryId);
    }

    $products = $query->paginate(10);

    return view('admin.properties', compact('products', 'categoryId'));
}


    public function create(Request $request)
    {
        return view('admin.properties-add', ['category_id' => $request->id]); 
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'tamil_name' => 'nullable|string|max:255',
        'category_id' => 'required|exists:properties,id',
        'base_price' => 'required|numeric|min:0',
        'selling_price' => 'required|numeric|min:0',
        'packet_or_box' => 'required|in:packet,box',
        'quantity' => 'required|integer|min:0',
        'description' => 'required|string',
        'items' => 'required|string',
        'images' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $slug = Str::slug($request->name);
    $originalSlug = $slug;
    $counter = 1;
    while (\App\Models\Product::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $counter++;
    }

if ($request->hasFile('images')) {
    $image = $request->file('images'); // ← This is what you're missing
    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('uploads'), $filename);
    $imagePaths = 'uploads/' . $filename;
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
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('property-list', ['id' => $product->category_id])->with('success', 'Product created successfully!');
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


    if ($request->hasFile('images')) {
        if ($product->images) {
            $oldImagePath = public_path($product->images);
            if (file_exists($oldImagePath)) {
                @unlink($oldImagePath);
            }
        }

        $image = $request->file('images');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $filename);
        $product->images = 'uploads/' . $filename;
    }

    $product->save();

    return redirect()->route('property-list', ['id' => $product->category_id])
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


 public function productAll()
    {
        $products = Product::with('category')->latest()->paginate(10);
        $categories = Property::where('status', 1)->orderBy('sort_order', 'asc')->get();

        return view('admin.properties', compact('products', 'categories'));
    }

    public function categoryProduct($slug)
    {
        $category = Property::where('slug', $slug)->firstOrFail();

        $products = Product::where('category_id', $category->id)
                           ->with('category')
                           ->latest()
                           ->paginate(10);

        $categories = Property::where('status', 1)->orderBy('sort_order', 'asc')->get();

        return view('admin.properties', compact('products', 'categories', 'category'));
    }

}

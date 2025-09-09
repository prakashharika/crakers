<?php

namespace App\Http\Controllers;

use App\Models\BestSellerProduct;
use App\Models\FeaturedProduct;
use App\Models\OnSaleProduct;
use Illuminate\Http\Request;
use App\Models\VoucherProduct;
use App\Models\Property;
use App\Models\Product;

class VoucherController extends Controller
{
    public function index()
    {
        $categories = Property::with('products')->get();
        $selectedProducts = VoucherProduct::with('product')->get();

        return view('section.voucher', compact('categories', 'selectedProducts'));
    }
    public function getCategories()
    {
        return Property::all();
    }
    public function getProductsByCategory($categoryId)
    {
        return Product::where('category_id', $categoryId)->get();
    }

    public function storeProducts(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        // Clear existing selections
        VoucherProduct::truncate();
        $uniqueProductIds = array_unique($request->product_ids);
        // Store new selections
        foreach ($uniqueProductIds as $productId) {
            VoucherProduct::create(['product_id' => $productId]);
        }

        return redirect()->route('voucher.section')
            ->with('success', 'Products saved successfully!');
    }
    public function index1()
    {
        $categories = Property::with('products')->get();
        $selectedProducts = OnSaleProduct::with('product')->get();

        return view('section.on-sale', compact('categories', 'selectedProducts'));
    }

    public function storeProducts1(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        // Clear existing selections
        OnSaleProduct::truncate();
        $uniqueProductIds = array_unique($request->product_ids);
        // Store new selections
        foreach ($uniqueProductIds as $productId) {
            OnSaleProduct::create(['product_id' => $productId]);
        }

        return redirect()->route('on-sale.section')
            ->with('success', 'On-sale products saved successfully!');
    }
    public function index2()
    {
        $categories = Property::with('products')->get();
        $selectedProducts = BestSellerProduct::with('product')->get();
        return view('section.best-sellers', compact('categories', 'selectedProducts'));
    }

    public function storeProducts2(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        // Clear existing selections
        BestSellerProduct::truncate();
        $uniqueProductIds = array_unique($request->product_ids);
        // Store new selections
        foreach ($uniqueProductIds as $productId) {
            BestSellerProduct::create(['product_id' => $productId]);
        }

        return redirect()->route('best-sellers.section')
            ->with('success', 'Best seller products saved successfully!');
    }
    public function index3()
    {
        $categories = Property::with('products')->get();
        $selectedProducts = FeaturedProduct::with('product')->get();

        return view('section.featured-products', compact('categories', 'selectedProducts'));
    }

    public function storeProducts3(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        // Clear existing selections
        FeaturedProduct::truncate();
        $uniqueProductIds = array_unique($request->product_ids);
        // Store new selections
        foreach ($uniqueProductIds as $productId) {
            FeaturedProduct::create(['product_id' => $productId]);
        }

        return redirect()->route('featured-products.section')
            ->with('success', 'Featured products saved successfully!');
    }
}
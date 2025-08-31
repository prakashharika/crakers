<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function viewCart()
{
    $cart = session()->get('cart', []);
    $cartTotal = $this->calculateCartTotal($cart);
    
    return view('cart.view', [
        'cart' => $cart,
        'cartTotal' => $cartTotal,
        'cartCount' => count($cart)
    ]);
}

public function addToCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'sometimes|integer|min:1'
    ]);

    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1);
    
    // Get the product
    $product = Product::findOrFail($productId);
    
    // Get current cart from session
    $cart = session()->get('cart', []);
    
    // Check if product already exists in cart
    if(isset($cart[$productId])) {
        $cart[$productId]['quantity'] += $quantity;
    } else {
        $cart[$productId] = [
            "name" => $product->name,
            "quantity" => $quantity,
            "price" => $product->selling_price,
            "image" => $product->images,
            "category" => $product->category->name
        ];
    }
    
    // Save cart to session
    session()->put('cart', $cart);
    
    // Return response with cart info
    return response()->json([
        'success' => true,
        'message' => 'Product added to cart successfully!',
        'cart_count' => count($cart),
        'cart_total' => $this->calculateCartTotal($cart)
    ]);
}

private function calculateCartTotal($cart)
{
    $total = 0;
    foreach($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}
// In CartController.php - getCartContent method
public function getCartContent()
{
    $cart = session()->get('cart', []);
    $html = '';
    
    if (empty($cart)) {
        $html = '<div class="box-text_empty type-shop_cart">
                    <div class="empty_top">
                        <span class="icon">
                            <i class="icon-shopping-cart-simple"></i>
                        </span>
                        <h3 class="text-emp fw-normal">Your cart is empty</h3>
                        <p class="h6 text-main">
                            Your cart is currently empty. Let us assist you in finding the right product
                        </p>
                    </div>
                    <div class="empty_bot">
                        <a href="javascript:void(0)" class="tf-btn animate-btn">Shopping</a>
                        <a href="javascript:void(0)" class="tf-btn style-line">Back to home</a>
                    </div>
                </div>';
    } else {
        foreach ($cart as $id => $item) {
            $html .= '<div class="tf-mini-cart-item file-delete">
                        <div class="tf-mini-cart-image">
                            <img class="lazyload" data-src="'.asset($item['image']).'"
                                src="'.asset($item['image']).'" alt="'.$item['name'].'">
                        </div>
                        <div class="tf-mini-cart-info">
                            <div class="text-small text-main-2 sub">'.$item['category'].'</div>
                            <h6 class="title">
                                <a href="javascript:void(0)" class="link text-line-clamp-1">'.$item['name'].'</a>
                            </h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="h6 fw-semibold">
                                    <span class="number">'.$item['quantity'].'x</span>
                                    <span class="price text-primary tf-mini-card-price">₹'.number_format($item['price'], 2).'</span>
                                </div>
                                <i class="icon link icon-close remove" data-product-id="'.$id.'"></i>
                            </div>
                        </div>
                    </div>';
        }
    }
    
    return response()->json([
        'success' => true,
        'html' => $html,
        'count' => count($cart),
        'total' => $this->calculateCartTotal($cart)
    ]);
}
// In CartController.php
public function removeFromCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id'
    ]);

    $productId = $request->input('product_id');
    
    // Get current cart from session
    $cart = session()->get('cart', []);
    
    // Check if product exists in cart
    if(isset($cart[$productId])) {
        // Remove the product from cart
        unset($cart[$productId]);
        
        // Save updated cart to session
        session()->put('cart', $cart);
        
        // Return response with cart info
        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart successfully!',
            'cart_count' => count($cart),
            'cart_total' => $this->calculateCartTotal($cart)
        ]);
    }
    
    return response()->json([
        'success' => false,
        'message' => 'Product not found in cart'
    ], 404);
}
public function updateCart(Request $request)
{
    try {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        
        $cart = session()->get('cart', []);
        
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            
            session()->put('cart', $cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully!',
                'cart_count' => count($cart),
                'cart_total' => $this->calculateCartTotal($cart)
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Product not found in cart'
        ], 404);
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Server error: ' . $e->getMessage()
        ], 500);
    }
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\Order;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page
     */
    public function show()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect('/')->with('error', 'Your cart is empty.');
        }

        return view('checkout', [
            'cart' => $cart,
            'cartTotal' => $this->calculateCartTotal($cart),
        ]);
    }

    /**
     * Handle placing the order
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:1000',
            'pincode' => 'required|string|max:10',
        ]);

        $buyer = Auth::guard('seller')->user();

        if (!$buyer) {
            return redirect()->route('login')->with('error', 'Please login to place your order.');
        }

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }
        // dd($buyer->id);
        // 1. Save the address
        $address = Address::create([
            'buyer_id' => $buyer->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'pincode' => $request->pincode,
        ]);

        // 2. Generate unique order ID
        $orderId = 'ORD-' . now()->format('YmdHis') . '-' . rand(1000, 9999);

        // 3. Store each product in the order
        foreach ($cart as $productId => $item) {
            Order::create([
                'order_id' => $orderId,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'payment_status' => 'pending', // or 'paid'
                'buyer_id' => $buyer->id,
                'address_id' => $address->id,
            ]);
        }

        // 4. Clear the cart
        session()->forget('cart');

        // 5. Redirect with success message
        return redirect('/')->with('success', 'Order placed successfully!');
    }


    /**
     * Calculate total cart amount
     */
    protected function calculateCartTotal($cart)
    {
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showPaymentPage()
    {
        $orderSummary = session('order_summary');

        if (!$orderSummary) {
            return redirect()->route('home')->with('error', 'No order found for payment.');
        }

        return view('payment.payment-page', compact('orderSummary'));
    }

    public function processPayment(Request $request)
    {
        // Handle payment processing logic here
        // This could integrate with payment gateways like Razorpay, PayPal, etc.

        $orderSummary = session('order_summary');

        // Update order status to paid
        // Order::where('order_id', $orderSummary['order_id'])->update(['payment_status' => 'paid']);

        // Clear order summary from session
        session()->forget('order_summary');

        return redirect()->route('order.success')->with('success', 'Payment successful!');
    }
    public function orderSuccess()
    {
        $orderSummary = session('order_summary');

        if (!$orderSummary) {
            return redirect()->route('home');
        }

        return view('payment.order-success', compact('orderSummary'));
    }
}
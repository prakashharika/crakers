@extends('layouts.main')

@section('content')
    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="text-center">
                <div class="icon-success mb-4">
                    <i class="ri-checkbox-circle-fill" style="font-size: 80px; color: #28a745;"></i>
                </div>
                
                <h2 class="main-title mb-3">Payment Successful!</h2>
                <p class="text-muted mb-4">Thank you for your order. Your payment has been processed successfully.</p>
                
                <div class="card mx-auto" style="max-width: 400px;">
                    <div class="card-body">
                        <h5 class="card-title">Order Details</h5>
                        <p class="card-text">
                            Order ID: <strong>{{ $orderSummary['order_id'] }}</strong><br>
                            Amount Paid: <strong>₹{{ number_format($orderSummary['charges']['grand_total'], 2) }}</strong><br>
                            Status: <span class="badge bg-success">Paid</span>
                        </p>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="ri-home-line"></i> Continue Shopping
                    </a>
                    <a href="{{ route('orders') }}" class="btn btn-outline-primary">
                        <i class="ri-list-check"></i> View Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
    
      @endsection
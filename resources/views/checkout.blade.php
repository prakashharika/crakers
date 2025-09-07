@extends('layouts.main')

@section('content')

    <style>
        .cart-page {
            padding: 40px 0;
        }
        .cart-item {
            border-bottom: 1px solid #eee;
            padding: 20px 0;
        }
        .cart-item-image {
            max-width: 120px;
            border-radius: 8px;
        }
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-btn {
            width: 30px;
            height: 30px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .quantity-input {
            width: 50px;
            height: 30px;
            text-align: center;
            border: 1px solid #dee2e6;
            margin: 0 5px;
        }
        .remove-item {
            color: #dc3545;
            cursor: pointer;
            background: none;
            border: none;
            font-size: 18px;
        }
        .cart-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }
        .empty-cart {
            text-align: center;
            padding: 60px 0;
        }
        .continue-shopping {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Include your header/navigation here -->
<div class="container my-5">
    <h2 class="mb-4">Checkout</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('checkout.place') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Left: Shipping Address -->
          
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Shipping Address</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="John Doe" required value="{{ old('name') }}">
                            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="+91 9876543210" required value="{{ old('phone') }}">
                            @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Full Address <span class="text-danger">*</span></label>
                            <textarea id="address" name="address" class="form-control" rows="4" placeholder="Flat / Street / Area" required>{{ old('address') }}</textarea>
                            @error('address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pincode" class="form-label">Pincode <span class="text-danger">*</span></label>
                            <input type="text" id="pincode" name="pincode" class="form-control" placeholder="600001" required value="{{ old('pincode') }}">
                            @error('pincode') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>


            <!-- Right: Order Summary -->
            <div class="col-md-6 mb-4">
                <h4>Order Summary</h4>

                <div class="card">
                    <ul class="list-group list-group-flush">
                        @foreach($cart as $productId => $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item['name'] }}</strong><br>
                                    <small>{{ $item['quantity'] }} × ₹{{ number_format($item['price'], 2) }}</small>
                                </div>
                                <span class="fw-bold">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Total</strong></span>
                            <span><strong>₹{{ number_format($cartTotal, 2) }}</strong></span>
                        </li>
                    </ul>
                </div>

                <button type="submit" class="btn btn-success mt-4 w-100">Place Order</button>
            </div>
        </div>
    </form>
</div>

      <!-- Include your footer here -->

      @endsection
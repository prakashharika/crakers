@extends('layouts.main')

@section('content')
<div class="login-container min-vh-100 py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-4 animate__animated animate__fadeInDown login-card">
                    <div class="card-header bg-transparent border-0 py-4">
                        <div class="text-center">
                            <div class="logo-container mb-3 animate__animated animate__bounceIn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-bag-check text-white" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                                </svg>
                            </div>
                            <h2 class="mb-2 fw-bold text-white fs-3 fs-md-2">My Orders</h2>
                            <p class="text-light mb-0 opacity-75">Your order history</p>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($orders->count() > 0)
                            @foreach($orders as $orderId => $orderItems)
                                <div class="card mb-4 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Order #: {{ $orderId }}</h6>
                                                <small class="text-muted">Placed on: {{ $orderItems->first()->created_at->format('M d, Y h:i A') }}</small>
                                            </div>
                                            <span class="badge bg-{{ $orderItems->first()->payment_status == 'paid' ? 'success' : 'warning' }}">
                                                {{ ucfirst($orderItems->first()->payment_status) }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        @foreach($orderItems as $order)
                                            <div class="row align-items-center mb-3 pb-3 border-bottom">
                                                <div class="col-md-2">
                                                    @if($order->product && $order->product->image)
                                                        <img src="{{ asset('storage/' . $order->product->image) }}" 
                                                             alt="{{ $order->product->name }}" 
                                                             class="img-fluid rounded" 
                                                             style="height: 80px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                             style="height: 80px; width: 80px;">
                                                            <i class="bi bi-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <h6 class="mb-1">{{ $order->product->name ?? 'Product Not Available' }}</h6>
                                                    <small class="text-muted">Product ID: {{ $order->product_id }}</small>
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    <span class="fw-bold">₹{{ number_format($order->price, 2) }}</span>
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    <span class="text-muted">Qty: {{ $order->quantity }}</span>
                                                </div>
                                                
                                                <div class="col-md-2">
                                                    <span class="fw-bold text-primary">₹{{ number_format($order->price * $order->quantity, 2) }}</span>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="row mt-3">
                                            <div class="col-md-8">
                                                @if($orderItems->first()->address)
                                                    <h6 class="fw-bold">Shipping Address:</h6>
                                                    <p class="mb-1">{{ $orderItems->first()->address->name }}</p>
                                                    <p class="mb-1">{{ $orderItems->first()->address->address }}</p>
                                                    <p class="mb-1">{{ $orderItems->first()->address->pincode }}</p>
                                                    <p class="mb-0">Phone: {{ $orderItems->first()->address->phone }}</p>
                                                @else
                                                    <p class="text-muted">Address not available</p>
                                                @endif
                                            </div>
                                            <div class="col-md-4 text-end">
                                                <h5 class="fw-bold">Total: ₹{{ number_format($orderItems->sum(function($item) {
                                                    return $item->price * $item->quantity;
                                                }), 2) }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-cart-x text-muted" viewBox="0 0 16 16">
                                        <path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"/>
                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                </div>
                                <h4 class="text-white">No orders found</h4>
                                <p class="text-light opacity-75">You haven't placed any orders yet.</p>
                                <a href="{{ route('home') }}" class="btn btn-glow rounded-4 fw-bold px-4">
                                    Start Shopping
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Animate.css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

{{-- Custom Styling --}}
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4e54c8, #8f94fb);
        --btn-gradient: linear-gradient(135deg, #6a11cb, #2575fc);
        --glass-bg: rgba(255, 255, 255, 0.08);
        --glass-border: rgba(255, 255, 255, 0.2);
    }
    input#email {
    background: #b1b1b1;
}
    body {
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
    }

    .login-container {
        background: var(--primary-gradient);
        position: relative;
        min-height: 100vh;
    }
    
    .login-container::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.1' d='M0,128L48,117.3C96,107,192,85,288,112C384,139,480,213,576,218.7C672,224,768,160,864,138.7C960,117,1056,139,1152,149.3C1248,160,1344,160,1392,160L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-position: center;
        animation: waveAnimation 15s linear infinite;
    }

    
    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
    }

    /* Logo animation */
    .logo-container {
        transition: transform 0.3s ease;
    }
    
    .logo-container:hover {
        transform: scale(1.1) rotate(5deg);
    }

    /* Glass inputs */
    . {
        background: rgba(255, 255, 255, 0.2) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        color: #fff !important;
        transition: all 0.3s ease;
    }
    
    .:focus {
        border-color: #fff !important;
        box-shadow: 0 0 15px rgba(255,255,255,0.4) !important;
        transform: translateY(-2px);
    }
    
    .::placeholder {
        color: rgba(255,255,255,0.7);
    }
    
    .>.form-control:focus~label,
    .>.form-control:not(:placeholder-shown)~label {
        color: #fff;
        opacity: 0.9;
    }

    /* Glowing Button */
    .btn-glow {
        background: var(--btn-gradient);
        color: #fff;
        padding: 12px;
        font-size: 1.1rem;
        border: none;
        box-shadow: 0 0 20px rgba(106,17,203,0.6);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    
    .btn-glow::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }
    
    .btn-glow:hover {
        box-shadow: 0 0 30px rgba(37,117,252,0.8);
        transform: translateY(-3px);
    }
    
    .btn-glow:hover::before {
        left: 100%;
    }

    /* Form elements animation */
    ., .form-check, .d-grid {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    
    .:nth-child(1) { animation-delay: 0.2s; }
    .:nth-child(2) { animation-delay: 0.3s; }
    .form-check { animation-delay: 0.4s; }
    .d-grid { animation-delay: 0.5s; }
    .text-center { animation-delay: 0.6s; }

    /* Links */
    .link-light {
        transition: all 0.3s ease;
    }
    
    .link-light:hover {
        opacity: 1 !important;
        transform: translateY(-2px);
    }

    /* Checkbox styling */
    .form-check-input {
        background-color: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .form-check-input:checked {
        background-color: #6a11cb;
        border-color: #6a11cb;
    }
    
    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-card {
            margin: 0 20px;
            padding: 2rem;
        }
        
        .login-container::before {
            background-size: 180%;
            background-position: bottom;
        }
    }
    
    @media (max-width: 576px) {
        .login-card {
            margin: 0 15px;
            padding: 1.5rem;
        }
        
        h2 {
            font-size: 1.8rem !important;
        }
    }

    /* Animations */
    @keyframes waveAnimation {
        0% {
            background-position-x: 0%;
        }
        100% {
            background-position-x: 100%;
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .login-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }
    
    .login-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }
    
    .btn-glow {
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-glow:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(238, 90, 36, 0.4);
    }
    
    .form-control:focus {
        color: white;
    }
    
    /* Ensure text is visible in form controls */
    .form-control {
        color: white !important;
    }

    .login-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }
    
    .login-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .btn-glow {
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-glow:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(238, 90, 36, 0.4);
    }
    
   
</style>
@endsection
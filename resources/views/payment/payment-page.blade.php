@extends('layouts.main')

@section('content')
    <style>
        .payment-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .order-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .qr-code-container {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .payment-options {
            margin-top: 30px;
        }
        .amount-display {
            font-size: 2rem;
            font-weight: bold;
            color: #28a745;
        }
    </style>

    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="payment-container">
                <div class="text-center mb-4">
                    <h2 class="main-title">Complete Your Payment</h2>
                    <p class="text-muted">Order ID: {{ $orderSummary['order_id'] }}</p>
                </div>

                <!-- Order Summary -->
                <div class="order-summary">
                    <h4 class="mb-4">Order Summary</h4>
                    
                    <div class="row mb-3">
                        <div class="col-6">Subtotal ({{ $orderSummary['cart_count'] }} items):</div>
                        <div class="col-6 text-end">₹{{ number_format($orderSummary['charges']['subtotal'], 2) }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-6">Packing Charge (3%):</div>
                        <div class="col-6 text-end">₹{{ number_format($orderSummary['charges']['packing_charge'], 2) }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-6">GST (18%):</div>
                        <div class="col-6 text-end">₹{{ number_format($orderSummary['charges']['gst'], 2) }}</div>
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-2">
                        <div class="col-6"><strong>Grand Total:</strong></div>
                        <div class="col-6 text-end amount-display">₹{{ number_format($orderSummary['charges']['grand_total'], 2) }}</div>
                    </div>
                </div>

                <!-- QR Code Payment -->
                <div class="qr-code-container">
                    <h4 class="mb-4">Scan QR Code to Pay</h4>
                    
                    <!-- Replace with your actual QR code image or generate dynamically -->
                    <img src="{{asset('qr.jpeg')}}"
                         alt="QR Code" class="img-fluid mb-3" style="max-width: 400px;">
                    
                    <p class="text-muted mb-4">Scan the QR code using your UPI app to complete the payment</p>
                    
                    <div class="alert alert-info">
                        <i class="ri-information-line"></i> 
                        Payment will be confirmed automatically within a few minutes
                    </div>
                </div>


                <!-- Manual Payment Confirmation (Optional) -->
                <div class="text-center mt-4">
                    <form action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="ri-check-line"></i> I've Made the Payment
                        </button>
                    </form>
                    
                    <p class="text-muted mt-2 small">
                        Click this button after completing the payment through any method
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Auto-redirect script (optional) -->
    <script>
        // Auto-check payment status every 30 seconds
        setInterval(function() {
            fetch('{{ route("payment.check") }}')
                .then(response => response.json())
                .then(data => {
                    if (data.paid) {
                        window.location.href = '{{ route("order.success") }}';
                    }
                });
        }, 30000);
    </script>
    
      @endsection
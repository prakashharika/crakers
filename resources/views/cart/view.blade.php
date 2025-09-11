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

    <div class="container cart-page">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">Your Shopping Cart</h3>
            </div>
        </div>

        @if(count($cart) > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        @foreach($cart as $id => $item)
                        <div class="cart-item" data-product-id="{{ $id }}">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="img-fluid cart-item-image">
                                </div>
                                <div class="col-md-4">
                                    <h5 class="mb-1">{{ $item['name'] }}</h5>
                                    <p class="text-muted mb-0">{{ $item['category'] }}</p>
                                </div>
                                <div class="col-md-2">
                                    <div class="quantity-control">
                                        <button class="quantity-btn btn-decrease">-</button>
                                        <input type="number" class="quantity-input" value="{{ $item['quantity'] }}" min="1" data-product-id="{{ $id }}">
                                        <button class="quantity-btn btn-increase">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="price">₹{{ number_format($item['price'], 2) }}</div>
                                    <div class="item-total">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <button class="remove-item" data-product-id="{{ $id }}">
                                        <i class="icon icon-close"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
           <div class="cart-summary">
    <h3 class="mb-4">Order Summary</h3>
    
    <div class="d-flex justify-content-between mb-2">
        <span class="cart-subtotal-label">Subtotal ({{ $cartCount }} items)</span>
        <span class="cart-subtotal-value">₹{{ number_format($cartTotal, 2) }}</span>
    </div>
    
    <!-- Packing Charge (3%) -->
    @php
        $packingCharge = $cartTotal * 0.03;
    @endphp
    <div class="d-flex justify-content-between mb-2">
        <span class="cart-packing-label">Packing Charge (3%)</span>
        <span class="cart-packing-value">₹{{ number_format($packingCharge, 2) }}</span>
    </div>
    
    <!-- GST (18% on subtotal only) -->
    @php
        $gst = ($cartTotal + $packingCharge) * 0.18; // GST on subtotal only
    @endphp
    <div class="d-flex justify-content-between mb-2">
        <span class="cart-gst-label">GST (18%)</span>
        <span class="cart-gst-value">₹{{ number_format($gst, 2) }}</span>
    </div>
    
    <hr>
    
    <!-- Grand Total -->
    @php
        $grandTotal = $cartTotal + $packingCharge + $gst;
    @endphp
    <div class="d-flex justify-content-between mb-4">
        <strong>Total</strong>
        <strong class="cart-total-value">₹{{ number_format($grandTotal, 2) }}</strong>
    </div>

                    
                    <a href="{{ route('checkout') }}" class="btn btn-primary w-100 mb-3">Proceed to buy</a>
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100">Continue Shopping</a>
                </div>
            </div>
        </div>
        @else
        <div class="empty-cart">
            <div class="icon mb-3">
                <i class="icon-shopping-cart-simple" style="font-size: 64px; color: #6c757d;"></i>
            </div>
            <h3>Your cart is empty</h3>
            <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ url('/') }}" class="btn btn-primary continue-shopping">Start Shopping</a>
        </div>
        @endif
    </div>

    <!-- Include your footer here -->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update quantity
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.closest('.quantity-control').querySelector('.quantity-input');
                const productId = input.getAttribute('data-product-id');
                let quantity = parseInt(input.value);
                
                if (this.classList.contains('btn-increase')) {
                    quantity++;
                } else if (this.classList.contains('btn-decrease') && quantity > 1) {
                    quantity--;
                }
                
                input.value = quantity;
                updateCartQuantity(productId, quantity);
            });
        });
        
        // Direct input change
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                const productId = this.getAttribute('data-product-id');
                let quantity = parseInt(this.value);
                
                if (quantity < 1) {
                    quantity = 1;
                    this.value = 1;
                }
                
                updateCartQuantity(productId, quantity);
            });
        });
        
        // Remove item
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                removeFromCart(productId);
            });
        });
function updateCartQuantity(productId, quantity) {
    console.log('Updating product:', productId, 'to quantity:', quantity);
    
    const requestData = {
        product_id: productId,
        quantity: quantity
    };
    
    console.log('Sending data:', requestData);
    
    fetch('{{ route("cart.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(requestData)
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            return response.json().then(errorData => {
                console.error('Error response:', errorData);
                throw new Error(errorData.message || 'Failed to update cart');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Update item total
            const itemElement = document.querySelector(`.cart-item[data-product-id="${productId}"]`);
            if (itemElement) {
                const price = parseFloat(itemElement.querySelector('.price').textContent.replace('₹', ''));
                const itemTotal = itemElement.querySelector('.item-total');
                itemTotal.textContent = '₹' + (price * quantity).toFixed(2);
            }
            
            // Update cart summary
            updateCartSummary(data);
            
            showToast('Success', 'Cart updated successfully', 'success');
        } else {
            showToast('Error', data.message || 'Failed to update cart', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error', error.message || 'Something went wrong', 'error');
    });
}
        
        function removeFromCart(productId) {
            fetch('{{ route("cart.remove") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove item from UI
                    const itemElement = document.querySelector(`.cart-item[data-product-id="${productId}"]`);
                    if (itemElement) {
                        itemElement.remove();
                    }
                    
                    // Check if cart is empty
                    if (data.cart_count === 0) {
                        document.querySelector('.row').innerHTML = `
                            <div class="empty-cart">
                                <div class="icon mb-3">
                                    <i class="icon-shopping-cart-simple" style="font-size: 64px; color: #6c757d;"></i>
                                </div>
                                <h3>Your cart is empty</h3>
                                <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
                                <a href="{{ url('/') }}" class="btn btn-primary continue-shopping">Start Shopping</a>
                            </div>
                        `;
                    } else {
                        // Update cart summary
                        updateCartSummary(data);
                    }
                    
                    // Update cart count in header
                    updateCartCount(data.cart_count);
                    
                    showToast('Success', 'Item removed from cart', 'success');
                } else {
                    showToast('Error', data.message || 'Failed to remove item', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Something went wrong', 'error');
            });
        }
        
function updateCartSummary(data) {
    // Use server-calculated values instead of calculating in JavaScript
    const packingCharge = data.packing_charge || 0;
    const gst = data.gst || 0;
    const grandTotal = data.grand_total || 0;

    // Update subtotal value
    const subtotalValue = document.querySelector('.cart-subtotal-value');
    if (subtotalValue) {
        subtotalValue.textContent = '₹' + data.cart_total.toFixed(2);
    }

    // Update packing charge value
    const packingValue = document.querySelector('.cart-packing-value');
    if (packingValue) {
        packingValue.textContent = '₹' + packingCharge.toFixed(2);
    }

    // Update GST value
    const gstValue = document.querySelector('.cart-gst-value');
    if (gstValue) {
        gstValue.textContent = '₹' + gst.toFixed(2);
    }

    // Update total value
    const totalValue = document.querySelector('.cart-total-value');
    if (totalValue) {
        totalValue.textContent = '₹' + grandTotal.toFixed(2);
    }

    // Update item count in subtotal label
    const subtotalLabel = document.querySelector('.cart-subtotal-label');
    if (subtotalLabel) {
        subtotalLabel.textContent = `Subtotal (${data.cart_count} items)`;
    }
}

        
        function updateCartCount(count) {
            const cartCountElements = document.querySelectorAll('.cart-count');
            cartCountElements.forEach(el => {
                el.textContent = count;
                el.style.display = count > 0 ? 'inline-block' : 'none';
            });
        }
        
        function showToast(title, message, type = 'info') {
            // Your existing toast function
            const toastContainer = document.getElementById('toast-container') || createToastContainer();
            const toastId = 'toast-' + Date.now();
            
            const toastHTML = `
                <div id="${toastId}" class="toast align-items-center text-white bg-${type}" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <strong>${title}</strong>: ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;
            
            toastContainer.insertAdjacentHTML('beforeend', toastHTML);
            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
            
            toastElement.addEventListener('hidden.bs.toast', function() {
                this.remove();
            });
        }
        
        function createToastContainer() {
            const container = document.createElement('div');
            container.id = 'toast-container';
            container.className = 'toast-container position-fixed top-0 end-0 p-3';
            container.style.zIndex = '9999';
            document.body.appendChild(container);
            return container;
        }
    });
    </script>

@endsection
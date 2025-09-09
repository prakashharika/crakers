kuhj<x-app-layout>
    <style>
        .row {
            background: #fff;
        }
        
        .order-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #fff;
        }
        
        .order-header {
            background: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            border-radius: 8px 8px 0 0;
        }
        
        .order-body {
            padding: 20px;
        }
        
        .order-footer {
            background: #f8f9fa;
            padding: 15px 20px;
            border-top: 1px solid #e9ecef;
            border-radius: 0 0 8px 8px;
        }
        
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .status-badge {
            font-size: 0.85rem;
            padding: 0.35em 0.65em;
        }
        
        .total-amount {
            font-size: 1.2rem;
            font-weight: bold;
            color: #198754;
        }
    </style>

    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="main-title mb-0">Orders Management</h4>
                    <p class="text-muted mb-0">View and manage all customer orders</p>
                </div>
                <div class="d-flex justify-content-end align-items-center mb-4">
                    <a class="btn btn-secondary me-2" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                    </a>
                </div>
            </div>

            <div class="card p-4">
                <div class="col-xl-12">
                    <div class="card">
                        @if($orders->count())
                            <div class="card-header">
                                <h5 class="card-title mb-0">All Orders ({{ $orders->count() }})</h5>
                            </div>
                            <div class="card-body">
                                @foreach($orders as $orderId => $orderItems)
                                    <div class="order-card">
                                        <div class="order-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">Order #: {{ $orderId }}</h6>
                                                    <small class="text-muted">
                                                        Date: {{ $orderItems->first()->created_at->format('M d, Y h:i A') }}
                                                    </small>
                                                </div>
                                                <div>
                                                    <span class="badge status-badge bg-{{ $orderItems->first()->payment_status == 'paid' ? 'success' : 'warning' }}">
                                                        {{ strtoupper($orderItems->first()->payment_status) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="order-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <h6>Customer Information:</h6>
                                                    @if($orderItems->first()->buyer)
                                                        <p class="mb-1">
                                                            <strong>Name:</strong> {{ $orderItems->first()->buyer->name }}
                                                        </p>
                                                        <p class="mb-1">
                                                            <strong>Email:</strong> {{ $orderItems->first()->buyer->email }}
                                                        </p>
                                                        <p class="mb-1">
                                                            <strong>Phone:</strong> {{ $orderItems->first()->buyer->phone_number ?? 'N/A' }}
                                                        </p>
                                                    @else
                                                        <p class="text-muted">Customer information not available</p>
                                                    @endif
                                                </div>

                                                <div class="col-md-6">
                                                    <h6>Shipping Address:</h6>
                                                    @if($orderItems->first()->address)
                                                        <p class="mb-1">
                                                            <strong>Name:</strong> {{ $orderItems->first()->address->name }}
                                                        </p>
                                                        <p class="mb-1">
                                                            <strong>Address:</strong> {{ $orderItems->first()->address->address }}
                                                        </p>
                                                        <p class="mb-1">
                                                            <strong>Pincode:</strong> {{ $orderItems->first()->address->pincode }}
                                                        </p>
                                                        <p class="mb-0">
                                                            <strong>Phone:</strong> {{ $orderItems->first()->address->phone }}
                                                        </p>
                                                    @else
                                                        <p class="text-muted">Address not available</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <h6>Order Items:</h6>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Image</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orderItems as $order)
                                                            <tr>
                                                                <td>
                                                                    {{ $order->product->name ?? 'Product Not Available' }}
                                                                </td>
                                                                <td>
                                                                    @if($order->product && $order->product->image)
                                                                        <img src="{{ asset($order->product->image) }}" 
                                                                             alt="Product Image" 
                                                                             class="product-image">
                                                                    @else
                                                                        <span class="text-muted">No Image</span>
                                                                    @endif
                                                                </td>
                                                                <td>₹{{ number_format($order->price, 2) }}</td>
                                                                <td>{{ $order->quantity }}</td>
                                                                <td>₹{{ number_format($order->price * $order->quantity, 2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="order-footer">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                   @php
    // Calculate subtotal
    $subtotal = $orderItems->sum(function($item) {
        return $item->price * $item->quantity;
    });
    
    // Calculate charges
    $packingCharge = $subtotal * 0.03; // 3% packing charge
    $gst = $subtotal * 0.18; // 18% GST on subtotal only
    $grandTotal = $subtotal + $packingCharge + $gst;
@endphp

<!-- Display order total with charges -->
<span class="total-amount">
    Order Total: ₹{{ number_format($grandTotal, 2) }}
</span>

<!-- Optional: Display breakdown -->
<div class="order-summary-breakdown" style="font-size: 0.9rem; color: #666; margin-top: 5px;">
    <div>Subtotal: ₹{{ number_format($subtotal, 2) }}</div>
    <div>Packing Charge (3%): ₹{{ number_format($packingCharge, 2) }}</div>
    <div>GST (18%): ₹{{ number_format($gst, 2) }}</div>
</div>
                                                </div>
                                                <div>
                                                    {{-- <button class="btn btn-sm btn-info me-2" data-bs-toggle="modal" data-bs-target="#orderModal{{ $orderId }}">
                                                        <i class="fas fa-eye me-1"></i> View Details
                                                    </button> --}}
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                            <i class="fas fa-cog me-1"></i> Actions
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="#" onclick="updateStatus('{{ $orderId }}', 'processing')">
                                                                    <i class="fas fa-cog me-1"></i> Mark as Processing
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#" onclick="updateStatus('{{ $orderId }}', 'shipped')">
                                                                    <i class="fas fa-shipping-fast me-1"></i> Mark as Shipped
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#" onclick="updateStatus('{{ $orderId }}', 'delivered')">
                                                                    <i class="fas fa-check-circle me-1"></i> Mark as Delivered
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <a class="dropdown-item text-danger" href="#" onclick="confirmDelete('{{ $orderId }}')">
                                                                    <i class="fas fa-trash me-1"></i> Delete Order
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Order Modal -->
                                    <div class="modal fade" id="orderModal{{ $orderId }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Order Details - {{ $orderId }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Add detailed order information here -->
                                                    <p>Detailed order information would go here...</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card-body text-center py-5">
                                <div class="mb-4">
                                    <i class="fas fa-shopping-cart fa-3x text-muted"></i>
                                </div>
                                <h5 class="text-muted">No Orders Found</h5>
                                <p class="text-muted">There are no orders placed yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="main-footer mt-5">
                <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
                <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code wapp</a></span>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function updateStatus(orderId, status) {
            Swal.fire({
                title: 'Update Order Status?',
                text: `Are you sure you want to mark order ${orderId} as ${status}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add your AJAX call here to update order status
                    console.log(`Updating order ${orderId} to status: ${status}`);
                    Swal.fire('Updated!', 'Order status has been updated.', 'success');
                }
            });
        }

        function confirmDelete(orderId) {
            Swal.fire({
                title: 'Delete Order?',
                text: `Are you sure you want to delete order ${orderId}? This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add your AJAX call here to delete order
                    console.log(`Deleting order: ${orderId}`);
                    Swal.fire('Deleted!', 'Order has been deleted.', 'success');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips if needed
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</x-app-layout>
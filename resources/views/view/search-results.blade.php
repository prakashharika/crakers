@extends('layouts.main')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container-fluid px-3 py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Search Results</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Filter Results</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('search') }}" method="GET">
                        <!-- Search Input -->
                        <div class="mb-3">
                            <label for="searchQuery" class="form-label fw-semibold">Search Term</label>
                            <input type="text" class="form-control rounded-1" id="searchQuery" name="query" 
                                   value="{{ $query ?? '' }}" placeholder="Enter search term...">
                        </div>
                        
                        <!-- Category Filter -->
                        <div class="mb-3">
                            <label for="productCategory" class="form-label fw-semibold">Category</label>
                            <select class="form-select rounded-1" id="productCategory" name="product_cat">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" 
                                        {{ (isset($selectedCategory) && $selectedCategory == $category->slug) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 rounded-1 fw-semibold">
                            <i class="fas fa-search me-2"></i>
                            Apply Filters
                        </button>
                        
                        @if($query || (isset($selectedCategory) && $selectedCategory))
                            <a href="{{ route('search') }}" class="btn btn-outline-secondary w-100 mt-2 rounded-1">
                                Clear Filters
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Search Results -->
        <div class="col-lg-9">
            <!-- Search Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1 fw-bold">Search Results</h2>
                    @if($query || (isset($selectedCategory) && $selectedCategory))
                        <p class="text-muted mb-0">
                            @if($query && isset($selectedCategory) && $selectedCategory)
                                Showing results for "{{ $query }}" in {{ $categories->where('slug', $selectedCategory)->first()->name ?? $selectedCategory }}
                            @elseif($query)
                                Showing results for "{{ $query }}"
                            @elseif(isset($selectedCategory) && $selectedCategory)
                                Showing products in {{ $categories->where('slug', $selectedCategory)->first()->name ?? $selectedCategory }}
                            @endif
                        </p>
                    @endif
                </div>
                <div class="text-muted fw-semibold">
                    {{ $products->total() }} result(s) found
                </div>
            </div>

            <!-- Results Grid -->
            @if($products->count() > 0)
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="card product-card h-100 border-0 shadow-sm overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <a href="{{ route('product.view', $product->slug) }}" class="d-block product-img-link">
                                        <img class="img-fluid w-100 product-img" 
                                             src="{{ asset($product->images) }}" 
                                             alt="{{ $product->name }}"
                                             style="height: 220px; object-fit: cover;">
                                    </a>
                                    <div class="product-action-bar position-absolute">
                                        <button class="btn btn-action add-to-cart-btn" data-product-id="{{ $product->id }}" 
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <a href="{{ route('product.view', $product->slug) }}" 
                                           class="btn btn-action" data-bs-toggle="tooltip" data-bs-placement="left" title="Quick view">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                    @if($product->base_price > $product->selling_price)
                                        <span class="badge bg-danger position-absolute top-0 start-0 m-2 sale-badge">
                                            -{{ round((($product->base_price - $product->selling_price) / $product->base_price) * 100) }}%
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <p class="text-muted small mb-1">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                    <h6 class="card-title product-title">
                                        <a href="{{ route('product.view', $product->slug) }}" class="text-dark text-decoration-none">
                                            {{ \Illuminate\Support\Str::limit($product->name, 50) }}
                                        </a>
                                    </h6>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="text-warning me-1 small">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= 4 ? ' filled' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <span class="text-muted small">(24)</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-bold text-dark fs-5">₹{{ number_format($product->selling_price, 2) }}</span>
                                            @if($product->base_price > $product->selling_price)
                                                <span class="text-muted text-decoration-line-through ms-1">₹{{ number_format($product->base_price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @else
                <!-- No Results -->
                <div class="text-center py-5">
                    <div class="icon mb-3">
                        <i class="fas fa-search fa-4x text-secondary"></i>
                    </div>
                    <h3 class="fw-bold">No products found</h3>
                    <p class="text-muted mb-4">
                        @if($query || (isset($selectedCategory) && $selectedCategory))
                            No products match your search criteria. Try adjusting your filters.
                        @else
                            Start searching for products using the filters on the left.
                        @endif
                    </p>
                    <a href="{{ url('/') }}" class="btn btn-primary px-4">
                        <i class="fas fa-home me-2"></i>
                        Back to Home
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.product-card {
    transition: all 0.3s ease;
    border-radius: 12px;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.product-img-link {
    overflow: hidden;
    display: block;
}

.product-img {
    transition: transform 0.5s ease;
}

.product-card:hover .product-img {
    transform: scale(1.05);
}

.product-action-bar {
    top: 10px;
    right: 10px;
    opacity: 0;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.product-card:hover .product-action-bar {
    opacity: 1;
    right: 15px;
}

.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: white;
    color: #333;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    transition: all 0.3s ease;
}

.btn-action:hover {
    background: #007bff;
    color: white;
    transform: scale(1.1);
}

.sale-badge {
    font-size: 0.8rem;
    padding: 0.35rem 0.65rem;
}

.product-title {
    min-height: 48px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.filled {
    color: #fd7e14;
}

/* Pagination styling */
.pagination .page-link {
    border-radius: 8px;
    margin: 0 4px;
    border: none;
    color: #495057;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .product-action-bar {
        opacity: 1;
        right: 10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Add to cart functionality
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            addToCart(productId, 1, this);
        });
    });

    function addToCart(productId, quantity, buttonElement) {
        const originalHtml = buttonElement.innerHTML;
        buttonElement.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span>';
        buttonElement.disabled = true;

        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Success', data.message, 'success');
                updateCartCount(data.cart_count);
            } else {
                showToast('Error', data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error', 'Something went wrong', 'error');
        })
        .finally(() => {
            buttonElement.innerHTML = originalHtml;
            buttonElement.disabled = false;
        });
    }

    function showToast(title, message, type = 'info') {
        // Implement toast notification functionality here
        console.log(`${title}: ${message} (${type})`);
        // You can use a library like Bootstrap Toasts or implement your own
    }

    function updateCartCount(count) {
        // Update cart count in the navbar
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(el => {
            el.textContent = count;
        });
    }
});
</script>

@endsection 
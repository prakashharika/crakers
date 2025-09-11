@extends('layouts.main')
@section('content')

<div class="container-fluid px-3 py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('product.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6 mb-4">
            <div class="product-image-container">
                <div class="main-image mb-3">
                    <img src="{{ asset($product->images) }}" 
                         alt="{{ $product->name }}" 
                         class="img-fluid rounded-3 w-100"
                         style="max-height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
            <div class="product-details">
                <!-- Category Badge -->
                <div class="mb-3">
                    <span class="badge bg-primary">{{ $product->category->name }}</span>
                </div>

                <!-- Product Name -->
                <h1 class="product-title mb-2">{{ $product->name }}</h1>
                @if($product->tamil_name)
                    <h4 class="text-muted mb-3">{{ $product->tamil_name }}</h4>
                @endif

                <!-- Price -->
                <div class="price-section mb-3">
                    @if($product->base_price > $product->selling_price)
                        <div class="d-flex align-items-center">
                            <h2 class="text-primary me-3 mb-0">₹{{ number_format($product->selling_price, 2) }}</h2>
                            <del class="text-muted h5 mb-0">₹{{ number_format($product->base_price, 2) }}</del>
                            <span class="badge bg-danger ms-2">
                                {{ round((($product->base_price - $product->selling_price) / $product->base_price) * 100) }}% OFF
                            </span>
                        </div>
                    @else
                        <h2 class="text-primary mb-0">₹{{ number_format($product->selling_price, 2) }}</h2>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="product-info mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item mb-2">
                                <strong>Package Type:</strong> 
                                <span class="text-capitalize">{{ $product->packet_or_box }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-2">
                                <strong>Quantity Available:</strong> 
                                <span>{{ $product->quantity }} {{ $product->packet_or_box }}(s)</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-item mb-2">
                                <strong>Items Included:</strong> 
                                <span>{{ $product->items }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($product->description)
                <div class="description-section mb-4">
                    <h5 class="mb-2">Description</h5>
                    <div class="product-description">
                        {!! $product->description !!}
                    </div>
                </div>
                @endif

                <!-- Add to Cart Section -->
                <div class="add-to-cart-section">
                    <form id="addToCartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="row align-items-center">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="form-label">Quantity:</label>
                                <div class="wg-quantity">
                                    <button type="button" class="btn-quantity btn-decrease">
                                        <i class="icon icon-minus"></i>
                                    </button>
                                    <input class="quantity-product" type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}">
                                    <button type="button" class="btn-quantity btn-increase">
                                        <i class="icon icon-plus"></i>
                                    </button>
                                </div>
                            </div>
                            
                          <div class="col-md-8">
    <button type="button" class="btn btn-primary btn-lg w-100 add-to-cart-btn" data-product-id="{{ $product->id }}">
        <i class="icon icon-shopping-cart-simple me-2"></i>
        Add to Cart
    </button>
</div>
                        </div>
                    </form>
                </div>

                <!-- Product Meta -->
                <div class="product-meta mt-4 pt-3 border-top">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">Product ID: #{{ $product->id }}</small>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <small class="text-muted">Added: {{ $product->created_at->format('M d, Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Similar Products (Same Category) -->
    @php
        $similarProducts = \App\Models\Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(8)
            ->get();
    @endphp

    @if($similarProducts->count() > 0)
    <section class="flat-spacing mt-5">
        <div class="container">
            <div class="sect-title type-3 type-2 wow fadeInUp">
                <h2 class="s-title type-semibold">More from {{ $product->category->name }}</h2>
                <a href="{{ route('product.category', $product->category->slug) }}" class="tf-btn-icon h6 fw-medium">
                    View All {{ $product->category->name }} Products
                    <i class="icon icon-caret-circle-right"></i>
                </a>
            </div>
            <div dir="ltr" class="swiper tf-swiper wrap-sw-over wow fadeInUp" data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="1"
                data-space-lg="30" data-space-md="20" data-space="15" data-pagination="1" data-pagination-sm="1" data-pagination-md="2"
                data-pagination-lg="3" data-grid="2">
                <div class="swiper-wrapper">
                    @foreach ($similarProducts as $similarProduct)
                        @php
                            $category = $similarProduct->category;
                        @endphp
                        <div class="swiper-slide">
                            <div class="card-product style-5">
                                <div class="card-product_wrapper aspect-ratio-0 d-flex">
                                    <a href="{{ route('product.view', $similarProduct->slug) }}" class="product-img">
                                        <img class="lazyload img-product" 
                                            src="{{ asset($similarProduct->images) }}" 
                                            data-src="{{ asset($similarProduct->images) }}" 
                                            alt="{{ $similarProduct->name }}"
                                            style="height: 200px; object-fit: cover;">
                                    </a>
                                   
                                       <ul class="product-action_list">
                                        <li>
                                            <a href="#shoppingCart" data-bs-toggle="offcanvas" 
                                               class="hover-tooltip tooltip-left box-icon add-to-cart-btn"
                                               data-product-id="{{ $similarProduct->id }}">
                                                <span class="icon icon-shopping-cart-simple"></span>
                                                <span class="tooltip">Add to cart</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#quickView" data-bs-toggle="modal" class="hover-tooltip tooltip-left box-icon">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick view</span>
                                            </a>
                                        </li>
                                    </ul>
                                    @if($similarProduct->base_price > $similarProduct->selling_price)
                                        <ul class="product-badge_list">
                                            <li class="product-badge_item h6 sale">
                                                -{{ round((($similarProduct->base_price - $similarProduct->selling_price) / $similarProduct->base_price) * 100) }}%
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                                <div class="card-product_info d-grid">
                                    <p class="tag-product text-small">{{ $category->name ?? 'Uncategorized' }}</p>
                                    <h6 class="name-product">
                                        <a href="{{ route('product.view', $similarProduct->slug) }}" class="link text-line-clamp-2">{{ $similarProduct->name }}</a>
                                    </h6>
                                    <div class="rate_wrap w-100">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="icon-star text-star"></i>
                                        @endfor
                                    </div>
                                    <div class="price-wrap mb-0">
                                        <h4 class="price-new">₹{{ number_format($similarProduct->selling_price, 2) }}</h4>
                                        @if($similarProduct->base_price > $similarProduct->selling_price)
                                            <span class="price-old h6">₹{{ number_format($similarProduct->base_price, 2) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="sw-dot-default tf-sw-pagination"></div>
            </div>
        </div>
    </section>
    @endif
</div>

<style>
.product-title {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
}

.price-section h2 {
    font-size: 2.5rem;
    font-weight: 800;
}

.wg-quantity {
    display: flex;
    align-items: center;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    overflow: hidden;
    width: fit-content;
}

.btn-quantity {
    border: none;
    background: #f8f9fa;
    padding: 8px 12px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-quantity:hover {
    background: #e9ecef;
}

.quantity-product {
    width: 50px;
    text-align: center;
    border: none;
    border-left: 1px solid #dee2e6;
    border-right: 1px solid #dee2e6;
    padding: 8px;
    margin: 0;
}

.product-description {
    line-height: 1.6;
    color: #555;
}

.product-description p {
    margin-bottom: 1rem;
}

.add-to-cart-btn {
    padding: 12px 20px;
    font-size: 1.1rem;
    font-weight: 600;
}

.info-item {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

.info-item:last-child {
    border-bottom: none;
}

.breadcrumb {
    background: none;
    padding: 0;
}

.breadcrumb-item a {
    color: #6c757d;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: #007bff;
}

/* Similar products styling */
.card-product.style-5 {
    border: 1px solid #eee;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-product.style-5:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.product-action_list {
    position: absolute;
    top: 10px;
    right: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.card-product.style-5:hover .product-action_list {
    opacity: 1;
}

.product-action_list li {
    margin-bottom: 5px;
}

.product-action_list .box-icon {
    background: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.product-action_list .box-icon:hover {
    background: #007bff;
    color: white;
    transform: scale(1.1);
}
</style>

<script>

</script>
@endsection
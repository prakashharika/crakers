@extends('layouts.main')

@section('content')
<section class="flat-spacing flat-animate-tab py-5">
    <div class="container">
        <div class="sect-title type-3 type-2 flex-wrap d-flex justify-content-between align-items-center mb-4 wow fadeInUp">
            <h2 class="s-title">{{ $category->name }}</h2>
            <a href="{{ route('product.categories') }}" class="tf-btn-icon h6 fw-medium text-nowrap">
                Back to Categories
                <i class="icon icon-caret-circle-right"></i>
            </a>
        </div>

        <div class="tab-content">
            <div class="tab-pane active show" id="category-products" role="tabpanel">
                <div dir="ltr" class="swiper tf-swiper wow fadeInUp"
                     data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="2"
                     data-space-lg="48" data-space-md="24" data-space="12"
                     data-pagination="2" data-pagination-sm="2" data-pagination-md="3"
                     data-pagination-lg="4">

                    <div class="swiper-wrapper">
                        @forelse ($category->products as $product)
                            <div class="swiper-slide">
                                <div class="card-product style-5">
                                    <div class="card-product_wrapper aspect-ratio-0 d-flex position-relative">
                                        <a href="javascript:void(0)" class="product-img">
                                            <img class="lazyload img-product"
                                                 src="{{ asset($product->images) }}"
                                                 data-src="{{ asset($product->images) }}"
                                                 alt="{{ $product->name }}">
                                        </a>

                                        {{-- Action buttons --}}
                                        <ul class="product-action_list">
                                            <li>
                                                <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                                   class="hover-tooltip tooltip-left box-icon add-to-cart-btn"
                                                   data-product-id="{{ $product->id }}">
                                                    <span class="icon icon-shopping-cart-simple"></span>
                                                    <span class="tooltip">Add to cart</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#quickView" data-bs-toggle="modal"
                                                   class="hover-tooltip tooltip-left box-icon">
                                                    <span class="icon icon-view"></span>
                                                    <span class="tooltip">Quick view</span>
                                                </a>
                                            </li>
                                        </ul>

                                        {{-- Discount badge --}}
                                        @if($product->base_price > $product->selling_price)
                                            <ul class="product-badge_list">
                                                <li class="product-badge_item h6 sale">
                                                    -{{ round((($product->base_price - $product->selling_price) / $product->base_price) * 100) }}%
                                                </li>
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="card-product_info d-grid text-center">
                                        <p class="tag-product text-small">{{ $category->name }}</p>
                                        <h6 class="name-product">
                                            <a href="javascript:void(0)" class="link">{{ $product->name }}</a>
                                        </h6>
                                        <div class="rate_wrap w-100">
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="icon-star text-star"></i>
                                            @endfor
                                        </div>
                                        <div class="price-wrap mb-0">
                                            <h4 class="price-new">₹{{ number_format($product->selling_price, 2) }}</h4>
                                            @if($product->base_price > $product->selling_price)
                                                <span class="price-old h6">₹{{ number_format($product->base_price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">No products found in this category.</p>
                        @endforelse
                    </div>

                    {{-- Pagination dots for mobile --}}
                    <div class="sw-dot-default tf-sw-pagination d-xl-none"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Custom CSS --}}
@push('styles')
<style>
    .img-product {
        height: 220px;
        width: 100%;
        object-fit: cover;
        border-radius: 6px;
    }
    .card-product {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-product:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }
</style>
@endpush
@endsection

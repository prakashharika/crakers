@extends('layouts.main')

@section('content')

    <div id="wrapper">
        
        <!-- Banner Slider -->
       <div class="tf-slideshow tf-btn-swiper-main">
            <div dir="ltr"
                class="swiper tf-swiper sw-slide-show slider_effect_fade"
                data-auto="true"
                data-loop="true"
                data-effect="fade"
                data-delay="3000">
         
        <div class="swiper-wrapper"> <!-- ✅ Only one wrapper -->
            @foreach ($slider as $item)
                <div class="swiper-slide">
                    <div class="slider-wrap style-2">
                        <div class="sld_image">
                            <img src="{{ asset('images/' . $item->image) }}"
                                 data-src="{{ asset('images/' . $item->image) }}"
                                 alt="Slider Image"
                                 class="lazyload scale-item">
                        </div>
                        <div class="sld_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-11">
                                        <div class="content-sld_wrap">
                                            <h4 class="sub-title_sld has-icon text-primary fade-item fade-item-1">
                                                <span class="icon d-flex"></span>
                                                Don't miss the opportunity
                                            </h4>
                                            <h1 class="title_sld text-display fade-item fade-item-2">
                                                <a href="javascript:void(0)" class="link fw-normal" style="color: #fff !important">
                                                    {{ $item->title }}
                                                </a>
                                            </h1>
                                            <p class="fade-item fade-item-3 text-white">
                                                {{ $item->description }}
                                            </p>
                                            <div class="fade-item fade-item-4">
                                                <a href="javascript:void(0)" class="tf-btn animate-btn fw-semibold">
                                                    Shop now
                                                    <i class="icon icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="sw-dot-default tf-sw-pagination"></div>
    </div>
</div>

        <!-- /Banner Slider -->
        <!-- Category -->
        <section class="flat-spacing">
            <div class="container">
                <h1 class="sect-title text-center title wow fadeInUp">Product Category</h1>
                <div dir="ltr" class="swiper tf-swiper wow fadeInUp" data-preview="6" data-tablet="4" data-mobile-sm="3" data-mobile="2"
                    data-space-lg="48" data-space-md="32" data-space="12" data-pagination="2" data-pagination-sm="3" data-pagination-md="4"
                    data-pagination-lg="6">
                  <div class="swiper-wrapper">
                    <!-- item 1 -->
                    <div class="swiper-slide">
                        <a href="javascript:void(0)" class="widget-collection style-circle hover-img">
                            <div class="collection_image img-style">
                                <img class="lazyload" src="{{ asset('front-end/images/products/sparklers.jpg')}}" data-src="{{ asset('front-end/images/products/sparklers.jpg')}}" alt="Sparklers">
                            </div>
                            <p class="collection_name h4 link">
                                Sparklers (Phuljhari) <span class="count text-main-2">(24)</span>
                            </p>
                        </a>
                    </div>
                    <!-- item 2 -->
                    <div class="swiper-slide">
                        <a href="javascript:void(0)" class="widget-collection style-circle hover-img">
                            <div class="collection_image img-style">
                                <img class="lazyload" src="{{ asset('front-end/images/products/gound.jpg')}}" data-src="{{ asset('front-end/images/products/gound.jpg')}}" alt="Ground Spinners">
                            </div>
                            <p class="collection_name h4 link">
                                Ground Spinners (Chakri) <span class="count text-main-2">(30)</span>
                            </p>
                        </a>
                    </div>
                    <!-- item 3 -->
                    <div class="swiper-slide">
                        <a href="javascript:void(0)" class="widget-collection style-circle hover-img">
                            <div class="collection_image img-style">
                                <img class="lazyload" src="{{ asset('front-end/images/products/flower.jpg')}}" data-src="{{ asset('front-end/images/products/flower.jpg')}}" alt="Flower Pots">
                            </div>
                            <p class="collection_name h4 link">
                                Flower Pots (Anar) <span class="count text-main-2">(18)</span>
                            </p>
                        </a>
                    </div>
                    <!-- item 4 -->
                    <div class="swiper-slide">
                        <a href="javascript:void(0)" class="widget-collection style-circle hover-img">
                            <div class="collection_image img-style">
                                <img class="lazyload" src="{{ asset('front-end/images/products/rokets.jpg')}}" data-src="{{ asset('front-end/images/products/rokets.jpg')}}" alt="Rockets">
                            </div>
                            <p class="collection_name h4 link">
                                Rockets <span class="count text-main-2">(47)</span>
                            </p>
                        </a>
                    </div>
                    <!-- item 5 -->
                    <div class="swiper-slide">
                        <a href="javascript:void(0)" class="widget-collection style-circle hover-img">
                            <div class="collection_image img-style">
                                <img class="lazyload" src="{{ asset('front-end/images/products/bomb.jpg')}}" data-src="{{ asset('front-end/images/products/bomb.jpg')}}" alt="Bombs">
                            </div>
                            <p class="collection_name h4 link">
                                Bombs / Sound Crackers <span class="count text-main-2">(90)</span>
                            </p>
                        </a>
                    </div>
                    <!-- item 6 -->
                    <div class="swiper-slide">
                        <a href="javascript:void(0)" class="widget-collection style-circle hover-img">
                            <div class="collection_image img-style">
                                <img class="lazyload" src="{{ asset('front-end/images/products/sky.jpg')}}" data-src="{{ asset('front-end/images/products/sky.jpg')}}" alt="Sky Shots">
                            </div>
                            <p class="collection_name h4 link">
                                Sky Shots / Aerials <span class="count text-main-2">(86)</span>
                            </p>
                        </a>
                    </div>
                </div>

                    <div class="sw-dot-default tf-sw-pagination"></div>
                </div>
            </div>
        </section>
        <!-- /Category -->
        <!-- Box Image -->
        <div class="flat-spacing pt-0">
            <div class="container">
                <div dir="ltr" class="swiper tf-swiper" data-preview="3" data-tablet="2" data-mobile-sm="1" data-mobile="1" data-space-lg="48"
                    data-space-md="32" data-space="12" data-pagination="1" data-pagination-sm="1" data-pagination-md="2" data-pagination-lg="3">
                    <div class="swiper-wrapper">
                    <!-- item 1 -->
                        <div class="swiper-slide">
                            <div class="box-image_V05 type-space-2 hover-img wow fadeInLeft">
                                <a href="javascript:void(0)" class="box-image_image img-style">
                                    <img src="{{asset('front-end/images/products/cracker-sparklers.jpg')}}" data-src="{{asset('front-end/images/products/cracker-sparklers.jpg')}}" alt="Sparklers" class="lazyload">
                                </a>
                                <div class="box-image_content">
                                    <p class="sub-title text-primary h6 fw-semibold">Festival Offer 30% OFF</p>
                                    <h4 class="title">
                                        <a href="javascript:void(0)" class="link">
                                            Colorful Sparklers Pack
                                        </a>
                                    </h4>
                                    <a href="javascript:void(0)" class="tf-btn-line fw-bold letter-space-0">
                                        Shop now
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- item 2 -->
                        <div class="swiper-slide">
                            <div class="box-image_V05 type-space-2 hover-img wow fadeInLeft" data-wow-delay="0.1s">
                                <a href="javascript:void(0)" class="box-image_image img-style">
                                    <img src="{{asset('front-end/images/products/cracker-flowerpot.jpg')}}" data-src="{{asset('front-end/images/products/cracker-flowerpot.jpg')}}" alt="Flower Pots" class="lazyload">
                                </a>
                                <div class="box-image_content">
                                    <p class="sub-title text-primary h6 fw-semibold">Festival Combo Offer</p>
                                    <h4 class="title">
                                        <a href="javascript:void(0)" class="link">
                                            Flower Pots (Anar) Pack
                                        </a>
                                    </h4>
                                    <a href="javascript:void(0)" class="tf-btn-line fw-bold letter-space-0">
                                        Shop now
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- item 3 -->
                        <div class="swiper-slide">
                            <div class="box-image_V05 type-space-2 hover-img wow fadeInLeft" data-wow-delay="0.2s">
                                <a href="javascript:void(0)" class="box-image_image img-style">
                                    <img src="{{asset('front-end/images/products/cracker-rockets.jpeg')}}" data-src="{{asset('front-end/images/products/cracker-rockets.jpeg')}}" alt="Rockets" class="lazyload">
                                </a>
                                <div class="box-image_content">
                                    <p class="sub-title text-primary h6 fw-semibold">Big Sale up to 40% OFF</p>
                                    <h4 class="title">
                                        <a href="javascript:void(0)" class="link">
                                            Sky Rocket Assorted Box
                                        </a>
                                    </h4>
                                    <a href="javascript:void(0)" class="tf-btn-line fw-bold letter-space-0">
                                        Shop now
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="sw-dot-default tf-sw-pagination"></div>
                </div>
            </div>
        </div>
        <!-- /Box Image -->
        <!-- Banner Countdown -->
        <div class="themesFlat">
            <div class="container">
                <div class="banner-cd_v02 wow fadeInUp">
                    <div class="banner_title">
                        <span class="icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.5196 23.625C15.477 23.639 16.4261 23.4472 17.3029 23.0625C18.2988 22.6469 19.1475 21.9426 19.7396 21.0403C20.3317 20.138 20.6401 19.0791 20.625 18C20.625 14.625 19.875 13.875 18.75 11.625C17.625 9.375 18.75 7.125 18.75 7.125C17.8505 7.35299 17.0564 7.88241 16.5 8.625C16.5 0.75 11.25 0.375 11.25 0.375C11.5633 1.24478 11.6588 2.17809 11.5281 3.09329C11.3973 4.0085 11.0443 4.87774 10.5 5.625C8.625 8.25 6.75 9.75 6 12.75C6 12.75 4.5 12 4.875 10.5C4.875 10.5 3.375 13.125 3.375 17.25C3.375 21.7733 6.99825 23.1 8.78175 23.4788C9.25609 23.5777 9.73947 23.6267 10.224 23.625H14.5196Z"
                                    fill="#FEBD55" />
                                <path
                                    d="M9.31625 23.625C9.31625 23.625 5.44775 22.1745 5.44775 17.8223C5.44775 12.987 8.80325 11.25 8.80325 11.25C8.80325 11.25 7.86575 12.987 8.83288 13.4704C8.83288 13.4704 10.451 8.2005 14.8033 6.75C14.8033 6.75 13.2834 8.34862 14.2505 11.25C15.2176 14.1514 18.494 14.8027 18.5533 18V18.375C18.5913 19.4609 18.304 20.5334 17.7283 21.4549C16.9828 22.6163 16.1221 23.625 14.1519 23.625H9.31625Z"
                                    fill="#FC9E20" />
                                <path
                                    d="M9.75 23.625C8.86229 23.2538 8.10398 22.6287 7.57026 21.8282C7.03654 21.0276 6.75118 20.0872 6.75 19.125C6.75 15.375 8.625 13.875 8.625 13.875C8.625 13.875 8.625 15.375 9.375 15.75C9.375 15.75 10.125 10.5 13.5 9.375C13.5 9.375 12.375 10.125 13.125 12.375C13.875 14.625 17.25 15.375 17.25 19.125V19.4516C17.2633 20.3302 17.025 21.1943 16.5634 21.942C16.2467 22.4679 15.7965 22.9007 15.2585 23.1963C14.7204 23.4919 14.1137 23.6398 13.5 23.625H9.75Z"
                                    fill="#E03E3E" />
                                <path
                                    d="M9.74992 21.75C9.67576 21.75 9.60328 21.728 9.54162 21.6868C9.47997 21.6456 9.43192 21.587 9.40354 21.5185C9.37516 21.45 9.36774 21.3746 9.3822 21.3019C9.39666 21.2291 9.43237 21.1623 9.48479 21.1099L13.9848 16.6099C14.0555 16.5416 14.1502 16.5038 14.2486 16.5046C14.3469 16.5055 14.4409 16.5449 14.5105 16.6144C14.58 16.684 14.6194 16.778 14.6203 16.8763C14.6212 16.9747 14.5834 17.0694 14.515 17.1401L10.015 21.6401C9.94474 21.7105 9.84937 21.75 9.74992 21.75ZM13.1249 22.125C12.9024 22.125 12.6849 22.059 12.4999 21.9354C12.3149 21.8118 12.1707 21.6361 12.0856 21.4305C12.0004 21.225 11.9781 20.9988 12.0215 20.7805C12.0649 20.5623 12.1721 20.3618 12.3294 20.2045C12.4868 20.0472 12.6872 19.94 12.9054 19.8966C13.1237 19.8532 13.3499 19.8755 13.5554 19.9606C13.761 20.0458 13.9367 20.19 14.0603 20.375C14.1839 20.56 14.2499 20.7775 14.2499 21C14.2499 21.2984 14.1314 21.5845 13.9204 21.7955C13.7094 22.0065 13.4233 22.125 13.1249 22.125ZM13.1249 20.625C13.0508 20.625 12.9783 20.647 12.9166 20.6882C12.8549 20.7294 12.8068 20.788 12.7785 20.8565C12.7501 20.925 12.7427 21.0004 12.7571 21.0732C12.7716 21.1459 12.8073 21.2127 12.8598 21.2652C12.9122 21.3176 12.979 21.3533 13.0518 21.3678C13.1245 21.3823 13.1999 21.3748 13.2684 21.3465C13.3369 21.3181 13.3955 21.27 13.4367 21.2083C13.4779 21.1467 13.4999 21.0742 13.4999 21C13.4999 20.9005 13.4604 20.8052 13.3901 20.7348C13.3198 20.6645 13.2244 20.625 13.1249 20.625ZM10.8749 18.375C10.6524 18.375 10.4349 18.309 10.2499 18.1854C10.0649 18.0618 9.9207 17.8861 9.83556 17.6805C9.75041 17.475 9.72813 17.2488 9.77154 17.0305C9.81494 16.8123 9.92209 16.6118 10.0794 16.4545C10.2368 16.2972 10.4372 16.19 10.6554 16.1466C10.8737 16.1032 11.0999 16.1255 11.3054 16.2106C11.511 16.2958 11.6867 16.44 11.8103 16.625C11.9339 16.81 11.9999 17.0275 11.9999 17.25C11.9999 17.5484 11.8814 17.8345 11.6704 18.0455C11.4594 18.2565 11.1733 18.375 10.8749 18.375ZM10.8749 16.875C10.8008 16.875 10.7282 16.897 10.6666 16.9382C10.6049 16.9794 10.5568 17.038 10.5285 17.1065C10.5001 17.175 10.4927 17.2504 10.5071 17.3232C10.5216 17.3959 10.5573 17.4627 10.6098 17.5152C10.6622 17.5676 10.729 17.6033 10.8018 17.6178C10.8745 17.6323 10.9499 17.6248 11.0184 17.5965C11.0869 17.5681 11.1455 17.52 11.1867 17.4583C11.2279 17.3967 11.2499 17.3242 11.2499 17.25C11.2499 17.1505 11.2104 17.0552 11.1401 16.9848C11.0698 16.9145 10.9744 16.875 10.8749 16.875Z"
                                    fill="#FBFBFB" />
                            </svg>

                        </span>
                        <h4 class="text-primary">
                            Hurry up offer ends in:
                        </h4>
                    </div>

                    <div class="count-down_v02">
                        <div class="js-countdown cd-has-zero" data-timer="25472" data-labels="Days,Hours,Mins,Secs"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Banner Countdown -->
        <!-- Feature Product -->
        <section class="flat-spacing flat-animate-tab">
            <div class="container">
                <div class="sect-title type-3 type-2 flex-wrap wow fadeInUp">
                    <h2 class="s-title text-nowrap">Deal of the day</h2>
                  
                    <a href="javascript:void(0)" class="tf-btn-icon h6 fw-medium text-nowrap">
                        View All Product
                        <i class="icon icon-caret-circle-right"></i>
                    </a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active show" id="all-product" role="tabpanel">
                       <div dir="ltr" class="swiper tf-swiper wow fadeInUp" data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="2"
                            data-space-lg="48" data-space-md="24" data-space="12" data-pagination="2" data-pagination-sm="2" data-pagination-md="3"
                            data-pagination-lg="4">
                            <div class="swiper-wrapper">
                                @isset($categories)
    @foreach ($categories as $category)
        @foreach ($category->products as $product)
            <div class="swiper-slide">
                <div class="card-product style-5">
                    <div class="card-product_wrapper aspect-ratio-0 d-flex">
                        <a href="javascript:void(0)" class="product-img">
                            <img class="lazyload img-product" 
                                src="{{ asset($product->images) }}" 
                                data-src="{{ asset($product->images) }}" 
                                alt="{{ $product->name }}">
                        </a>
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
                                <a href="#quickView" data-bs-toggle="modal" class="hover-tooltip tooltip-left box-icon">
                                    <span class="icon icon-view"></span>
                                    <span class="tooltip">Quick view</span>
                                </a>
                            </li>
                        </ul>
                        <div class="wg-quantity mb-2" style="display: none; justify-content: center;">
                            <button type="button" class="btn-quantity btn-decrease">
                                <i class="icon icon-minus"></i>
                            </button>
                            <input class="quantity-product" type="number" name="quantity" value="1" min="1" style="width: 50px; text-align: center;">
                            <button type="button" class="btn-quantity btn-increase">
                                <i class="icon icon-plus"></i>
                            </button>
                        </div>                        @if($product->base_price > $product->selling_price)
                            <ul class="product-badge_list">
                                <li class="product-badge_item h6 sale">
                                    -{{ round((($product->base_price - $product->selling_price) / $product->base_price) * 100) }}%
                                </li>
                            </ul>
                        @endif
                    </div>
                    <div class="card-product_info d-grid">
                        <p class="tag-product text-small">{{ $category->name }}</p>
                        <h6 class="name-product">
                                                <a href="javascript:void(0)" class="link">Flower Pots (Anar) – Mega Pack</a>
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
        @endforeach
    @endforeach
@endisset

                            </div>
                            <div class="sw-dot-default tf-sw-pagination d-xl-none"></div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /Feature Product -->
        <!-- Product On Sale -->
        <section class="flat-spacing bg-white-smoke">
            <div class="container">
                <div class="sect-title type-3 type-2 pb-0 border-0 wow fadeInUp">
                    <h2 class="s-title type-semibold text-nowrap">Product On-sale</h2>
                    <a href="javascript:void(0)" class="tf-btn-icon h6 fw-medium text-nowrap">
                        View All Product
                        <i class="icon icon-caret-circle-right"></i>
                    </a>
                </div>
                <div class="tf-pag-swiper">
                    <div class=" tf-btn-swiper-main pst-4">
                        <div dir="ltr" class="swiper tf-swiper wow fadeInUp" data-preview="3" data-tablet="2.5" data-mobile-sm="2" data-mobile="1"
                            data-space-lg="48" data-space-md="24" data-space="12" data-pagination="1" data-pagination-sm="2" data-pagination-md="2"
                            data-pagination-lg="1">
                            <div class="swiper-wrapper">
                                <!-- Product 1 -->
                                <div class="swiper-slide">
                                    <div class="card-product style-5 style-padding">
                                        <div class="card-product_wrapper aspect-ratio-0 d-flex">
                                            <a href="javascript:void(0)" class="product-img">
                                                <img class="lazyload img-product" src="{{asset('front-end/images/products/7shot.jpeg')}}"
                                                    data-src="{{asset('front-end/images/products/7shot.jpeg')}}" alt="Product">
                                            </a>
                                            <ul class="product-action_list">
                                                <li>
                                                    <a href="#shoppingCart" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon">
                                                        <span class="icon icon-shopping-cart-simple"></span>
                                                        <span class="tooltip">Add to cart</span>
                                                    </a>
                                                </li>
                                                {{-- <li class="wishlist">
                                                    <a href="javascript:void(0);" class="hover-tooltip tooltip-left box-icon">
                                                        <span class="icon icon-heart"></span>
                                                        <span class="tooltip">Add to Wishlist</span>
                                                    </a>
                                                </li> --}}
                                                
                                                <li>
                                                    <a href="#quickView" data-bs-toggle="modal" class="hover-tooltip tooltip-left box-icon">
                                                        <span class="icon icon-view"></span>
                                                        <span class="tooltip">Quick view</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-product_info d-grid">
                                            <p class="tag-product text-small">Laptop</p>
                                            <h6 class="name-product">
                                                <a href="javascript:void(0)" class="link">Apple 2025 MacBook Air 13-inch Laptop with M4 chip: Built
                                                    for
                                                    Apple
                                                    Intelligence</a>
                                            </h6>
                                            <div class="rate_wrap w-100">
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <h4 class="price-new">$599.00</h4>
                                                <span class="price-old h6">$699.00</span>
                                            </div>
                                            <div class="product-progress_sold">
                                                <div class="progress-sold progress" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 80%"></div>
                                                </div>
                                                <div class="box-quantity">
                                                    <p class="text-avaiable">
                                                        Available: <span class="fw-bold text-black">57</span>
                                                    </p>
                                                    <p class="text-avaiable">
                                                        Sold: <span class="fw-bold text-black">72</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product 2 -->
                                <div class="swiper-slide">
                                    <div class="card-product style-5 style-padding">
                                        <div class="card-product_wrapper aspect-ratio-0 d-flex">
                                            <a href="javascript:void(0)" class="product-img">
                                                <img class="lazyload img-product" src="{{asset('front-end/images/products/eee.png')}}"
                                                    data-src="{{asset('front-end/images/products/eee.png')}}" alt="Product">
                                            </a>
                                            <ul class="product-action_list">
                                                <li>
                                                    <a href="#shoppingCart" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon">
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
                                        </div>
                                        <div class="card-product_info d-grid">
                                            <p class="tag-product text-small">Headphone</p>
                                            <h6 class="name-product">
                                                <a href="javascript:void(0)" class="link">Sony WH-1000XM4 Wireless Premium Noise Canceling Overhead
                                                    Headphones</a>
                                            </h6>
                                            <div class="rate_wrap w-100">
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <h4 class="price-new">$300.00</h4>
                                                <span class="price-old h6">$499.00</span>
                                            </div>
                                            <div class="product-progress_sold">
                                                <div class="progress-sold progress" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 30%"></div>
                                                </div>
                                                <div class="box-quantity">
                                                    <p class="text-avaiable">
                                                        Available: <span class="fw-bold text-black">40</span>
                                                    </p>
                                                    <p class="text-avaiable">
                                                        Sold: <span class="fw-bold text-black">120</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product 3 -->
                                <div class="swiper-slide">
                                    <div class="card-product style-5 style-padding">
                                        <div class="card-product_wrapper aspect-ratio-0 d-flex">
                                            <a href="javascript:void(0)" class="product-img">
                                                <img class="lazyload img-product" src="{{asset('front-end/images/products/pattasu.jpg')}}"
                                                    data-src="{{asset('front-end/images/products/pattasu.jpg')}}" alt="Product">
                                            </a>
                                            <ul class="product-action_list">
                                                <li>
                                                    <a href="#shoppingCart" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon">
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
                                        </div>
                                        <div class="card-product_info d-grid">
                                            <p class="tag-product text-small">Headphone</p>
                                            <h6 class="name-product">
                                                <a href="javascript:void(0)" class="link">Wireless Earbuds, 2025 Ear Buds with Big Bass Stereo Sound,
                                                    Bluetooth</a>
                                            </h6>
                                            <div class="rate_wrap w-100">
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <h4 class="price-new">$199.00</h4>
                                                <span class="price-old h6">$299.00</span>
                                            </div>
                                            <div class="product-progress_sold">
                                                <div class="progress-sold progress" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 50%"></div>
                                                </div>
                                                <div class="box-quantity">
                                                    <p class="text-avaiable">
                                                        Available: <span class="fw-bold text-black">29</span>
                                                    </p>
                                                    <p class="text-avaiable">
                                                        Sold: <span class="fw-bold text-black">112</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product 1 -->
                                <div class="swiper-slide">
                                    <div class="card-product style-5 style-padding">
                                        <div class="card-product_wrapper aspect-ratio-0 d-flex">
                                            <a href="javascript:void(0)" class="product-img">
                                                <img class="lazyload img-product" src="images/products/electronic/product-9.jpg"
                                                    data-src="images/products/electronic/product-9.jpg" alt="Product">
                                                <img class="lazyload img-hover" src="images/products/electronic/product-10.jpg"
                                                    data-src="images/products/electronic/product-10.jpg" alt="Product">
                                            </a>
                                            <ul class="product-action_list">
                                                <li>
                                                    <a href="#shoppingCart" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon">
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
                                        </div>
                                        <div class="card-product_info d-grid">
                                            <p class="tag-product text-small">Laptop</p>
                                            <h6 class="name-product">
                                                <a href="javascript:void(0)" class="link">Apple 2025 MacBook Air 13-inch Laptop with M4 chip: Built
                                                    for
                                                    Apple
                                                    Intelligence</a>
                                            </h6>
                                            <div class="rate_wrap w-100">
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <h4 class="price-new">$599.00</h4>
                                                <span class="price-old h6">$699.00</span>
                                            </div>
                                            <div class="product-progress_sold">
                                                <div class="progress-sold progress" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 80%"></div>
                                                </div>
                                                <div class="box-quantity">
                                                    <p class="text-avaiable">
                                                        Available: <span class="fw-bold text-black">57</span>
                                                    </p>
                                                    <p class="text-avaiable">
                                                        Sold: <span class="fw-bold text-black">72</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product 2 -->
                                <div class="swiper-slide">
                                    <div class="card-product style-5 style-padding">
                                        <div class="card-product_wrapper aspect-ratio-0 d-flex">
                                            <a href="javascript:void(0)" class="product-img">
                                                <img class="lazyload img-product" src="images/products/electronic/product-11.jpg"
                                                    data-src="images/products/electronic/product-11.jpg" alt="Product">
                                                <img class="lazyload img-hover" src="images/products/electronic/product-12.jpg"
                                                    data-src="images/products/electronic/product-12.jpg" alt="Product">
                                            </a>
                                            <ul class="product-action_list">
                                                <li>
                                                    <a href="#shoppingCart" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon">
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
                                        </div>
                                        <div class="card-product_info d-grid">
                                            <p class="tag-product text-small">Headphone</p>
                                            <h6 class="name-product">
                                                <a href="javascript:void(0)" class="link">Sony WH-1000XM4 Wireless Premium Noise Canceling Overhead
                                                    Headphones</a>
                                            </h6>
                                            <div class="rate_wrap w-100">
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                                <i class="icon-star text-star"></i>
                                            </div>
                                            <div class="price-wrap">
                                                <h4 class="price-new">$300.00</h4>
                                                <span class="price-old h6">$499.00</span>
                                            </div>
                                            <div class="product-progress_sold">
                                                <div class="progress-sold progress" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 30%"></div>
                                                </div>
                                                <div class="box-quantity">
                                                    <p class="text-avaiable">
                                                        Available: <span class="fw-bold text-black">40</span>
                                                    </p>
                                                    <p class="text-avaiable">
                                                        Sold: <span class="fw-bold text-black">120</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tf-sw-nav type-small-2 nav-prev-swiper d-xl-flex">
                            <i class="icon icon-arrow-left"></i>
                        </div>
                        <div class="tf-sw-nav type-small-2 nav-next-swiper d-xl-flex">
                            <i class="icon icon-arrow-right"></i>
                        </div>
                    </div>
                    <div class="sw-dot-default-2 tf-sw-pagination"></div>
                </div>
            </div>
        </section>
        <!-- /Product On Sale -->
        <!-- Best Seller -->
        <section class="flat-spacing">
            <div class="container">
                <div class="sect-title type-3 type-2 wow fadeInUp">
                    <h2 class="s-title type-semibold text-nowrap">Product Best Sellers</h2>
                    <a href="javascript:void(0)" class="tf-btn-icon h6 fw-medium text-nowrap">
                        View All Product
                        <i class="icon icon-caret-circle-right"></i>
                    </a>
                </div>
                <div dir="ltr" class="swiper tf-swiper wow fadeInUp" data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="2"
                    data-space-lg="48" data-space-md="24" data-space="12" data-pagination="2" data-pagination-sm="2" data-pagination-md="3"
                    data-pagination-lg="4">
                    <div class="swiper-wrapper">
                                                              @isset($categories2)
    @foreach ($categories2 as $category)
        @foreach ($category->products as $product)
            <div class="swiper-slide">
                <div class="card-product style-5">
                    <div class="card-product_wrapper aspect-ratio-0 d-flex">
                        <a href="javascript:void(0)" class="product-img">
                            <img class="lazyload img-product" 
                                src="{{ asset($product->images) }}" 
                                data-src="{{ asset($product->images) }}" 
                                alt="{{ $product->name }}">
                        </a>
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
                                <a href="#quickView" data-bs-toggle="modal" class="hover-tooltip tooltip-left box-icon">
                                    <span class="icon icon-view"></span>
                                    <span class="tooltip">Quick view</span>
                                </a>
                            </li>
                        </ul>
                        <div class="wg-quantity mb-2" style="display: none; justify-content: center;">
                            <button type="button" class="btn-quantity btn-decrease">
                                <i class="icon icon-minus"></i>
                            </button>
                            <input class="quantity-product" type="number" name="quantity" value="1" min="1" style="width: 50px; text-align: center;">
                            <button type="button" class="btn-quantity btn-increase">
                                <i class="icon icon-plus"></i>
                            </button>
                        </div>                        @if($product->base_price > $product->selling_price)
                            <ul class="product-badge_list">
                                <li class="product-badge_item h6 sale">
                                    -{{ round((($product->base_price - $product->selling_price) / $product->base_price) * 100) }}%
                                </li>
                            </ul>
                        @endif
                    </div>
                    <div class="card-product_info d-grid">
                        <p class="tag-product text-small">{{ $category->name }}</p>
                        <h6 class="name-product">
                            <a href="{{ route('product.show', $product->slug) }}" class="link">{{ $product->name }}</a>
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
        @endforeach
    @endforeach
@endisset
                            </div>
                    <div class="sw-dot-default tf-sw-pagination d-xl-none"></div>
                </div>
            </div>
        </section>
        <!-- /Best Seller -->
        <!-- Voucher -->
        <section>
            <div class="container">
                <div class="banner-V02 hover-img wow fadeInUp">
                    <div class="banner_img img-style">
                        <img src="{{asset('images/'.$banner->image??'')}}" data-src="{{asset('images/'.$banner->image??'')}}" alt="Banner" class="lazyload">
                    </div>
                    <div class="banner_content">
                        <div class="box-text">
                            <h2 class="title type-semibold">
                                <a href="javascript:void(0)" class="text-primary">{{$banner->title??''}}</a>
                            </h2>
                            <h4 class="sub-title fw-bold">{{$banner->subtitle??''}}></h4>
                        </div>
                        <div class="group-btn">
                            <a href="javascript:void(0)" class="tf-btn animate-btn type-small-3">
                                 {{$banner->p1text??''}}
                                <i class="icon icon-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Voucher -->
        <!-- Feature -->
        <section class="flat-spacing">
            <div class="container">
                <div class="sect-title type-3 type-2 wow fadeInUp">
                    <h2 class="s-title type-semibold">Featured Products</h2>
                    <a href="javascript:void(0)" class="tf-btn-icon h6 fw-medium">
                        View All Product
                        <i class="icon icon-caret-circle-right"></i>
                    </a>
                </div>
                <div dir="ltr" class="swiper tf-swiper wrap-sw-over wow fadeInUp" data-preview="3" data-tablet="2" data-mobile-sm="1" data-mobile="1"
                    data-space-lg="48" data-space-md="24" data-space="12" data-pagination="1" data-pagination-sm="1" data-pagination-md="2"
                    data-pagination-lg="3" data-grid="2">
                <div class="swiper-wrapper">
                    <!-- Product 1 -->
                    <div class="swiper-slide">
                        <div class="card-product product-style_list-mini type-2 hover-img">
                            <div class="card-product_wrapper">
                                <a href="javascript:void(0)" class="product-img img-style">
                                    <img class="img-product lazyload" src="{{asset('front-end/images/products/crackers/auto-bomb.jpg')}}"
                                        data-src="{{asset('front-end/images/products/crackers/auto-bomb.jpg')}}" alt="Auto Bomb">
                                </a>
                            </div>
                            <div class="card-product_info">
                                <p class="tag-product text-small">Bomb</p>
                                <h6 class="name-product">
                                    <a href="javascript:void(0)" class="text-line-clamp-2 link">Auto Bomb – Loud & Thrilling Blast</a>
                                </h6>
                                <div class="group-action">
                                    <div class="price-wrap mb-0">
                                        <h4 class="price-new">₹199.00</h4>
                                        <span class="price-old h6">₹249.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 2 -->
                    <div class="swiper-slide">
                        <div class="card-product product-style_list-mini type-2 hover-img">
                            <div class="card-product_wrapper">
                                <a href="javascript:void(0)" class="product-img img-style">
                                    <img class="img-product lazyload" src="{{asset('front-end/images/products/crackers/sky-shots.jpg')}}"
                                        data-src="{{asset('front-end/images/products/crackers/sky-shots.jpg')}}" alt="Rocket">
                                </a>
                            </div>
                            <div class="card-product_info">
                                <p class="tag-product text-small">Rocket</p>
                                <h6 class="name-product">
                                    <a href="javascript:void(0)" class="text-line-clamp-2 link">Sky Rocket – Colorful Burst</a>
                                </h6>
                                <div class="group-action">
                                    <div class="price-wrap mb-0">
                                        <h4 class="price-new">₹299.00</h4>
                                        <span class="price-old h6">₹349.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 3 -->
                    <div class="swiper-slide">
                        <div class="card-product product-style_list-mini type-2 hover-img">
                            <div class="card-product_wrapper">
                                <a href="javascript:void(0)" class="product-img img-style">
                                    <img class="img-product lazyload" src="{{asset('front-end/images/products/crackers/flower-pot.jpg')}}"
                                        data-src="{{asset('front-end/images/products/crackers/flower-pot.jpg')}}" alt="Flower Pot">
                                </a>
                            </div>
                            <div class="card-product_info">
                                <p class="tag-product text-small">Fountain</p>
                                <h6 class="name-product">
                                    <a href="javascript:void(0)" class="text-line-clamp-2 link">Flower Pots – Sparkling Showers</a>
                                </h6>
                                <div class="group-action">
                                    <div class="price-wrap mb-0">
                                        <h4 class="price-new">₹149.00</h4>
                                        <span class="price-old h6">₹199.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 4 -->
                    <div class="swiper-slide">
                        <div class="card-product product-style_list-mini type-2 hover-img">
                            <div class="card-product_wrapper">
                                <a href="javascript:void(0)" class="product-img img-style">
                                    <img class="img-product lazyload" src="{{asset('front-end/images/products/crackers/ground-chakra.webp')}}"
                                        data-src="{{asset('front-end/images/products/crackers/ground-chakra.webp')}}" alt="Ground Chakra">
                                </a>
                            </div>
                            <div class="card-product_info">
                                <p class="tag-product text-small">Spinner</p>
                                <h6 class="name-product">
                                    <a href="javascript:void(0)" class="text-line-clamp-2 link">Ground Chakras – Spinning Sparks</a>
                                </h6>
                                <div class="group-action">
                                    <div class="price-wrap mb-0">
                                        <h4 class="price-new">₹179.00</h4>
                                        <span class="price-old h6">₹229.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 5 -->
                    <div class="swiper-slide">
                        <div class="card-product product-style_list-mini type-2 hover-img">
                            <div class="card-product_wrapper">
                                <a href="javascript:void(0)" class="product-img img-style">
                                    <img class="img-product lazyload" src="{{asset('front-end/images/products/crackers/sparklers.png')}}"
                                        data-src="{{asset('front-end/images/products/crackers/sparklers.png')}}" alt="Sparklers">
                                </a>
                            </div>
                            <div class="card-product_info">
                                <p class="tag-product text-small">Kids Special</p>
                                <h6 class="name-product">
                                    <a href="javascript:void(0)" class="text-line-clamp-2 link">Sparklers – Safe & Fun</a>
                                </h6>
                                <div class="group-action">
                                    <div class="price-wrap mb-0">
                                        <h4 class="price-new">₹99.00</h4>
                                        <span class="price-old h6">₹129.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 6 -->
                    <div class="swiper-slide">
                        <div class="card-product product-style_list-mini type-2 hover-img">
                            <div class="card-product_wrapper">
                                <a href="javascript:void(0)" class="product-img img-style">
                                    <img class="img-product lazyload" src="{{asset('front-end/images/products/crackers/garland.jpg')}}"
                                        data-src="{{asset('front-end/images/products/crackers/garland.jpg')}}" alt="Garland Crackers">
                                </a>
                            </div>
                            <div class="card-product_info">
                                <p class="tag-product text-small">Garland</p>
                                <h6 class="name-product">
                                    <a href="javascript:void(0)" class="text-line-clamp-2 link">1000 Wala Garland Crackers</a>
                                </h6>
                                <div class="group-action">
                                    <div class="price-wrap mb-0">
                                        <h4 class="price-new">₹499.00</h4>
                                        <span class="price-old h6">₹549.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 7 (with asset) -->
                    <div class="swiper-slide">
                        <div class="card-product product-style_list-mini type-2 hover-img">
                            <div class="card-product_wrapper">
                                <a href="javascript:void(0)" class="product-img img-style">
                                    <img class="img-product lazyload" src="{{asset('front-end/images/products/crackers/sky-shots.jpg')}}"
                                        data-src="{{asset('front-end/images/products/crackers/sky-shots.jpg')}}" alt="Sky Shots">
                                </a>
                            </div>
                            <div class="card-product_info">
                                <p class="tag-product text-small">Sky Show</p>
                                <h6 class="name-product">
                                    <a href="javascript:void(0)" class="text-line-clamp-2 link">Sky Shots – Multicolor Bursts</a>
                                </h6>
                                <div class="group-action">
                                    <div class="price-wrap mb-0">
                                        <h4 class="price-new">₹699.00</h4>
                                        <span class="price-old h6">₹799.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 8 (with asset) -->
                    <div class="swiper-slide">
                        <div class="card-product product-style_list-mini type-2 hover-img">
                            <div class="card-product_wrapper">
                                <a href="javascript:void(0)" class="product-img img-style">
                                    <img class="img-product lazyload" src="{{asset('front-end/images/products/crackers/whistling-rocket.png')}}"
                                        data-src="{{asset('front-end/images/products/crackers/whistling-rocket.png')}}" alt="Whistling Rocket">
                                </a>
                            </div>
                            <div class="card-product_info">
                                <p class="tag-product text-small">Rocket</p>
                                <h6 class="name-product">
                                    <a href="javascript:void(0)" class="text-line-clamp-2 link">Whistling Rockets – High Sky Sound</a>
                                </h6>
                                <div class="group-action">
                                    <div class="price-wrap mb-0">
                                        <h4 class="price-new">₹399.00</h4>
                                        <span class="price-old h6">₹459.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                    <div class="sw-dot-default tf-sw-pagination"></div>
                </div>
            </div>
        </section>
        <!-- Feature -->
        <!-- Best Seller -->
        <section class="flat-spacing pt-0">
            <div class="container">
                <div class="sect-title type-3 type-2 wow fadeInUp">
                    <h2 class="s-title type-semibold text-nowrap">Voucher & Promotional</h2>
                    <a href="javascript:void(0)" class="tf-btn-icon h6 fw-medium text-nowrap">
                        View All Product
                        <i class="icon icon-caret-circle-right"></i>
                    </a>
                </div>
                <div dir="ltr" class="swiper tf-swiper wow fadeInUp" data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="2"
                    data-space-lg="48" data-space-md="24" data-space="12" data-pagination="2" data-pagination-sm="2" data-pagination-md="3"
                    data-pagination-lg="4">
                  <div class="swiper-wrapper">
                                <!-- Product 1 -->
                                <div class="swiper-slide">
                                    <div class="card-product style-5">
                                        <div class="card-product_wrapper aspect-ratio-0 d-flex">
                                            <a href="javascript:void(0)" class="product-img">
                                                <img class="lazyload img-product" src="{{asset('front-end/images/products/crackers/sparklers.jpg')}}"
                                                    data-src="{{asset('front-end/images/products/crackers/sparklers.jpg')}}" alt="Sparklers">
                                            </a>
                                            <ul class="product-action_list">
                                                <li>
                                                    <a href="#shoppingCart" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon">
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
                                            <ul class="product-badge_list">
                                                <li class="product-badge_item h6 sale">-20%</li>
                                            </ul>
                                        </div>
                                        <div class="card-product_info d-grid">
                                            <p class="tag-product text-small">Sparklers</p>
                                            <h6 class="name-product">
                                                <a href="javascript:void(0)" class="link">Colorful Sparklers Pack (50 pcs)</a>
                                            </h6>
                                            <div class="rate_wrap w-100">
                                                <i class="icon-star text-star"></i><i class="icon-star text-star"></i><i class="icon-star text-star"></i><i class="icon-star text-star"></i><i class="icon-star text-star"></i>
                                            </div>
                                            <div class="price-wrap mb-0">
                                                <h4 class="price-new">₹299</h4>
                                                <span class="price-old h6">₹375</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product 2 -->
                                <div class="swiper-slide">
                                    <div class="card-product style-5">
                                        <div class="card-product_wrapper aspect-ratio-0 d-flex">
                                            <a href="javascript:void(0)" class="product-img">
                                                <img class="lazyload img-product" src="{{asset('front-end/images/products/crackers/flowerpot.jpg')}}"
                                                    data-src="{{asset('front-end/images/products/crackers/flowerpot.jpg')}}" alt="Flower Pots">
                                            </a>
                                            <ul class="product-action_list">
                                                <li>
                                                    <a href="#shoppingCart" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon">
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
                                            <ul class="product-badge_list">
                                                <li class="product-badge_item h6 sale">-15%</li>
                                            </ul>
                                        </div>
                                        <div class="card-product_info d-grid">
                                            <p class="tag-product text-small">Flower Pots</p>
                                            <h6 class="name-product">
                                                <a href="javascript:void(0)" class="link">Flower Pots (Anar) – Mega Pack</a>
                                            </h6>
                                            <div class="rate_wrap w-100">
                                                <i class="icon-star text-star"></i><i class="icon-star text-star"></i><i class="icon-star text-star"></i><i class="icon-star text-star"></i><i class="icon-star text-star"></i>
                                            </div>
                                            <div class="price-wrap mb-0">
                                                <h4 class="price-new">₹499</h4>
                                                <span class="price-old h6">₹590</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product 3 -->
                                <div class="swiper-slide">
                                    <div class="card-product style-5">
                                        <div class="card-product_wrapper aspect-ratio-0 d-flex">
                                            <a href="javascript:void(0)" class="product-img">
                                                <img class="lazyload img-product" src="{{asset('front-end/images/products/crackers/rockets.png')}}"
                                                    data-src="{{asset('front-end/images/products/crackers/rockets.png')}}" alt="Rockets">
                                            </a>
                                            <ul class="product-action_list">
                                                <li>
                                                    <a href="#shoppingCart" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon">
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
                                            <ul class="product-badge_list">
                                                <li class="product-badge_item h6 sale">-25%</li>
                                            </ul>
                                        </div>
                                        <div class="card-product_info d-grid">
                                            <p class="tag-product text-small">Rockets</p>
                                            <h6 class="name-product">
                                                <a href="javascript:void(0)" class="link">Sky Rocket Assorted Pack (12 pcs)</a>
                                            </h6>
                                            <div class="rate_wrap w-100">
                                                <i class="icon-star text-star"></i><i class="icon-star text-star"></i><i class="icon-star text-star"></i><i class="icon-star text-star"></i><i class="icon-star text-star"></i>
                                            </div>
                                            <div class="price-wrap mb-0">
                                                <h4 class="price-new">₹699</h4>
                                                <span class="price-old h6">₹899</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product 4 -->
                                <div class="swiper-slide">
                                    <div class="card-product style-5">
                                        <div class="card-product_wrapper aspect-ratio-0 d-flex">
                                            <a href="javascript:void(0)" class="product-img">
                                                <img class="lazyload img-product" src="{{asset('front-end/images/products/crackers/bombs.jpg')}}"
                                                    data-src="{{asset('front-end/images/products/crackers/bombs.jpg')}}" alt="Bombs">
                                            </a>
                                            <ul class="product-action_list">
                                                <li>
                                                    <a href="#shoppingCart" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon">
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
                                            <ul class="product-badge_list">
                                                <li class="product-badge_item h6 sale">-30%</li>
                                            </ul>
                                        </div>
                                        <div class="card-product_info d-grid">
                                            <p class="tag-product text-small">Bombs</p>
                                            <h6 class="name-product">
                                                <a href="javascript:void(0)" class="link">Classic Sound Bombs (20 pcs)</a>
                                            </h6>
                                            <div class="rate_wrap w-100">
                                                <i class="icon-star text-star"></i><i class="icon-star text-star"></i><i class="icon-star text-star"></i><i class="icon-star text-star"></i><i class="icon-star text-star"></i>
                                            </div>
                                            <div class="price-wrap mb-0">
                                                <h4 class="price-new">₹199</h4>
                                                <span class="price-old h6">₹280</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <div class="sw-dot-default tf-sw-pagination d-xl-none"></div>
                </div>
            </div>
        </section>
        <!-- /Best Seller -->
       <!-- Blog -->
        <section>
            <div class="container">
                <div class="sect-title type-3 type-2 wow fadeInUp">
                    <h2 class="s-title type-semibold text-nowrap">Cracker Stories</h2>
                    <a href="javascript:void(0)" class="tf-btn-icon h6 fw-medium text-nowrap">
                        View All Blog
                        <i class="icon icon-caret-circle-right"></i>
                    </a>
                </div>
                <div dir="ltr" class="swiper tf-swiper" data-preview="3" data-tablet="3" data-mobile-sm="2" data-mobile="1" 
                    data-space-lg="48" data-space-md="32" data-space="12" 
                    data-pagination="1" data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="3">
                   @props(['blogs'])

                    @isset($blogs)
                        <div class="swiper-wrapper">
                            @foreach($blogs as $blog)
                            <div class="swiper-slide">
                                <div class="article-blog type-space-2 hover-img4 wow fadeInLeft">
                                    <a href="{{ route('blog-user.show', $blog->slug) }}" class="entry_image img-style4">
                                        <img src="{{ $blog->image }}" data-src="{{ $blog->image }}" alt="{{ $blog->title }}" class="lazyload aspect-ratio-0">
                                    </a>
                                    <div class="entry_tag">
                                        <a href="javascript:void(0)" class="name-tag h6 link">
                                            {{ $blog->published_at->format('F j, Y') }}
                                        </a>
                                    </div>
                                    <div class="blog-content">
                                        <a href="{{ route('blog-user.show', $blog->slug) }}" class="entry_name link h4">
                                            {{ $blog->title }}
                                        </a>
                                        <p class="text h6">
                                            {{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 120) }}
                                        </p>
                                        <a href="{{ route('blog-user.show', $blog->slug) }}" class="tf-btn-line">Read more</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endisset
                     
                    </div>
                    
                    <div class="sw-dot-default tf-sw-pagination"></div>
                </div>
            </div>
        </section>
        <!-- /Blog -->


    </div>

    <!-- Mobile Menu -->
    {{-- <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <span class="icon-close-popup" data-bs-dismiss="offcanvas">
            <i class="icon-close"></i>
        </span>
        <div class="canvas-header">
            <p class="text-logo-mb">Ochaka.</p>
            <a javascript:void(0)" class="tf-btn type-small style-2">
                Login
                <i class="icon icon-user"></i>
            </a>
            <span class="br-line"></span>
        </div>
        <div class="canvas-body">
            <div class="mb-content-top">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation"></ul>
            </div>
            <div class="group-btn">
               
                <div data-bs-dismiss="offcanvas">
                    <a href="#search" data-bs-toggle="modal" class="tf-btn type-small style-2">
                        Search
                        <i class="icon icon-magnifying-glass"></i>
                    </a>
                </div>
            </div>
            <div class="flow-us-wrap">
                <h5 class="title">Follow us on</h5>
                <ul class="tf-social-icon">
                    <li>
                        <a href="https://www.facebook.com/" target="_blank" class="social-facebook">
                            <span class="icon"><i class="icon-fb"></i></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/" target="_blank" class="social-instagram">
                            <span class="icon"><i class="icon-instagram-logo"></i></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://x.com/" target="_blank" class="social-x">
                            <span class="icon"><i class="icon-x"></i></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.tiktok.com/" target="_blank" class="social-tiktok">
                            <span class="icon"><i class="icon-tiktok"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="payment-wrap">
                <h5 class="title">Payment:</h5>
                <ul class="payment-method-list">
                    <li><img src="images/payment/visa.png" alt="Payment"></li>
                    <li><img src="images/payment/master-card.png" alt="Payment"></li>
                    <li><img src="images/payment/amex.png" alt="Payment"></li>
                    <li><img src="images/payment/discover.png" alt="Payment"></li>
                    <li><img src="images/payment/paypal.png" alt="Payment"></li>
                </ul>
            </div>
        </div>
        <div class="canvas-footer">
            <div class="tf-currencies">
                <select class="tf-dropdown-select style-default type-currencies">
                    <option selected data-thumbnail="images/country/us.png">USD</option>
                    <option data-thumbnail="images/country/vie.png">VND</option>
                </select>
            </div>
            <span class="br-line"></span>
            <div class="tf-languages">
                <select class="tf-dropdown-select style-default type-languages">
                    <option>English</option>
                    <option>العربية</option>
                    <option>简体中文</option>
                    <option>اردو</option>
                </select>
            </div>
        </div>
    </div> --}}
    <!-- /Mobile Menu -->

    <!-- Toolbar -->
    <div class="tf-toolbar-bottom">
        <div class="toolbar-item">
            <a href="javascript:void(0)">
                <span class="toolbar-icon">
                    <i class="icon icon-storefront"></i>
                </span>
                <span class="toolbar-label">Cateories</span>
            </a>
        </div>
        <div class="toolbar-item">
            <a href="#search" data-bs-toggle="modal">
                <span class="toolbar-icon">
                    <i class="icon icon-magnifying-glass"></i>
                </span>
                <span class="toolbar-label">Search</span>
            </a>
        </div>
        <div class="toolbar-item">
            <a href="javascript:void(0)">
                <span class="toolbar-icon">
                    <i class="icon icon-user"></i>
                </span>
                <span class="toolbar-label">Account</span>
            </a>
        </div>
        <div class="toolbar-item">
            <a href="javascript:void(0)">
                <span class="toolbar-icon">
                    <i class="icon icon-shopping-cart-simple"></i>
                    <span class="toolbar-count">24</span>
                </span>
                <span class="toolbar-label">Cart</span>
            </a>
        </div>
    </div>
    <!-- /Toolbar -->

    <!-- Size Guide -->
    <div class="modal modalCentered fade modal-size-guide" id="size-guide">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content widget-tabs style-2">
                <div class="header">
                    <ul class="widget-menu-tab">
                        <li class="item-title active">
                            <span class="inner h3">Size </span>
                        </li>
                        <li class="item-title">
                            <span class="inner h3">Size Guide</span>
                        </li>
                    </ul>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="widget-content-tab">
                        <div class="widget-content-inner active">
                            <div class="tab-size">
                                <div>
                                    <div class="widget-size mb-24">
                                        <div class="box-title-size">
                                            <div class="title-size h6 text-black">Height</div>
                                            <div class="number-size text-small">
                                                <span class="max-size">100</span>
                                                <span class="">Cm</span>
                                            </div>
                                        </div>
                                        <div class="range-input">
                                            <div class="tow-bar-block">
                                                <div class="progress-size" style="width: 50%;"></div>
                                            </div>
                                            <input type="range" min="0" max="200" value="100" class="range-max">
                                        </div>
                                    </div>
                                    <div class="widget-size">
                                        <div class="box-title-size">
                                            <div class="title-size h6 text-black">Weight</div>
                                            <div class="number-size text-small">
                                                <span class="max-size">50</span>
                                                <span class="">Kg</span>
                                            </div>
                                        </div>
                                        <div class="range-input">
                                            <div class="tow-bar-block">
                                                <div class="progress-size" style="width: 50%;"></div>
                                            </div>
                                            <input type="range" min="0" max="100" value="50" class="range-max">
                                        </div>
                                    </div>
                                </div>
                                <div class="size-button-wrap choose-option-list">
                                    <div class="size-button-item choose-option-item">
                                        <h6 class="text">Thin</h6>
                                    </div>
                                    <div class="size-button-item choose-option-item select-option">
                                        <h6 class="text">Normal</h6>
                                    </div>
                                    <div class="size-button-item choose-option-item">
                                        <h6 class="text">Plump</h6>
                                    </div>
                                </div>
                                <div class="suggests">
                                    <h4 class="">Suggests for you:</h4>
                                    <div class="suggests-list">
                                        <a href="#" class="suggests-item link h6">L - shirt</a>
                                        <a href="#" class="suggests-item link h6">XL - Pant</a>
                                        <a href="#" class="suggests-item link h6">31 - Jeans</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-inner overflow-auto text-nowrap">
                            <table class="tab-sizeguide-table">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>US</th>
                                        <th>Bust</th>
                                        <th>Waist</th>
                                        <th>Low Hip</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>XS</td>
                                        <td>2</td>
                                        <td>32</td>
                                        <td>24 - 25</td>
                                        <td>33 - 34</td>
                                    </tr>
                                    <tr>
                                        <td>S</td>
                                        <td>4</td>
                                        <td>26 - 27</td>
                                        <td>34 - 35</td>
                                        <td>35 - 26</td>
                                    </tr>
                                    <tr>
                                        <td>M</td>
                                        <td>6</td>
                                        <td>28 - 29</td>
                                        <td>36 - 37</td>
                                        <td>38 - 40</td>
                                    </tr>
                                    <tr>
                                        <td>L</td>
                                        <td>8</td>
                                        <td>30 - 31</td>
                                        <td>38 - 29</td>
                                        <td>42 - 44</td>
                                    </tr>
                                    <tr>
                                        <td>XL</td>
                                        <td>10</td>
                                        <td>32 - 33</td>
                                        <td>40 - 41</td>
                                        <td>45 - 47</td>
                                    </tr>
                                    <tr>
                                        <td>XXL</td>
                                        <td>12</td>
                                        <td>34 - 35</td>
                                        <td>42 - 43</td>
                                        <td>48 - 50</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Size Guide -->

@endsection
@php
    $buy = App\Models\Property::where('status', 1)
        ->orderBy('sort_order', 'asc')
        ->get();
        $genaral = App\Models\GeneralDetail::find(1);
         $categories = App\Models\Property::where('status', 1)
        ->orderBy('sort_order', 'asc')
        ->take(9)
        ->get();
@endphp
        <!-- Footer -->
        <footer class="tf-footer">
            <div class="container d-flex">
                <span class="br-line"></span>
            </div>
            <div class="footer-body">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 mb_30 mb-xl-0">
                            <div class="footer-col-block">
                                <p class="footer-heading footer-heading-mobile">Contact us</p>
                                <div class="tf-collapse-content">
                                    <ul class="footer-contact">
                                        <li>
                                            <i class="icon icon-map-pin"></i>
                                            <span class="br-line"></span>
                                            <a href="https://www.google.com/maps?q=8500+Lorem+Street+Chicago,+IL+55030+Dolor+sit+amet" target="_blank"
                                                class="h6 link">
                                                {{isset($genaral->address)?$genaral->address:''}}
                                            </a>
                                        </li>
                                        <li>
                                            <i class="icon icon-phone"></i>
                                            <span class="br-line"></span>
                                            @if(isset($genaral->phone))
                                                @foreach(explode(',', $genaral->phone) as $phone)
                                                    <a href="tel:{{ trim($phone) }}" class="h6 link">{{ trim($phone) }}</a>
                                                @endforeach
                                            @endif
                                        </li>
                                        <li>
                                            <i class="icon icon-envelope-simple"></i>
                                            <span class="br-line"></span>
                                            <a href="mailto: {{isset($genaral->email)?$genaral->email:''}}" class="h6 link"> {{isset($genaral->email)?$genaral->email:''}}</a>
                                        </li>
                                    </ul>
                                    <div class="social-wrap">
                                        <ul class="tf-social-icon">
                                            <li>
                                                <a href="{{isset($genaral->facebook)?$genaral->facebook:''}}" target="_blank" class="social-facebook">
                                                    <span class="icon"><i class="icon-fb"></i></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{isset($genaral->instagram)?$genaral->instagram:''}}" target="_blank" class="social-instagram">
                                                    <span class="icon"><i class="icon-instagram-logo"></i></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{isset($genaral->twitter)?$genaral->twitter:''}}" target="_blank" class="social-x">
                                                    <span class="icon"><i class="icon-x"></i></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{isset($genaral->linkedin)?$genaral->linkedin:''}}" target="_blank" class="social-tiktok">
                                                    <span class="icon"><i class="icon-tiktok"></i></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6 mb_30 mb-xl-0">
                            <div class="footer-col-block footer-wrap-1 ms-xl-auto">
                                <p class="footer-heading footer-heading-mobile">Categories</p>
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                         @foreach($categories as $category)
                                                <li class="link" rel="{{ $category->slug }}">
                                                    <a href="{{ route('product.category', ['slug' => $category->slug]) }}">
                                                        <span>{{ $category->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb_30 mb-sm-0">
                            <div class="footer-col-block footer-wrap-2 mx-xl-auto">
                                <p class="footer-heading footer-heading-mobile">Information</p>
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                        <li><a href="{{ route('about.us.view') }}" class="link h6">About Us</a></li>
                                        <li><a href="{{ route('terms.conditions.view') }}" class="link h6">Term & Policy</a></li>
                                        <li><a href="{{ route('privacy.policy.view') }}" class="link h6">Privacy Policy</a></li>
                                        <li><a href="{{route('blog.list')}}" class="link h6">Blog</a></li>
                                        <!-- <li><a href="javascript:void(0)" class="link h6">Refunds</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="footer-col-block">
                                <p class="footer-heading footer-heading-mobile">Let’s keep in touch</p>
                                <div class="tf-collapse-content">
                                    <div class="footer-newsletter">
                                        <p class="h6 caption">
                                          {{isset($genaral->description)?$genaral->description:''}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /Footer -->

    <!-- Quick View -->
    <div class="modal modalCentered fade modal-quick-view" id="quickView">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <i class="icon icon-close icon-close-popup" data-bs-dismiss="modal"></i>
                <div class="tf-product-media-wrap tf-btn-swiper-item">
                    <div dir="ltr" class="swiper tf-single-slide">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" data-size="XS" data-color="beige">
                                <div class="item">
                                    <img class="lazyload"  alt="">
                                </div>
                            </div>
                            <div class="swiper-slide" data-size="S" data-color="blue">
                                <div class="item">
                                    <img class="lazyload"  alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tf-product-info-wrap">
                    <div class="tf-product-info-inner tf-product-info-list">
                        <div class="tf-product-info-heading">
                            <a href="javascript:void(0)" class="link product-info-name fw-medium h1">
                                Casual Round Neck T-Shirt
                            </a>
                            <div class="product-info-meta">
                                <div class="rating">
                                    <div class="d-flex gap-4">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 5.4091L8.913 5.07466L6.99721 0.261719L5.08143 5.07466L0 5.4091L3.89741 8.7184L2.61849 13.7384L6.99721 10.9707L11.376 13.7384L10.097 8.7184L14 5.4091Z"
                                                fill="#EF9122" />
                                        </svg>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 5.4091L8.913 5.07466L6.99721 0.261719L5.08143 5.07466L0 5.4091L3.89741 8.7184L2.61849 13.7384L6.99721 10.9707L11.376 13.7384L10.097 8.7184L14 5.4091Z"
                                                fill="#EF9122" />
                                        </svg>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 5.4091L8.913 5.07466L6.99721 0.261719L5.08143 5.07466L0 5.4091L3.89741 8.7184L2.61849 13.7384L6.99721 10.9707L11.376 13.7384L10.097 8.7184L14 5.4091Z"
                                                fill="#EF9122" />
                                        </svg>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 5.4091L8.913 5.07466L6.99721 0.261719L5.08143 5.07466L0 5.4091L3.89741 8.7184L2.61849 13.7384L6.99721 10.9707L11.376 13.7384L10.097 8.7184L14 5.4091Z"
                                                fill="#EF9122" />
                                        </svg>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 5.4091L8.913 5.07466L6.99721 0.261719L5.08143 5.07466L0 5.4091L3.89741 8.7184L2.61849 13.7384L6.99721 10.9707L11.376 13.7384L10.097 8.7184L14 5.4091Z"
                                                fill="#EF9122" />
                                        </svg>
                                    </div>
                                    <div class="reviews text-main">(3.671 review)</div>
                                </div>
                                <div class="people-add text-primary">
                                    <i class="icon icon-shopping-cart-simple"></i>
                                    <span class="h6">9 people just added this product to their cart</span>
                                </div>
                            </div>
                            <div class="product-info-price">
                                <div class="price-wrap">
                                    <span class="price-new price-on-sale h2">$ 14.99</span>
                                    <span class="price-old compare-at-price h6">$ 24.99</span>
                                    <p class="badges-on-sale h6 fw-semibold">
                                        <span class="number-sale" data-person-sale="29">
                                            -29 %
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <p class="product-infor-sub text-main h6">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse justo dolor, consectetur vel metus vitae,
                                tincidunt finibus dui fusce tellus enim.
                            </p>
                        </div>
                        <div class="tf-product-variant w-100">
                            <div class="variant-picker-item variant-size d-none">
                                <div class="variant-picker-label">
                                    <div class="h4 fw-semibold">
                                        Size
                                        <span class="variant-picker-label-value value-currentSize">medium</span>
                                    </div>
                                    <a href="#size-guide" data-bs-toggle="modal" class="size-guide link h6 fw-medium">
                                        <i class="icon icon-ruler"></i>
                                        Size Guide
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tf-product-total-quantity w-100">
                            <div class="group-btn">
                                <div class="wg-quantity">
                                    <button class="btn-quantity btn-decrease">
                                        <i class="icon icon-minus"></i>
                                    </button>
                                    <input class="quantity-product" type="text" name="number" value="1">
                                    <button class="btn-quantity btn-increase">
                                        <i class="icon icon-plus"></i>
                                    </button>
                                </div>
                                <p class="h6 d-none d-sm-block">
                                    15 products available
                                </p>
                            </div>
                            <div class="group-btn flex-sm-nowrap">
                                <a href="#shoppingCart" data-bs-toggle="offcanvas" 
                                   class="tf-btn animate-btn btn-add-to-cart add-to-cart-btn"
                                   data-product-id="">
                                      Add to cart
                                     <i class="icon icon-shopping-cart-simple"></i>
                                </a>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="tf-btn-line text-normal letter-space-0 fw-normal">
                            <span class="h5">View full details</span>
                            <i class="icon icon-arrow-top-right fs-24"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Quick View -->

    <!-- Shopping Cart -->
    <div class="offcanvas offcanvas-end popup-shopping-cart" id="shoppingCart">
        <div class="canvas-wrapper">
            <div class="popup-header">
                <span class="title fw-semibold h4">Shopping cart</span>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas"></span>
            </div>
            <div class="wrap">
                <div class="tf-mini-cart-wrap list-file-delete wrap-empty_text">
                    <div class="tf-mini-cart-main">
                        <div class="tf-mini-cart-sroll">
                            <div class="tf-mini-cart-items list-empty">
                                <div class="box-text_empty type-shop_cart">
                                    <div class="empty_top">
                                        <span class="icon">
                                            <i class="icon-shopping-cart-simple"></i>
                                        </span>
                                        <h3 class="text-emp fw-normal">Your cart is empty</h3>
                                        <p class="h6 text-main">
                                            Your cart is currently empty. Let us assist you in finding the right product
                                        </p>
                                    </div>
                                    <div class="empty_bot">
                                        <a href="javascript:void(0)" class="tf-btn animate-btn">
                                            Shopping
                                        </a>
                                        <a href="javascript:void(0)" class="tf-btn style-line">
                                            Back to home
                                        </a>
                                    </div>
                                </div>
                                <div class="tf-mini-cart-item file-delete">
                                    <div class="tf-mini-cart-image">
                                        <img class="lazyload" data-src="images/products/electronic/product-17.jpg"
                                            src="images/products/electronic/product-17.jpg" alt="img-product">
                                    </div>
                                    <div class="tf-mini-cart-info">
                                        <div class="text-small text-main-2 sub">T-shirt</div>
                                        <h6 class="title">
                                            <a href="javascript:void(0)" class="link text-line-clamp-1">Queen fashion long sleeve shirt, basic
                                                t-shirt</a>
                                        </h6>
                                        <div class="size">
                                            <div class="text-small text-main-2 sub">Size: XS</div>
                                            <div class="text-small text-main-2 sub">Color:</div>
                                            <div class="dot-color bg-caramel"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="h6 fw-semibold">
                                                <span class="number">1x</span>
                                                <span class="price text-primary tf-mini-card-price">$20.00</span>
                                            </div>
                                            <i class="icon link icon-close remove"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-mini-cart-item file-delete">
                                    <div class="tf-mini-cart-image">
                                        <img class="lazyload" data-src="images/products/electronic/product-19.jpg"
                                            src="images/products/electronic/product-19.jpg" alt="img-product">
                                    </div>
                                    <div class="tf-mini-cart-info">
                                        <div class="text-small text-main-2 sub">T-shirt</div>
                                        <h6 class="title">
                                            <a href="javascript:void(0)" class="link text-line-clamp-1">Champion Reverse Weave Pullover</a>
                                        </h6>
                                        <div class="size">
                                            <div class="text-small text-main-2 sub">Size: L</div>
                                            <div class="text-small text-main-2 sub">Color:</div>
                                            <div class="dot-color bg-sage-green"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="h6 fw-semibold">
                                                <span class="number">1x</span>
                                                <span class="price text-primary tf-mini-card-price">$24.99</span>
                                            </div>
                                            <i class="icon link icon-close remove"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-mini-cart-item file-delete">
                                    <div class="tf-mini-cart-image">
                                        <img class="lazyload" data-src="images/products/electronic/product-21.jpg"
                                            src="images/products/electronic/product-21.jpg" alt="img-product">
                                    </div>
                                    <div class="tf-mini-cart-info">
                                        <div class="text-small text-main-2 sub">Sweatshirt</div>
                                        <h6 class="title">
                                            <a href="javascript:void(0)" class="link text-line-clamp-1">ASICS Core Running Tights</a>
                                        </h6>
                                        <div class="size">
                                            <div class="text-small text-main-2 sub">Size: XS</div>
                                            <div class="text-small text-main-2 sub">Color:</div>
                                            <div class="dot-color bg-light-beige"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="h6 fw-semibold">
                                                <span class="number">1x</span>
                                                <span class="price text-primary tf-mini-card-price">$18.99</span>
                                            </div>
                                            <i class="icon link icon-close remove"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-mini-cart-item file-delete">
                                    <div class="tf-mini-cart-image">
                                        <img class="lazyload" data-src="images/products/electronic/product-23.jpg"
                                            src="images/products/electronic/product-23.jpg" alt="img-product">
                                    </div>
                                    <div class="tf-mini-cart-info">
                                        <div class="text-small text-main-2 sub">Shorts</div>
                                        <h6 class="title">
                                            <a href="javascript:void(0)" class="link text-line-clamp-1">New Balance Athletics Shorts</a>
                                        </h6>
                                        <div class="size">
                                            <div class="text-small text-main-2 sub">Size: XS</div>
                                            <div class="text-small text-main-2 sub">Color:</div>
                                            <div class="dot-color bg-baby-blue"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="h6 fw-semibold">
                                                <span class="number">1x</span>
                                                <span class="price text-primary tf-mini-card-price">$22.50</span>
                                            </div>
                                            <i class="icon link icon-close remove"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tf-mini-cart-bottom box-empty_clear">
                        <div class="tf-mini-cart-bottom-wrap">
                            <div class="tf-mini-cart-view-checkout">
                                <a href="{{ route('cart.view') }}" class="tf-btn btn-white animate-btn animate-dark line">View cart</a>
                                <a href="{{route('checkout')}}" class="tf-btn animate-btn d-inline-flex bg-dark-2 w-100 justify-content-center"><span>Check
                                        out</span></a>
                            </div>
                            <div class="free-shipping">
                                <i class="icon icon-truck"></i>
                                Free shipping on all orders over $150
                            </div>
                        </div>
                    </div>
                    <div class="tf-mini-cart-tool-openable add-note">
                        <div class="overlay tf-mini-cart-tool-close"></div>
                        <form action="#" class="tf-mini-cart-tool-content">
                            <label for="Cart-note" class="tf-mini-cart-tool-text h5 fw-semibold">
                                <i class="icon icon-note-pencil"></i>
                                Note
                            </label>
                            <textarea name="note" id="Cart-note" placeholder="Note about your order"></textarea>
                            <div class="tf-cart-tool-btns">
                                <button class="subscribe-button tf-btn animate-btn d-inline-flex bg-dark-2 w-100" type="submit">Save</button>
                                <div class="tf-btn btn-white animate-btn animate-dark line tf-mini-cart-tool-close">Cancel</div>
                            </div>
                        </form>
                    </div>
                    <div class="tf-mini-cart-tool-openable estimate-shipping">
                        <div class="overlay tf-mini-cart-tool-close"></div>
                        <form id="shipping-form" class="tf-mini-cart-tool-content">
                            <div class="tf-mini-cart-tool-text h5 fw-semibold">
                                <i class="icon icon-truck"></i>
                                Shipping
                            </div>
                            <div class="field">
                                <div class="tf-select">
                                    <select class="w-100" id="shipping-country-form" name="address[country]" data-default="">
                                        <option value="Australia"
                                            data-provinces='[["Australian Capital Territory","Australian Capital Territory"],["New South Wales","New South Wales"],["Northern Territory","Northern Territory"],["Queensland","Queensland"],["South Australia","South Australia"],["Tasmania","Tasmania"],["Victoria","Victoria"],["Western Australia","Western Australia"]]'>
                                            Australia</option>
                                        <option value="Austria" data-provinces='[]'>Austria</option>
                                        <option value="Belgium" data-provinces='[]'>Belgium</option>
                                        <option value="Canada" data-provinces='[["Ontario","Ontario"],["Quebec","Quebec"]]'>Canada
                                        </option>
                                        <option value="Czech Republic" data-provinces='[]'>Czechia</option>
                                        <option value="Denmark" data-provinces='[]'>Denmark</option>
                                        <option value="Finland" data-provinces='[]'>Finland</option>
                                        <option value="France" data-provinces='[]'>France</option>
                                        <option value="Germany" data-provinces='[]'>Germany</option>
                                        <option selected value="United States"
                                            data-provinces='[["Alabama","Alabama"],["California","California"],["Florida","Florida"]]'>
                                            United States</option>
                                        <option value="United Kingdom"
                                            data-provinces='[["England","England"],["Scotland","Scotland"],["Wales","Wales"],["Northern Ireland","Northern Ireland"]]'>
                                            United Kingdom</option>
                                        <option value="India" data-provinces='[]'>India</option>
                                        <option value="Japan" data-provinces='[]'>Japan</option>
                                        <option value="Mexico" data-provinces='[]'>Mexico</option>
                                        <option value="South Korea" data-provinces='[]'>South Korea</option>
                                        <option value="Spain" data-provinces='[]'>Spain</option>
                                        <option value="Italy" data-provinces='[]'>Italy</option>
                                        <option value="Vietnam"
                                            data-provinces='[["Ha Noi","Ha Noi"],["Da Nang","Da Nang"],["Ho Chi Minh","Ho Chi Minh"]]'>
                                            Vietnam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field">
                                <div class="tf-select">
                                    <select id="shipping-province-form" name="address[province]" data-default=""></select>
                                </div>
                            </div>
                            <div class="field">
                                <input type="text" placeholder="Postal code" data-opend-focus id="zipcode" name="address[zip]" value="">
                            </div>
                            <div id="zipcode-message" class="error" style="display: none;">
                                We found one shipping rate available for undefined.
                            </div>
                            <div id="zipcode-success" class="success" style="display: none;">
                                <p>We found one shipping rate available for your address:</p>
                                <p class="standard">Standard at <span>$0.00</span> USD</p>
                            </div>
                            <div class="tf-cart-tool-btns">
                                <button class="subscribe-button tf-btn animate-btn d-inline-flex bg-dark-2 w-100" type="submit">Save</button>
                                <div class="tf-btn btn-white animate-btn animate-dark line tf-mini-cart-tool-close">Cancel</div>
                            </div>
                        </form>
                    </div>
                    <div class="tf-mini-cart-tool-openable add-gift">
                        <div class="overlay tf-mini-cart-tool-close"></div>
                        <form action="#" class="tf-mini-cart-tool-content">
                            <div class="tf-mini-cart-tool-text h5 fw-semibold">
                                <i class="icon icon-gift"></i>
                                Gift
                            </div>
                            <div class="wrap">
                                <i class="icon icon-gift-2"></i>
                                <h3>Only <span class="text-primary">$2</span> for a gift box</h3>
                            </div>
                            <div class="tf-cart-tool-btns">
                                <button class="subscribe-button tf-btn animate-btn d-inline-flex bg-dark-2 w-100" type="submit">Add a
                                    gift</button>
                                <div class="tf-btn btn-white animate-btn animate-dark line tf-mini-cart-tool-close">Cancel</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Shopping Cart -->

<link rel="stylesheet" href="https://unpkg.com/swiper@10/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper@10/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var swiper = new Swiper('.sw-slide-show', {
            loop: true,
            effect: 'fade',
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.tf-sw-pagination',
                clickable: true,
            },
            fadeEffect: {
                crossFade: true
            }
        });
    });
</script>
    <!-- Javascript -->
    <script src={{ asset('front-end/js/bootstrap.min.js')}}></script>
    <script src={{ asset('front-end/js/jquery.min.js')}}></script>
    <script src={{ asset('front-end/js/swiper-bundle.min.js')}}></script>
    <script src={{ asset('front-end/js/carousel.js')}}></script>
    <script src={{ asset('front-end/js/bootstrap-select.min.js')}}></script>
    <script src={{ asset('front-end/js/lazysize.min.js')}}></script>
    <script src={{ asset('front-end/js/wow.min.js')}}></script>
    <script src={{ asset('front-end/js/parallaxie.js')}}></script>
    <script src={{ asset('front-end/js/count-down.js')}}></script>
    <script src={{ asset('front-end/js/main.js')}}></script>

    <script src="js/sibforms.js" defer></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const quickViewButtons = document.querySelectorAll('[data-bs-toggle="modal"][href="#quickView"]');
    
    quickViewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productCard = this.closest('.card-product');

            // ==== Get product data from card ====
            const imgSrc = productCard.querySelector('.img-product').getAttribute('src');
            const imgAlt = productCard.querySelector('.img-product').getAttribute('alt');
            const productName = productCard.querySelector('.name-product a').textContent.trim();
            const productLink = productCard.querySelector('.name-product a').getAttribute('href');
            const priceNew = productCard.querySelector('.price-new').textContent.trim();
            const priceOld = productCard.querySelector('.price-old') ? productCard.querySelector('.price-old').textContent.trim() : '';
            const productId = productCard.querySelector('.product-action_list a[data-bs-toggle="offcanvas"]').getAttribute('data-product-id');

            // ==== Update QuickView modal ====
            const modal = document.querySelector('#quickView');

            // Update image (first slide)
            const modalImg = modal.querySelector('.swiper-slide:first-child img');
            modalImg.src = imgSrc;
            modalImg.alt = imgAlt;

            // Update product name + link
            const modalName = modal.querySelector('.product-info-name');
            modalName.textContent = productName;
            modalName.setAttribute('href', productLink);

            // Update prices
            modal.querySelector('.price-new').textContent = priceNew;
            if (priceOld) {
                modal.querySelector('.price-old').textContent = priceOld;
                modal.querySelector('.price-old').style.display = 'inline';
            } else {
                modal.querySelector('.price-old').style.display = 'none';
            }

            // Update "Add to cart" button product ID
            const modalAddToCartBtn = modal.querySelector('.add-to-cart-btn');
            if (modalAddToCartBtn) {
                modalAddToCartBtn.setAttribute('data-product-id', productId);
            }
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event to all add to cart buttons
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.getAttribute('data-product-id');
            
            // Find the closest product container - handle both card product and modal scenarios
            let productElement = this.closest('.card-product');
            if (!productElement) {
                productElement = this.closest('.modal-quick-view');
            }
            
            // Safely get quantity from the quantity input field
            let quantity = 1;
            let quantityInput = null;
            
            if (productElement) {
                quantityInput = productElement.querySelector('.quantity-product');
                if (quantityInput) {
                    quantity = parseInt(quantityInput.value) || 1;
                }
            }
            
            // Validate quantity (must be at least 1)
            if (quantity < 1) {
                showToast('Error', 'Quantity must be at least 1', 'error');
                return;
            }
            
            // Show loading indicator
            const originalHtml = this.innerHTML;
            this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...';
            this.disabled = true;
            
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showToast('Success', data.message, 'success');
                    
                    // Update cart count in header (if you have one)
                    updateCartCount(data.cart_count);
                    
                    // Update offcanvas cart
                    updateCartSidebar();
                    
                    // Reset quantity to 1 after successful addition if input exists
                    if (quantityInput) {
                        quantityInput.value = 1;
                    }
                } else {
                    showToast('Error', data.message || 'Failed to add product to cart', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Something went wrong', 'error');
            })
            .finally(() => {
                // Restore button
                this.innerHTML = originalHtml;
                this.disabled = false;
            });
        });
    });
    
    // Handle remove from cart buttons (delegated event for dynamic content)
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove')) {
            e.preventDefault();
            const removeButton = e.target.closest('.remove');
            const cartItem = removeButton.closest('.tf-mini-cart-item');
            const productId = removeButton.getAttribute('data-product-id');
            
            if (!productId) {
                console.error('No product ID found for removal');
                return;
            }
            
            // Show loading on the remove button
            const originalHtml = removeButton.innerHTML;
            removeButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
            removeButton.style.pointerEvents = 'none';
            
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
                    // Show success message
                    showToast('Success', data.message, 'success');
                    
                    // Update cart count in header
                    updateCartCount(data.cart_count);
                    
                    // Remove the item from the UI or refresh the entire cart
                    if (cartItem) {
                        cartItem.remove();
                        
                        // Check if cart is now empty
                        const cartItems = document.querySelectorAll('.tf-mini-cart-item');
                        if (cartItems.length === 0) {
                            // Show empty cart message
                            document.querySelector('.tf-mini-cart-items').innerHTML = `
                                <div class="box-text_empty type-shop_cart">
                                    <div class="empty_top">
                                        <span class="icon">
                                            <i class="icon-shopping-cart-simple"></i>
                                        </span>
                                        <h3 class="text-emp fw-normal">Your cart is empty</h3>
                                        <p class="h6 text-main">
                                            Your cart is currently empty. Let us assist you in finding the right product
                                        </p>
                                    </div>
                                    <div class="empty_bot">
                                        <a href="javascript:void(0)" class="tf-btn animate-btn">Shopping</a>
                                        <a href="javascript:void(0)" class="tf-btn style-line">Back to home</a>
                                    </div>
                                </div>
                            `;
                        }
                        
                        // Update cart totals
                        updateCartTotals(data);
                    } else {
                        // If we can't find the specific item, refresh the entire cart
                        updateCartSidebar();
                    }
                } else {
                    showToast('Error', data.message || 'Failed to remove product from cart', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Something went wrong', 'error');
            })
            .finally(() => {
                // Restore button
                removeButton.innerHTML = originalHtml;
                removeButton.style.pointerEvents = 'auto';
            });
        }
    });

    
    // Function to show toast notifications
    function showToast(title, message, type = 'info') {
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
        
        // Remove toast after it hides
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
    
    function updateCartCount(count) {
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(el => {
            el.textContent = count;
            el.style.display = count > 0 ? 'inline-block' : 'none';
        });
    }
    
    function updateCartSidebar() {
        // Fetch updated cart content via AJAX and update the sidebar
        fetch('{{ route("cart.content") }}')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cartItemsContainer = document.querySelector('.tf-mini-cart-items');
                    if (cartItemsContainer) {
                        cartItemsContainer.innerHTML = data.html;
                    }
                    updateCartTotals(data);
                }
            });
    }
    
    function updateCartTotals(data) {
        // Update cart totals in the sidebar
        const countElement = document.querySelector('.prd-count');
        const totalElement = document.querySelector('.total-price');
        
        if (countElement) countElement.textContent = data.count;
        if (totalElement) totalElement.textContent = '₹' + data.total.toFixed(2);
    }
});
</script>



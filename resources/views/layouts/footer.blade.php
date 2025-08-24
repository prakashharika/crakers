@php
    $buy = App\Models\Property::where('status', 1)
        ->orderBy('sort_order', 'asc')
        ->get();
        $genaral = App\Models\GeneralDetail::find(1);
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
                                        <li><a href="javascript:void(0)" class="link h6">Shipping</a></li>
                                        <li><a href="javascript:void(0)" class="link h6">aaaaaaaaand</a></li>
                                        <li><a href="javascript:void(0)" class="link h6">ssssssss order</a></li>
                                        <li><a href="javascript:void(0)" class="link h6">Terms & sssss</a></li>
                                        <li><a href="javascript:void(0)" data-bs-toggle="modal" class="link h6">xxxxxxx Guide</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb_30 mb-sm-0">
                            <div class="footer-col-block footer-wrap-2 mx-xl-auto">
                                <p class="footer-heading footer-heading-mobile">Information</p>
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                        <li><a href="javascript:void(0)" class="link h6">About Us</a></li>
                                        <li><a href="javascript:void(0)" class="link h6">Term & Policy</a></li>
                                        <li><a href="javascript:void(0)" class="link h6">Privacy Policy</a></li>
                                        <li><a href="{{route('blog.list')}}" class="link h6">Blog</a></li>
                                        <li><a href="javascript:void(0)" class="link h6">Refunds</a></li>
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
            
            const imgSrc = productCard.querySelector('.img-product').src;
            const imgAlt = productCard.querySelector('.img-product').alt;
            
            const modalImg = document.querySelector('#quickView .swiper-slide:first-child img');
            modalImg.src = imgSrc;
            modalImg.alt = imgAlt;
            
            const productName = productCard.querySelector('.name-product a').textContent;
            document.querySelector('#quickView .product-info-name').textContent = productName;
        });
    });
});
</script>
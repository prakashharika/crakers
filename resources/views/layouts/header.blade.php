
@php
    $categories = App\Models\Property::where('status', 1)
        ->orderBy('sort_order', 'asc')
        ->take(9)
        ->get();
    $genaral = App\Models\GeneralDetail::find(1);
@endphp
<!-- Top Bar-->
        <div class="tf-topbar bg-dark-blu type-space-2 line-bt-3">
            <div class="container-full-2">
                <div class="row">
                    <div class="col-xl-6 col-lg-8">
                        <div class="topbar-left justify-content-center justify-content-sm-start">
                            @php
                                $phones = isset($genaral->phone) ? explode(',', $genaral->phone) : [];
                                $firstPhone = count($phones) ? trim($phones[0]) : '18001234567';
                            @endphp

                            <ul class="topbar-option-list">
                                <li class="h6 d-none d-sm-flex">
                                    <a href="tel:{{ $firstPhone }}" class="text-white link track">
                                        <i class="icon icon-phone"></i> Call us:
                                        @foreach($phones as $phone)
                                            {{ trim($phone) }}
                                        @endforeach
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4 d-none d-lg-block">
                        <ul class="topbar-right topbar-option-list">
                            <li class="h6">
                                    <a href="javascript:void(0)" class="text-white link">Free Shipping for orders over $150</a>
                                </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Top Bar -->
        <!-- Header -->
        <header class="tf-header style-5">
            <div class="header-top ">
                <div class="container-full-2">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-3 d-xl-none">
                            <a href="#mobileMenu" data-bs-toggle="offcanvas" class="btn-mobile-menu style-white">
                                <span></span>
                            </a>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6 text-center text-xl-start">
                            <a href="{{route('home')}}" class="logo-site justify-content-center justify-content-xl-start">
                                @isset($genaral->logo)
                                    <img src="{{ asset('images/' . $genaral->logo) }}" alt="">
                                @endisset
                            </a>
                        </div>
                        <div class="col-xl-10 col-md-4 col-3">
                            <div class="header-right">
                                <form class="form_search-product style-search-2 d-none d-xl-flex">
                                        <div class="select-category">
                                        <select name="product_cat" id="product_cat" class="dropdown_product_cat">
                                            <option value="" selected="selected">All Categories</option>
                                            @foreach($categories as $category)
                                                <option class="level-0" value="{{ $category->slug }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <ul class="select-options">
                                            <li class="link" rel="">
                                                <a href="{{ route('products.all') }}"><span>All Categories</span></a>
                                            </li>
                                            @foreach($categories as $category)
                                                <li class="link" rel="{{ $category->slug }}">
                                                    <a href="{{ route('category.products', ['slug' => $category->slug]) }}">
                                                        <span>{{ $category->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <span class="br-line type-vertical"></span>
                                    <input class="style-def" type="text" placeholder="Search for products..." required>
                                    <button type="submit" class="btn-submit">
                                        <i class="icon icon-magnifying-glass"></i>
                                        <span class="h6 fw-bold">Search</span>
                                    </button>
                                </form>
                                <ul class="nav-icon-list text-nowrap">
                                    <li class="d-none d-lg-flex">
                                        <a class="nav-icon-item-2 text-white link" href="javascript:void(0)">
                                            <i class="icon icon-user"></i>
                                            <div class="nav-icon-item_sub">
                                                <span class="text-sub text-small-2">Hello, sign in</span>
                                                <span class="h6">Prakash</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="d-none d-sm-flex">
                                        <a class="nav-icon-item-2 text-white link" href="javascript:void(0)">
                                            <i class="icon icon-heart"></i>
                                            <span class="count">24</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-icon-item-2 text-white link" href="#shoppingCart" data-bs-toggle="offcanvas">
                                            <div class="position-relative d-flex">
                                                <i class="icon icon-shopping-cart-simple"></i>
                                                <span class="count">24</span>
                                            </div>
                                            <div class="nav-icon-item_sub d-none d-sm-grid">
                                                <span class="text-sub text-small-2">Your cart</span>
                                                <span class="h6">$0.00</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-inner d-none d-xl-block bg-white">
                <div class="container-full-2">
                    <div class="header-inner_wrap">
                        <div class="col-left">
                            <div class="nav-category-wrap main-action-active">
                                <div class="btn-nav-drop btn-active">
                                    <span class="btn-mobile-menu type-small"><span></span></span>
                                    <h6 class="name-category fw-semibold">All Categories</h6>
                                    <i class="icon icon-caret-down"></i>
                                </div>
                                <ul class="box-nav-category active-item">
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{ route('category.products', ['slug' => $category->slug]) }}" class="nav-category_link h5">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                            <span class="br-line type-vertical h-24"></span>
                            <nav class="box-navigation">
                                <ul class="box-nav-menu">
                                    <li class="menu-item">
                                        <a href="javascript:void(0)" class="item-link">HOME</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0)" class="item-link">CATEGORIES</a>
                                    </li>
                                    <li class="menu-item position-relative">
                                        <a href="{{ route('about.us.view') }}" class="item-link">ABOUT US</a>
                                    </li>
                                    <li class="menu-item position-relative">
                                        <a href="{{route('blog.list')}}" class="item-link">BLOG</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-right">
                            <i class="icon icon-truck"></i>
                            <p class="h6 text-black">
                                Free Shipping for orders over <span class="fw-bold text-primary">$150</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <header class="tf-header header-fixed style-5 bg-dark-blu">
            <div class="header-top d-xl-none">
                <div class="container-full-2">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-3 d-xl-none">
                            <a href="#mobileMenu" data-bs-toggle="offcanvas" class="btn-mobile-menu style-white">
                                <span></span>
                            </a>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6 text-center text-xl-start">
                            <a href="javascript:void(0)" class="logo-site justify-content-center justify-content-xl-start">
                                <img src="images/logo/logo-white-2.svg" alt="">
                            </a>
                        </div>
                 <div class="col-xl-10 col-md-4 col-3">
                    <div class="header-right">
                        <form class="form_search-product style-search-2 d-none d-xl-flex">
                           <div class="select-category">
    <ul class="select-options">
        <li class="link" rel="">
            <a href="{{ route('products.all') }}"><span>All Categories</span></a>
        </li>
        @foreach($categories as $category)
            <li class="link" rel="{{ $category->slug }}">
                <a href="{{ route('category.products', ['slug' => $category->slug]) }}">
                    <span>{{ $category->name }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>

                            <span class="br-line type-vertical"></span>
                            <input class="style-def" type="text" placeholder="Search for crackers..." required>
                            <button type="submit" class="btn-submit">
                                <i class="icon icon-magnifying-glass"></i>
                                <span class="h6 fw-bold">Search</span>
                            </button>
                        </form>
                        <ul class="nav-icon-list text-nowrap">
                            <li class="d-none d-lg-flex">
                                <a class="nav-icon-item-2 text-white link" href="javascript:void(0)">
                                    <i class="icon icon-user"></i>
                                    <div class="nav-icon-item_sub">
                                        <span class="text-sub text-small-2">Hello, sign in</span>
                                        <span class="h6">Your account</span>
                                    </div>
                                </a>
                            </li>
                            <li class="d-none d-sm-flex">
                                <a class="nav-icon-item-2 text-white link" href="javascript:void(0)">
                                    <i class="icon icon-heart"></i>
                                    <span class="count">24</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-icon-item-2 text-white link" href="#shoppingCart" data-bs-toggle="offcanvas">
                                    <div class="position-relative d-flex">
                                        <i class="icon icon-shopping-cart-simple"></i>
                                        <span class="count">24</span>
                                    </div>
                                    <div class="nav-icon-item_sub d-none d-sm-grid">
                                        <span class="text-sub text-small-2">Your cart</span>
                                        <span class="h6">$0.00</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                    </div>
                </div>
            </div>
            <div class="header-inner d-none d-xl-block bg-white">
                <div class="container-full-2">
                    <div class="header-inner_wrap">
                        <div class="col-left">
                            <div class="nav-category-wrap main-action-active">
                                <div class="btn-nav-drop btn-active">
                                    <span class="btn-mobile-menu type-small"><span></span></span>
                                    <h6 class="name-category fw-semibold">All Categories</h6>
                                    <i class="icon icon-caret-down"></i>
                                </div>
                             <ul class="box-nav-category active-item">
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{ route('category.products', ['slug' => $category->slug]) }}" class="nav-category_link h5">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                            <span class="br-line type-vertical h-24"></span>
                            <nav class="box-navigation">
                                <ul class="box-nav-menu">
                                    <li class="menu-item mn-none">
                                        <a href="javascript:void(0)" class="item-link">HOME</a>
                                    </li>
                                    <li class="menu-item mn-none">
                                        <a href="javascript:void(0)" class="item-link">SHOP</a>
                                    </li>
                                    <li class="menu-item mn-none">
                                        <a href="javascript:void(0)" class="item-link">CATEGORIES</a>
                                    </li>
                                    <li class="menu-item mn-none position-relative">
                                        <a href="{{ route('about.us.view') }}" class="item-link">ABOUT US</a>
                                    </li>
                                    <li class="menu-item mn-none position-relative">
                                        <a href="{{route('blog.list')}}" class="item-link">BLOG</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-right">
                            <i class="icon icon-truck"></i>
                            <p class="h6 text-black">
                                Free Shipping for orders over Freeeeeeee 1d<span class="fw-bold text-primary">$150</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->
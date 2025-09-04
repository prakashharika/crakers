<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeControl;
use App\Http\Controllers\HomePageControl;
use App\Http\Controllers\LandOwnerControl;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackagesControl;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyControl;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServicesControl;
use App\Models\Advertisement;
use App\Models\BlogPost;
use App\Models\OrderPackage;
use App\Models\PropertiesList;
use App\Models\Property;
use App\Models\RegisterPost;
use App\Models\Service;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    $blogs = BlogPost::latest()->take(3)->get();
    $categories = Property::where('status', 1)->orderBy('created_at', 'asc')->take(9)->get();
    $categories2 = Property::where('status', 1)->orderBy('created_at', 'desc')->take(9)->get();
    $slider = Slider::latest()->get();
    $banner = RegisterPost::latest()->first();
    // dd(session()->get('cart', []));


    return view('welcome', compact('blogs', 'categories', 'slider', 'categories2', 'banner'));
})->name('home');
Route::get('/test', function () {
    $admin = User::all();

    DB::insert("
    INSERT INTO terms_and_policies (
        content, created_at, updated_at
        ) VALUES (?, ?, ?)
        ", [
        '<h3><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h3><p>Lorem ipsum dolor sit amet...</p>',
        now(),
        now()
    ]);
    dd(session()->get('cart', []));
    dd($admin);
})->name('test');

Route::get('/products', [ProductController::class, 'productAll'])->name('products.all');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/categories', [HomeControl::class, 'categories'])->name('product.categories');
Route::get('/category/{slug?}', [HomeControl::class, 'categoryProducts'])->name('product.category');

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/content', [CartController::class, 'getCartContent'])->name('cart.content');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/checkout', function () {
    $blogs = BlogPost::latest()->take(3)->get();
    $categories = Property::where('status', 1)->orderBy('created_at', 'asc')->take(9)->get();
    $categories2 = Property::where('status', 1)->orderBy('created_at', 'desc')->take(9)->get();
    $slider = Slider::latest()->get();
    // dd(session()->get('cart', []));


    return view('welcome', compact('blogs', 'categories', 'slider', 'categories2'));
})->name('checkout');

Route::get('/blog/{slug}', [HomeControl::class, 'blogShow'])->name('blog-user.show');
Route::get('/blogs', [HomeControl::class, 'blogList'])->name('blog.list');
Route::get('/sales-interest/{slug?}', [HomeControl::class, 'sales'])->name('sales.interest');
Route::post('/sales-interest', [HomeControl::class, 'enquire'])->name('sales.enquire');
Route::get('/property-view/{slug}/{name}', [HomeControl::class, 'propertyView'])->name('property-view');
Route::get('/services', [HomeControl::class, 'services'])->name('services');
Route::get('/post-property', [HomeControl::class, 'postProperty'])->name('post.property');
Route::post('/landowner', [HomeControl::class, 'landowner'])->name('landowner.entery');
Route::get('/choose-package', [HomeControl::class, 'choosePackage'])->name('choose.package');
Route::get('/package-selecting/{id}', [HomeControl::class, 'updatelandownerPackage'])->name('package.selecting');
Route::get('/order-package/{id}', [HomeControl::class, 'orderResponse'])->name('order.package');
Route::get('login/google', [HomeControl::class, 'redirectToGoogle']);
Route::get('/callback', [HomeControl::class, 'handleGoogleCallback']);

Route::get('/search', [HomeControl::class, 'search'])->name('search');
Route::post('/filter-properties', [HomeControl::class, 'filterProperties'])->name('filter-properties');

Route::get('/terms-and-conditions', [HomeControl::class, 'termsConditions'])->name('terms.conditions.view');
Route::get('/privacy-policy', [HomeControl::class, 'privacyPolicy'])->name('privacy.policy.view');
Route::get('/about-us', [HomeControl::class, 'aboutUs'])->name('about.us.view');
Route::get('/contact', [HomeControl::class, 'contact'])->name('contact');
Route::post('/user-enquiry', [HomeControl::class, 'userEnquiry'])->name('user.enquiry');

Route::prefix('admin')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])
        ->name('admin.login');
    Route::middleware('auth')->group(function () {

        Route::post('/admin-logout', [HomeControl::class, 'adminlogout'])->name('admin.logout');
        Route::get('/logout', [HomeControl::class, 'adminAuthlogout'])->name('admin.auth.logout');
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('admin.dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/properties', [PropertyControl::class, 'view'])->name('property.view');
        Route::get('/property-list/{id}', [ProductController::class, 'index'])->name('property-list');
        Route::get('/property-add/{id}', [PropertyControl::class, 'add'])->name('property-list.add');
        Route::get('/sales-list', [PropertyControl::class, 'salesList'])->name('sales.list');
        Route::post('/property-future-status/', [PropertyControl::class, 'propertyFutureStatus'])->name('admin.future.status.update');
        Route::post('/property-store/', [PropertyControl::class, 'propertyStore'])->name('properties.store');
        Route::post('/property-status/', [PropertyControl::class, 'propertyStatus'])->name('property.status.update');


        Route::resource('products', ProductController::class);
        Route::get('/property-edit/{id}', [PropertyControl::class, 'propertyEdit'])->name('properties-list.edit');
        Route::get('/property-view/{id}', [PropertyControl::class, 'propertyView'])->name('properties-list.view');
        Route::put('/property-update/{id}', [PropertyControl::class, 'propertyUpdate'])->name('properties-list.update');
        Route::get('/property-delete/{id}', [PropertyControl::class, 'propertyDelete'])->name('properties-list.delete');
        Route::resource('/property', PropertyControl::class);
        Route::resource('/service', ServicesControl::class);
        Route::get('/service-get', [ServicesControl::class, 'getServices']);
        Route::resource('/sliders', HomePageControl::class);
        Route::get('/slider-list', [HomePageControl::class, 'list'])->name('slider.list');
        Route::get('/terms-conditions', [HomePageControl::class, 'termsConditions'])->name('terms.conditions');
        Route::get('/privacy-policy', [HomePageControl::class, 'privacyPolicy'])->name('privacy.policy');
        Route::put('/terms-conditions', [HomePageControl::class, 'termsConditionsUpdate'])->name('terms.conditions.update');
        Route::put('/privacy-policy', [HomePageControl::class, 'privacyPolicyUpdate'])->name('privacy.policy.update');
        Route::post('/about-us/update', [HomePageControl::class, 'aboutUsUpdate'])->name('about.us.update');
        Route::get('/about-us', [HomePageControl::class, 'aboutUs'])->name('about.us');
        Route::post('/property-update/{property}', [PropertyControl::class, 'update'])->name('property.update');
        Route::get('/property-owners', [LandOwnerControl::class, 'index'])->name('owners.index');
        Route::get('/property-owner-view/{id}', [LandOwnerControl::class, 'viewLandOwner'])->name('view.landowner');
        Route::get('/advertisement', [PropertyControl::class, 'Advertisement'])->name('admin.advertisement');
        Route::post('/advertisement', [PropertyControl::class, 'AdvertisementStore'])->name('admin.advertisements.store');
        Route::delete('/advertisements/{advertisement}', [PropertyControl::class, 'advertisementDestroy'])->name('admin.advertisements.destroy');
        Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
        Route::get('/packages/edit/{id}', [PackageController::class, 'edit'])->name('packages.edit');
        Route::post('/packages/update', [PackageController::class, 'update'])->name('packages.update');

        Route::get('/register-to-post', [HomePageControl::class, 'registerPost'])->name('register.to.post');
        Route::post('/register-to-post', [HomePageControl::class, 'registerPostStore'])->name('register.section.store');
        Route::get('/general-details', [HomePageControl::class, 'generalDetails'])->name('general.details');
        Route::post('/general-details', [HomePageControl::class, 'generalDetailsStore'])->name('general.details.store');


        Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
        Route::get('/blog/{blogPost}/edit', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('/blog/{blogPost}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/blog/{blogPost}', [BlogController::class, 'destroy'])->name('blog.destroy');
    });
});

Route::prefix('seller')->group(function () {
    Route::get('/', [HomeControl::class, 'sellerLogin'])->name('seller.login');
    Route::post('/logout', [HomeControl::class, 'logout'])->name('seller.logout');
    Route::post('/login', [HomeControl::class, 'sellerLog'])->name('seller.log');
    Route::get('/otp/verify', [HomeControl::class, 'showVerifyForm'])->name('otp.verify');
    Route::get('/otp/resend', [HomeControl::class, 'resendOtp'])->name('otp.resend');
    Route::post('/otp/verify', [HomeControl::class, 'verifyOtp']);

    Route::middleware(['sellerAuth'])->group(function () {
        Route::get('/dashboard', function () {
            $user = Auth::guard('seller')->user();
            $landownerId = $user->id;
            $currentpackage = OrderPackage::where('land_owner_id', $landownerId)
                ->where('payment_status', 'success')
                ->where('status', 'active')
                ->first();
            return view('seller-dashboard', compact('currentpackage'));
        })->name('seller.dashboard');
        Route::get('/my-packages', [PropertyControl::class, 'myPackages'])->name('my.packages');
        Route::get('/properties', [PropertyControl::class, 'sellerview'])->name('property-cate-owner.view');
        Route::get('/seller-view', [PropertyControl::class, 'sellerindex'])->name('property.seller.index');
        Route::get('/property-seller-list/{id}', [PropertyControl::class, 'sellerlist'])->name('property-seller-list');
        Route::get('/property-add/{id}', [PropertyControl::class, 'sellerpropertyadd'])->name('property.seller.add');
        Route::post('/seller-future-status/', [PropertyControl::class, 'propertySellerFutureUpdate'])->name('seller.future.status.update');
        Route::post('/property-seller-store/', [PropertyControl::class, 'propertySellerStore'])->name('properties.seller.store');
        Route::get('/property-seller-view/{id}', [PropertyControl::class, 'propertySellerView'])->name('properties-list.seller.view');
        Route::get('/property-seller-edit/{id}', [PropertyControl::class, 'propertySellerEdit'])->name('properties-list.seller.edit');
        Route::put('/property-seller-update/{id}', [PropertyControl::class, 'propertySellerUpdate'])->name('properties-list.seller.update');
        Route::get('/property-seller-delete/{id}', [PropertyControl::class, 'propertySellerDelete'])->name('properties-list.seller.delete');
        Route::get('/seller-sales-list', [PropertyControl::class, 'sellerSalesList'])->name('seller.sales.list');
        Route::get('/advertisement', [PropertyControl::class, 'sellerAdvertisement'])->name('my.advertisement');
        Route::post('/advertisement', [PropertyControl::class, 'sellerAdvertisementStore'])->name('seller.advertisements.store');
    });
});
require __DIR__ . '/auth.php';

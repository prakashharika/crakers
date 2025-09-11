<?php

namespace App\Http\Controllers;

use App\Models\LandOwner;
use App\Models\PropertiesList;
use App\Models\Property;
use App\Models\Service;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use App\Mail\SendMail;
use App\Models\Advertisement;
use App\Models\BlogPost;
use App\Models\Buyer;
use App\Models\GeneralDetail;
use App\Models\Order;
use App\Models\OrderPackage;
use App\Models\Package;
use App\Models\Product;
use App\Models\Sale;
use App\Models\TermsAndPolicy;
use Carbon\Carbon;
use Exception;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;
use Vinkla\Hashids\Facades\Hashids;

class HomeControl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function blogShow($slug)
    {
        $blogposts = BlogPost::where('published', true)
            ->where('published_at', '<=', now())
            ->get();

        $blogpost = $blogposts->first(function ($post) use ($slug) {
            return Str::slug($post->title) === $slug;
        });

        if (!$blogpost) {
            abort(404);
        }

        // Get recent blogs for sidebar (excluding current post)
        $recentBlogs = $blogposts->where('id', '!=', $blogpost->id)
            ->sortByDesc('published_at')
            ->take(5);

        return view('view.blog-show', compact('blogpost', 'recentBlogs'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('product_cat');

        // Get all categories for the dropdown
        $categories = Property::where('status', 1)->orderBy('name')->get();

        // Build search query
        $products = Product::query();

        // Apply category filter if selected
        if ($category && $category !== '') {
            $products->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        // Apply search query
        if ($query) {
            $products->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('tamil_name', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->orWhere('items', 'like', '%' . $query . '%');
            });
        }

        $products = $products->with('category')->paginate(12);

        return view('view.search-results', compact('products', 'categories', 'query', 'category'));
    }

    public function blogList()
    {
        $blogs = BlogPost::where('published', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(9); // Show 9 blogs per page

        return view('view.blog-list', compact('blogs'));
    }







    /**
     * Show the form for creating a new resource.
     */
    public function services()
    {
        $services = Service::all();
        return view('view.services', compact('services'));
    }
    public function viewProduct($slug)
    {
        $product = Product::where('slug', $slug)
            ->with('category')
            ->firstOrFail();
        return view('view.product', compact('product'));
    }
    public function postProperty()
    {
        $services = Service::all();
        return view('view.post-perperty', compact('services'));
    }
    public function categories()
    {
        $categories = Property::where('status', 1)->orderBy('created_at', 'asc')->get();
        return view('view.categories', compact('categories'));
    }
    public function categoryProducts($slug)
    {
        // Fetch one category by slug, along with its products
        $category = Property::where('slug', $slug)
            ->where('status', 1)
            ->with('products') // assumes Property has relation ->products()
            ->firstOrFail();

        return view('view.category', compact('category'));
    }
    public function landowner(Request $request)
    {
        // dd($request->all());
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:land_owners,email',
            'phone' => 'required|string|max:15',
            'city' => 'required|string|max:255',
            'isthiswhatsapp' => 'nullable',
        ]);
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData->errors())->withInput();
        }
        $recaptcha_response = $_POST['g-recaptcha-response'];
        $secret_key = '6LcpU8cqAAAAAHRPmjVS5-aDNgaSCYS6CfkZnucr';
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$recaptcha_response");
        $response_data = json_decode($response);
        if (!$response_data->success) {
            return redirect()->back()->withErrors(['error' => 'reCAPTCHA verification failed.'])->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'city' => $request->city,
            'phone_number' => $request->phone,
            'is_this_whatsapp' => $request->isthiswhatsapp ?? 'off',
        ];
        $services = Buyer::create($data);
        session(['landowner_id' => $services->id]);
        return redirect()->route('choose.package');
    }
    public function choosePackage()
    {

        $package1 = Package::find(1);
        $package2 = Package::find(2);
        $package3 = Package::find(3);
        $services = Service::all();
        $landownerId = session('landowner_id');
        return view('view.choose-package', compact('services', 'package1', 'package2', 'package3'));
    }

    public function updatelandownerPackage($id)
    {
        if (Auth::guard('seller')->check()) {
            $user = Auth::guard('seller')->user();
            $timestamp = now()->format('Ymd');
            $userType = 'S1';
            $order_id = $user->id . 'ORD' . $id . 'ID' . $timestamp . $userType;
            return redirect()->route('order.package', ['id' => $order_id]);
        } else {
            $landownerId = session('landowner_id');
            //     $landowner = Buyer::find($landownerId);
            // if ($landowner) {
            //     $landowner->package_id = $id;
            //     $landowner->update();
            //     session()->flash('success', 'Thank you for choosing the package.');
            //     return redirect()->route('choose.package');
            // }
            $timestamp = now()->format('Ymd');
            $userType = 'S0';
            $order_id = $landownerId . 'ORD' . $id . 'ID' . $timestamp . $userType;
            return redirect()->route('order.package', ['id' => $order_id]);
        }
        session()->flash('error', 'Landowner not found.');
        return redirect()->route('choose.package');
    }

    public function orderResponse($id)
    {
        try {
            $parsed = $this->parseOrderId($id);
            $landownerId = $parsed['user_id'];
            $package_id = $parsed['package_id'];

            $package = Package::find($package_id);
            if (!$package) {
                return redirect()->back()->with('error', 'Package not found.');
            }

            if ($parsed['is_old_user']) {
                $landowner = OrderPackage::where('land_owner_id', $landownerId)
                    ->where('payment_status', 'success')
                    ->where('status', 'active')
                    ->first();
                if (isset($landowner)) {
                    $expire = Carbon::parse($landowner->expire_date)->addDays($package->property_visibility_days);
                    $start_date = Carbon::parse($landowner->expire_date);
                    $order = OrderPackage::create([
                        'land_owner_id' => $landownerId,
                        'package_id' => $package_id,
                        'title' => $package->title,
                        'price' => $package->price,
                        'price_type' => $package->price_type,
                        'no_property' => $package->no_property_listing,
                        'valid_days' => $package->property_visibility_days,
                        'upto_images' => $package->upto_images,
                        'future_listing' => $package->future_listing_days,
                        'upto_videos' => $package->upto_video,
                        'payment_status' => 'success',
                        'status' => 'inactive',
                        'plan_type' => 'future',
                        'start_date' => $start_date,
                        'expire_date' => $expire,
                    ]);
                } else {
                    $expire = now()->addDays($package->property_visibility_days);
                    $start_date = now();
                    $order = OrderPackage::create([
                        'land_owner_id' => $landownerId,
                        'package_id' => $package_id,
                        'title' => $package->title,
                        'price' => $package->price,
                        'price_type' => $package->price_type,
                        'no_property' => $package->no_property_listing,
                        'valid_days' => $package->property_visibility_days,
                        'upto_images' => $package->upto_images,
                        'future_listing' => $package->future_listing_days,
                        'upto_videos' => $package->upto_video,
                        'payment_status' => 'success',
                        'status' => 'active',
                        'plan_type' => 'present',
                        'start_date' => $start_date,
                        'expire_date' => $expire,
                    ]);
                    $landowner = Buyer::find($landownerId);
                    if ($landowner) {
                        $landowner->package_id = $order->id;
                        $landowner->status = '1';
                        $landowner->update();
                    } else {
                        return redirect()->back()->with('error', 'Landowner not found.');
                    }
                }
                // return redirect()->route('seller.dashboard')->with('success', 'Package order created successfully!');
                return view('view.payment-success');
            } else {
                $expire = now()->addDays($package->property_visibility_days);
                $start_date = now();
                $order = OrderPackage::create([
                    'land_owner_id' => $landownerId,
                    'package_id' => $package_id,
                    'title' => $package->title,
                    'price' => $package->price,
                    'price_type' => $package->price_type,
                    'no_property' => $package->no_property_listing,
                    'valid_days' => $package->property_visibility_days,
                    'upto_images' => $package->upto_images,
                    'future_listing' => $package->future_listing_days,
                    'upto_videos' => $package->upto_video,
                    'payment_status' => 'success',
                    'status' => 'active',
                    'plan_type' => 'present',
                    'start_date' => $start_date,
                    'expire_date' => $expire,
                ]);

                $landowner = Buyer::find($landownerId);
                if ($landowner) {
                    $landowner->package_id = $order->id;
                    $landowner->status = '1';
                    $landowner->update();
                } else {
                    return redirect()->back()->with('error', 'Landowner not found.');
                }
                return view('view.payment-success');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function propertyView($slug, $name)
    {
        $id = \Vinkla\Hashids\Facades\Hashids::decode($slug);

        if (empty($id)) {
            abort(404);
        }
        $property = PropertiesList::where('id', $id[0])
            ->where('status', 1)
            ->where(function ($query) {
                $query->whereHas('LandOwner.OrderPackage', function ($query) {
                    $query->where('status', 'active');
                })
                    ->orWhereNull('land_owner_id');
            })
            ->first();

        if (!$property) {
            abort(404);
        }
        $similarProperties = Property::where('id', $property->property_id)
            ->with([
                'PropertiesList' => function ($query) {
                    $query->where('status', 1);
                }
            ])
            ->limit(50)
            ->orderByDesc('created_at')
            ->get();

        $futuredProperties = PropertiesList::where('status', 1)
            ->where('future_property', 1)
            ->limit(50)
            ->orderByDesc('created_at')
            ->get();
        return view('view.property-view', compact('property', 'similarProperties', 'futuredProperties'));

    }

    /**
     * Display the specified resource.
     */
    public function sellerLogin()
    {
        return view('view.seller-login');
        //
    }
    public function sellerLog(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData->errors())->withInput();
        }
        $owner = Buyer::where('email', $request->email)->first();

        if ($owner) {
            $otp = Str::random(6);

            $owner->otp = Hash::make($otp);
            $owner->save();
            session(['email' => $request->email, 'otp' => $otp]);
            Mail::to($request->email)->send(new SendOtpMail($otp));
            return redirect()->route('otp.verify')->with('success', 'OTP sent to your email.');
        } else {
            return redirect()->back()->withErrors(['email' => 'No user found with this email.'])->withInput();
        }
    }
    public function showVerifyForm()
    {
        return view('view.otp-verify');
    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|max:6',
        ]);

        $sessionOtp = session('otp');
        $email = session('email');

        $owner = Buyer::where('email', $email)->first();

        if ($owner && Hash::check($request->otp, $owner->otp)) {
            Auth::guard('seller')->login($owner);
            return redirect()->route('seller.dashboard')->with('success', 'OTP verified successfully!');
        } else {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }
    }
    public function redirectToGoogle()
    {
        return FacadesSocialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(Request $request)
    {

        try {
            $client = new \GuzzleHttp\Client([
                'verify' => false, // Disable SSL verification
                'curl' => [
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                ]
            ]);

            config(['socialite.google.guzzle' => ['verify' => false]]);

            $googleUser = FacadesSocialite::driver('google')
                ->setHttpClient($client)
                ->user();

            Log::debug('Google user data received', [
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'id' => $googleUser->getId()
            ]);

            $owner = Buyer::where('email', $googleUser->getEmail())->first();

            if ($owner) {
            } else {

                $owner = $this->createNewUserFromGoogle($googleUser);

                if ($owner) {
                } else {
                    Log::error('Failed to create new user');
                    throw new \Exception('Failed to create user account');
                }
            }

            // Step 5: Log the user in
            Auth::guard('seller')->login($owner);

            if (Auth::guard('seller')->check()) {
                Log::info('User logged in successfully', ['user_id' => $owner->id]);
            } else {
                Log::error('Login failed - authentication check failed');
                throw new \Exception('Login authentication failed');
            }

            // Step 6: Check cart and redirect
            $cart = session('cart', []);

            $redirectRoute = !empty($cart) ? 'cart.view' : 'home';

            return redirect()->route($redirectRoute)->with('success', 'Login successfully!');

        } catch (\Exception $e) {
            Log::error('Google OAuth Callback Error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('user.login')->withErrors([
                'error' => 'Google authentication failed. Please try again.'
            ]);
        }
    }


    /**
     * Create a new user from Google OAuth data
     */
    protected function createNewUserFromGoogle($googleUser)
    {
        // Generate a random password for the new user
        $randomPassword = Hash::make(Str::random(12));

        // Create the new user
        $user = Buyer::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => $randomPassword,
            'phone_number' => null, // Google doesn't provide phone number
            'city' => null,
            'status' => 'active',
            // Add any other required fields with default values
        ]);

        // You might want to send a welcome email here
        // $this->sendWelcomeEmail($user);

        return $user;
    }

    /**
     * Resend OTP to the user.
     */
    public function resendOtp(Request $request)
    {

        $owner = Buyer::where('email', session('email'))->first();

        if ($owner) {
            $otp = Str::random(6);

            session(['email' => session('email'), 'otp' => $otp]);
            try {
                Mail::to(session('email'))->send(new SendOtpMail($otp));
                return redirect()->back()->with('success', 'A new OTP has been sent to your email!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to send OTP. Error: ' . $e->getMessage());
            }
            return redirect()->back()->with('success', 'A new OTP has been sent to your email!');
        } else {
            return redirect()->back()->with('error', 'No user found with this email.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function logout(Request $request)
    {
        Auth::guard('seller')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login');
    }
    public function adminlogout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }
    public function adminAuthlogout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function Orders()
    {
        $buyer = Auth::guard('seller')->user();

        if (!$buyer) {
            return redirect()->route('user.login')->with('error', 'Please login to view your orders.');
        }

        // Get orders with related product and address information
        $orders = Order::with(['product', 'address'])
            ->where('buyer_id', $buyer->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('order_id'); // Group by order_id to show combined orders

        return view('view.orders', compact('orders', 'buyer'));
    }
    public function parseOrderId($order_id)
    {
        $parts = explode('ORD', $order_id);

        if (count($parts) !== 2) {
            throw new Exception('Invalid order ID format');
        }

        $user_id = intval($parts[0]);
        $package_and_remaining = $parts[1];

        $id_parts = explode('ID', $package_and_remaining);

        if (count($id_parts) !== 2) {
            throw new Exception('Invalid order ID format: Missing ID marker');
        }

        $package_id = intval($id_parts[0]);
        $timestamp_and_user_type = $id_parts[1];

        $timestamp_length = 8;
        $user_type_length = 2;
        $timestamp = substr($timestamp_and_user_type, 0, $timestamp_length);
        $user_type = substr($timestamp_and_user_type, -$user_type_length);

        $is_old_user = $user_type === 'S1';

        return [
            'user_id' => $user_id,
            'package_id' => $package_id,
            'timestamp' => $timestamp,
            'is_old_user' => $is_old_user,
        ];
    }

    public function termsConditions()
    {
        $terms = TermsAndPolicy::findOrFail(1);
        return view('view.terms', compact('terms'));
    }
    public function privacyPolicy()
    {

        $policy = TermsAndPolicy::findOrFail(2);
        return view('view.policy', compact('policy'));
    }

    public function aboutUs()
    {
        $about = TermsAndPolicy::findOrFail(3);
        return view('view.aboutus', compact('about'));
    }
    public function contact()
    {
        $genaral = GeneralDetail::find(1);
        return view('view.contact', compact('genaral'));
    }
    public function sales($slug = null)
    {
        if ($slug) {
            return view('view.sales', compact('slug'));
        } else {
            return view('view.sales');
        }
    }
    public function enquire(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits:10',
            'city' => 'required|string|max:255',
            'pro_id' => 'nullable|string',
            'isthiswhatsapp' => 'nullable|in:on,off',
        ]);
        $id = $validated['pro_id'] ? Hashids::decode($validated['pro_id']) : null;
        if ($id && count($id) > 0) {
            $id = $id[0];
        } else {
            $id = null;
        }
        $recaptcha_response = $_POST['g-recaptcha-response'];
        $secret_key = '6LcpU8cqAAAAAHRPmjVS5-aDNgaSCYS6CfkZnucr';
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$recaptcha_response");
        $response_data = json_decode($response);
        if (!$response_data->success) {
            return redirect()->back()->with('error', 'reCAPTCHA verification failed.');
        }

        $sale = Sale::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'pro_id' => $id,
            'isthiswhatsapp' => $validated['isthiswhatsapp'] ?? 'off',
        ]);

        return redirect()->back()->with('success', 'Request Sent Successfully.');
    }
    public function userEnquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $validatedData = $validator->validated();
        try {
            Mail::to($validatedData['email'])->send(new SendMail($validatedData));
            return redirect()->route('home')->with('alert', [
                'type' => 'success',
                'message' => 'Form submitted successfully. We have sent you an email.'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Failed to submit the form. Please try again later.'
            ])->withInput();
        }
    }

}

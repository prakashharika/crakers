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
use App\Models\GeneralDetail;
use App\Models\OrderPackage;
use App\Models\Package;
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

        if (!$query) {
            return response()->json([]);
        }

        $results = PropertiesList::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('title', 'LIKE', "%{$query}%")
                ->orWhere('area', 'LIKE', "%{$query}%")
                ->orWhere('configuration', 'LIKE', "%{$query}%")
                ->orWhere('price', 'LIKE', "%{$query}%")
                ->orWhere('address', 'LIKE', "%{$query}%")
                ->orWhere('total_floors', 'LIKE', "%{$query}%")
                ->orWhere('facing', 'LIKE', "%{$query}%")
                ->orWhere('property_age', 'LIKE', "%{$query}%")
                ->orWhere('location', 'LIKE', "%{$query}%")
                ->orWhere('about_property', 'LIKE', "%{$query}%");
        })
            ->where('status', 1)
            ->where(function ($queryBuilder) {
                $queryBuilder->whereHas('LandOwner.OrderPackage', function ($query) {
                    $query->where('status', 'active'); // Active order packages
                })
                    ->orWhereNull('land_owner_id');
            })
            ->get();
        foreach ($results as $property) {
            $property->view_url = route('property-view', [
                'slug' => \Hashids::encode($property->id),
                'name' => Str::slug($property->title),
            ]);
            $images = json_decode($property->images, true);
            if (is_array($images) && !empty($images)) {
                $property->first_image = asset('uploads/properties/images') . '/' . $images[0];
            } else {
                $property->first_image = null;
            }
        }
        return response()->json($results);
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
        $services = LandOwner::create($data);
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
            //     $landowner = LandOwner::find($landownerId);
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
                    $landowner = LandOwner::find($landownerId);
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

                $landowner = LandOwner::find($landownerId);
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
        $owner = LandOwner::where('email', $request->email)->first();

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

        $owner = LandOwner::where('email', $email)->first();

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
        $googleUser = FacadesSocialite::driver('google')->user();
        // dd($googleUser->email );
        $owner = LandOwner::where('email', $googleUser->email)->first();
        if ($owner) {
            Auth::guard('seller')->login($owner);
            return redirect()->route('seller.dashboard')->with('success', 'OTP verified successfully!');
        } else {
            return redirect()->route('post.property')->withErrors(['error' => 'Your Account Information is not with us. Please do register!']);
        }
    }

    /**
     * Resend OTP to the user.
     */
    public function resendOtp(Request $request)
    {

        $owner = LandOwner::where('email', session('email'))->first();

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
        return redirect()->route('seller.login');
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
    public function destroy(string $id)
    {
        //
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

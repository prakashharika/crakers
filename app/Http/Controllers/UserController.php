<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function userLogin()
    {
        return view('view.login');
    }

    public function userLoginCheck(Request $request)
    {
        // Validate input
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData->errors())->withInput();
        }

        // Get user by email
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'No account found with this email.')->withInput();
        }

        // Check password
        if (Hash::check($request->password, $user->password)) {
            // Login the user
            Auth::guard('user')->login($user, $request->has('remember'));

            // Optional: check email verification
            if (is_null($user->email_verified_at)) {
                Auth::guard('user')->logout();
                return redirect()->back()->with('error', 'Please verify your email before logging in.')->withInput();
            }

            return redirect()->route('home')->with('success', 'Login successful!');
        }

        return redirect()->back()->with('error', 'Invalid credentials. Please try again.')->withInput();
    }

    public function userRegister()
    {
        return view('view.register');
    }

    public function userRegisterStore(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/^[0-9]{10,15}$/|unique:users,phone',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData->errors())->withInput();
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            Auth::guard('user')->login($user);

            return redirect()->route('mail.verify')->with('success', 'Registration successful!');
        } catch (Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Registration failed. Please try again.')->withInput();
        }
    }

    public function mailVerify()
    {
        return view('view.verify');
    }
    public function userForgot()
    {
        return view('view.forgot-password');
    }

    public function userSendResetLink(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData->errors())->withInput();
        }

        try {
            $status = Password::broker('users')->sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? back()->with('success', __($status))
                : back()->with('error', __($status));
        } catch (Exception $e) {
            Log::error('Password reset error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send reset link. Please try again.');
        }
    }

    public function userResetPassword(Request $request, $token = null)
    {
        return view('view.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function userUpdatePassword(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData->errors());
        }

        $status = Password::broker('users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('view.login')->with('success', __($status))
            : back()->with('error', __($status));
    }

    public function userLogout()
    {
        Auth::guard('user')->logout();
        Session::flush();
        return redirect()->route('view.login')->with('success', 'You have been logged out successfully.');
    }

    // Social login methods (optional)
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();

            $existingUser = User::where('email', $user->getEmail())->first();

            if ($existingUser) {
                Auth::guard('user')->login($existingUser, true);
            } else {
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make(Str::random(12)),
                    'provider' => $provider,
                    'provider_id' => $user->getId(),
                ]);

                Auth::guard('user')->login($newUser, true);
            }

            return redirect()->route('order.package')->with('success', 'Login successful!');
        } catch (Exception $e) {
            Log::error('Social login error: ' . $e->getMessage());
            return redirect()->route('view.login')->with('error', 'Login failed. Please try again.');
        }
    }
}
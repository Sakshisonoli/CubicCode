<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Mail\AccountCreatedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(){
        return view('backend.auth.login');
    }

    public function logout(){

        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }

    public function register(){
        return view('backend.auth.register');
    }

    // public function adminStore(Request $request){

    //     $this->validate($request, [
    //         'name' => 'required|string|min:3|max:50',
    //         'email' => 'required|email',
    //         'phone' => 'required||regex:/^(\+\d{1,3})?[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/',
    //         'password' => 'required|min:6|confirmed',
    //     ]);

    //     $requestAdmin = $request->except(['_token']);

    //     if (User::where('email', $request->email)->exists()) {
    //         return redirect()->back()->with('error', 'You already have an account with this email. Please try a different one.');
    //     }

    //     $requestAdmin['password'] = Hash::make($request->password);
    //     $requestAdmin['role'] = 'customer';
    //     $requestAdmin['status'] = 'active';
    //     $user = User::create($requestAdmin);

    //     $customerName = $user->name;
    //     Mail::to($user->email)->send(new AccountCreatedMail($customerName));

    //     return redirect()->route('login')->with('success', 'Hooray!, Your account has been created, login using your email and password.');
    // }

    public function adminStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email',
            'phone' => 'required|regex:/^(\+\d{1,3})?[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/',
            'password' => 'required|min:6|confirmed',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error', 'You already have an account with this email. Please try a different one.');
        }

        $data = $request->except('_token');
        $data['password'] = Hash::make($request->password);
        $data['role'] = 'customer';
        $data['status'] = 'inactive';

        $user = User::create($data);

        $customerName = $user->name;
        Mail::to($user->email)->send(new AccountCreatedMail($customerName));

        // Store user ID in session for OTP
        Session::put('otp_user_id', $user->id);

        // Send OTP to user's phone
        $mobile = $user->phone;
        if (!Str::startsWith($mobile, '91')) {
            $mobile = '91' . ltrim($mobile, '0');
        }

        $response = Http::post("https://control.msg91.com/api/v5/otp", [
            "authkey" => "444743AQqrMaJSE6831e2dfP1",
            "template_id" => "6831cc56d6fc057e744b0103",
            "mobile" => $mobile,
        ]);

        if ($response->successful()) {
            return redirect()->route('otp.verify.screen')->with('success', 'OTP sent to your phone. Please verify.');
        } else {
            Log::error('OTP send failed after registration: ' . $response->body());
            return redirect()->route('login')->with('error', 'Failed to send OTP. Please contact support.');
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required']);

        $userId = Session::get('otp_user_id');
        $user = \App\Models\User::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'User session expired. Please login again.');
        }

        $mobile = $user->phone;
        if (!Str::startsWith($mobile, '91')) {
            $mobile = '91' . ltrim($mobile, '0');
        }

        $response = Http::post("https://control.msg91.com/api/v5/otp/verify", [
            "authkey" => "444743AQqrMaJSE6831e2dfP1",
            "mobile" => $mobile,
            "otp" => $request->otp,
        ]);

        if ($response->successful() && $response->json('type') === 'success') {
            Session::forget('otp_user_id');

            $user->update(['status' => 'active']);

            Auth::login($user);

            if ($user->role === 'admin') {
                return redirect()->route('admin_dashboard');
            } elseif ($user->role === 'customer') {
                return redirect()->route('customer_dashboard');
            }

            return redirect('/dashboard');
        }

        Log::error('OTP Verification Failed: ' . $response->body());

        return back()->with('error', 'Invalid OTP. Please try again.');
    }

    public function showOtpScreen()
    {
        if (!Session::has('otp_user_id')) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        return view('backend.auth.verify-otp');
    }

    public function resendOtp()
    {
        $userId = Session::get('otp_user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        $mobile = $user->phone;
        if (!Str::startsWith($mobile, '91')) {
            $mobile = '91' . ltrim($mobile, '0');
        }

        $response = Http::post("https://control.msg91.com/api/v5/otp", [
            "authkey" => "444743AQqrMaJSE6831e2dfP1",
            "template_id" => "6831cc56d6fc057e744b0103",
            "mobile" => $mobile,
        ]);

        if ($response->successful()) {
            return back()->with('success', 'OTP resent successfully.');
        }

        return back()->with('error', 'Failed to resend OTP. Please try again.');
    }



    public function authentication(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->except(['_token']);

        if(Auth::attempt($credentials)){

            if(auth()->user()->status === 'active'){

                if(auth()->user()->role === 'admin'){
                    return redirect()->route('admin_dashboard');
                }
                elseif(auth()->user()->role === 'customer'){
                    return redirect()->route('customer_dashboard');
                }
                else{
                    return redirect()->back()->withErrors(['email' => 'Invalid credentials', 'password' => 'Invalid credentials']);
                }
            }
            else{
                return redirect()->back()->with('error', 'You are inactive, please contact the administrator.');
            }
        }

        return redirect()->back()->with('error', 'Please enter valid credentials.');
    }


    // public function authentication(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = auth()->user();

    //         if ($user->status !== 'active') {
    //             return back()->with('error', 'You are inactive, please contact the administrator.');
    //         }

    //         Session::put('otp_user_id', $user->id);

    //         $mobile = $user->phone;
    //         if (!Str::startsWith($mobile, '91')) {
    //             $mobile = '91' . ltrim($mobile, '0');
    //         }

    //         $response = Http::post("https://control.msg91.com/api/v5/otp", [
    //             "authkey"     => "444743AQqrMaJSE6831e2dfP1",
    //             "template_id" => "6831cc56d6fc057e744b0103",
    //             "mobile"      => $mobile,
    //             // "otp_length"  => 6,
    //             // "otp_expiry"  => 5
    //         ]);

    //         if ($response->successful()) {
    //             Log::info('OTP sent successfully: ' . $response->body());
    //             return redirect()->route('otp.verify.screen');
    //         } else {
    //             Log::error('OTP send failed: ' . $response->body());
    //             return back()->with('error', 'Failed to send OTP: ' . $response->json('message'));
    //         }
    //     }

    //     return back()->with('error', 'Please enter valid credentials.');
    // }

    // public function verifyOtp(Request $request)
    // {
    //     $request->validate(['otp' => 'required']);

    //     $userId = Session::get('otp_user_id');
    //     $user = \App\Models\User::find($userId);

    //     if (!$user) {
    //         return redirect()->route('login')->with('error', 'User session expired. Please login again.');
    //     }

    //     $mobile = $user->phone;
    //     if (!Str::startsWith($mobile, '91')) {
    //         $mobile = '91' . ltrim($mobile, '0');
    //     }

    //     $response = Http::post("https://control.msg91.com/api/v5/otp/verify", [
    //         "authkey" => "444743AQqrMaJSE6831e2dfP1",
    //         "mobile" => $mobile,
    //         "otp" => $request->otp,
    //     ]);

    //     if ($response->successful() && $response->json('type') === 'success') {
    //         Session::forget('otp_user_id');

    //         // Re-authenticate and redirect
    //         Auth::login($user);

    //         if ($user->role === 'admin') {
    //             return redirect()->route('admin_dashboard');
    //         } elseif ($user->role === 'customer') {
    //             return redirect()->route('customer_dashboard');
    //         }

    //         return redirect('/dashboard');
    //     }

    //     \Log::error('OTP Verification Failed: ' . $response->body());

    //     return back()->with('error', 'Invalid OTP. Please try again.');
    // }




    //Password Reset Code
    public function showForgotPasswordForm()
    {
        return view('backend.auth.forgot_password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found.');
        }

        // Save to session
        Session::put('reset_user_id', $user->id);

        $mobile = $user->phone;
        if (!Str::startsWith($mobile, '91')) {
            $mobile = '91' . ltrim($mobile, '0');
        }

        Http::post("https://control.msg91.com/api/v5/otp", [
            "authkey" => "444743AQqrMaJSE6831e2dfP1",
            "template_id" => "6831cc56d6fc057e744b0103",
            "mobile" => $mobile,
        ]);

        return redirect()->route('verify.reset.otp')->with('success', 'OTP sent to your registered mobile.');
    }

    public function showOtpVerificationForm()
    {
        if (!Session::has('reset_user_id')) {
            return redirect()->route('forgot.password')->with('error', 'Session expired.');
        }

        return view('backend.auth.verify_reset_otp');
    }

    public function verifyResetOtp(Request $request)
    {
        $request->validate(['otp' => 'required']);
        $user = User::find(Session::get('reset_user_id'));

        // $response = Http::post("https://control.msg91.com/api/v5/otp/verify", [
        //     "authkey" => "YOUR_AUTH_KEY",
        //     "mobile" => $user->phone,
        //     "otp" => $request->otp,
        // ]);
        $mobile = $user->phone;
        if (!Str::startsWith($mobile, '91')) {
            $mobile = '91' . ltrim($mobile, '0');
        }

        $response = Http::post("https://control.msg91.com/api/v5/otp/verify", [
            "authkey" => "444743AQqrMaJSE6831e2dfP1",
            "mobile" => $mobile,
            "otp" => $request->otp,
        ]);

        if ($response->successful() && $response->json('type') === 'success') {
            Session::put('otp_verified_for_reset', true);
            return redirect()->route('reset.password');
        }

        return back()->with('error', 'Invalid OTP.');
    }

    public function showResetForm()
    {
        if (!Session::get('otp_verified_for_reset')) {
            return redirect()->route('forgot.password')->with('error', 'OTP verification required.');
        }

        return view('backend.auth.reset_password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(Session::get('reset_user_id'));
        $user->password = Hash::make($request->password);
        $user->save();

        // Clear session
        Session::forget(['reset_user_id', 'otp_verified_for_reset']);

        return redirect()->route('login')->with('success', 'Password reset successfully.');
    }

}

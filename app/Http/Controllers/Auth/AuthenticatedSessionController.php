<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use App\Models\User; // Import the User model

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        // Generate and send OTP
        // uncomment this part to use otp 
        // $user = User::where('email', $request->email)->firstOrFail();
        // $user->otp = rand(100000, 999999); // 6-digit OTP
        // $user->otp_expires_at = now()->addMinutes(10);
        // $user->save();
    
        // Mail::to($user->email)->send(new OTPMail($user->otp));
    
        // auth()->logout(); // Logout after sending OTP
    
        // session(['email' => $request->email]); // Store email in session
        // return redirect()->route('otp.verify');


        //if commenting above code to stop using otp uncomment the redirect below
        return redirect()->intended(RouteServiceProvider::HOME);

    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function checkOTP(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);
    
        $user = User::where('otp', $request->otp)
                    ->where('otp_expires_at', '>', now())
                    ->first();
    
        if (!$user) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }
    
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();
    
        Auth::login($user);
    
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function resendOTP(Request $request)
    {
        $email = session('email');
        $user = User::where('email', $email)->first();
    
        if (!$user) {
            return back()->withErrors(['error' => 'User not found.']);
        }
    
        // Generate a new OTP and save it
        $user->otp = rand(100000, 999999); // 6-digit OTP
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();
    
        // Resend the OTP via email
        Mail::to($user->email)->send(new OTPMail($user->otp));
    
        return back()->with('status', 'OTP has been resent.');
    }
    
    
}

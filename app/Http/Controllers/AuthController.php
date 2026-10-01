<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\RegistrationOtp;
use App\Mail\RegistrationOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect('/inventori');
        }

        return back()->withErrors([
            'email' => 'Email atau Password Salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showRegister()
    {
        return view('/auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $otp = $this->generateOtp();

        RegistrationOtp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5),
        ]);

        Mail::to($request->email)->send(new RegistrationOtpMail($otp));

        session([
            'register_name' => $request->name,
            'register_email' => $request->email,
            'register_password' => $request->password,
        ]);


        return redirect('/verify-otp');
    }

    private function generateOtp()
    {
        return (string) random_int(100000, 999999);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = session('register_email');

        $registrationOtp = RegistrationOtp::where('email', $email)
            ->latest()
            ->first();
            
        if (!$registrationOtp) {
            return back()->withErrors([
                'otp' => 'OTP TIDAK DI TEMUKAN.',
            ]);
        }

        if ($registrationOtp->otp !== $request->otp) {
            return back()->withErrors([
                'otp' => 'OTP SALAH!!.',
            ]);
        }

        if (now()->greaterThan($registrationOtp->expires_at)) {
            return back()->withErrors([
                'otp' => 'OTP SUDAH EXPIRED',
            ]);
        }

        $user = new User();

        $user->name = session('register_name');
        $user->email = session('register_email');
        $user->password = Hash::make(session('register_password'));
        $user->role = 'user';

        $user->save();

        $registrationOtp->delete();

        session()->forget([
            'register_name',
            'register_email',
            'register_password',
        ]);

        return redirect('/login')->with('success', 'Registrasi Berhasil Silahkan Login');
    }
}

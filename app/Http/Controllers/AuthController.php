<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\RegistrationOtp;
use App\Mail\RegistrationOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordResetOtp;

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

    public function resendOtp()
    {
        $email = session('register_email');

        if (!$email) {
            return redirect('/register')->withErrors([
                'email' => 'Session Registrasi sudah tidak di temukan.'
            ]);
        }

        $otp = $this->generateOtp();

        RegistrationOtp::where('email', $email)->delete();

        RegistrationOtp::create([
            'email' => $email,
            'otp' => $otp,
            'expires_at' => now()->addMinute(5),
        ]);

        Mail::to($email)->send(new RegistrationOtpMail($otp));

        return back()->with('success', 'OTP baru sudah di kirim ke email.');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password-otp');
    }

    public function sendPasswordResetOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->email;
        $otp = $this->generateOtp();

        PasswordResetOtp::where('email', $email)->delete();

        PasswordResetOtp::create([
            'email' => $email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5),
        ]);

        Mail::to($email)->send(
            new PasswordResetOtpMail($otp)
        );

        $request->session()->put('password_reset_email', $email);

        return redirect('/reset-password/verify')->with(
            'success',
            'Kode OTP reset password sudah dikirim ke email.'
        );
    }

    public function showResetPasswordOtp()
    {
        return view('auth.reset-password');
    }

    public function verifyResetPasswordOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = $request->session()->get('password_reset_email');

        if (!$email) {
            return redirect('/forgot-password')->withErrors(['email' => 'silahkan minta kode otp dulu.']);
        }

        $resetOtp = PasswordResetOtp::where('email', $email)
            ->latest()
            ->first();
        if (!$resetOtp || $resetOtp->otp !== $request->otp) {
            return back()->withErrors([
                'otp' => 'Kode OTP Tidak Valid.',
            ]);
        }

        if ($resetOtp->expires_at->isPast()) {
            return back()->withErrors([
                'otp' => 'Kode OTP Sudah Kedaluwarsa. Silahkan Minta Kode OTP Baru.',
            ]);
        }
        //OTP VALID DAN BLUM KEDALUWARSA USER->PASSWORD BARU
        $request->session()->put('password_reset_verified', true);
        return redirect('/reset-password/new');
    }

    public function  showNewPasswordForm(Request $request)
    {
        if (
            !$request->session()->get('password_reset_email') ||
            !$request->session()->get('password_reset_verified')
        ) {
            return redirect('/forgot-password')->withErrors([
                'email' => 'silahkan verifikasi OTP terlebihdahulu.',
            ]);
        }

        return view('auth.reset-password-new');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $email = $request->session()->get('password_reset_email');

        if (!$email || !$request->session()->get('password_reset_verified')) {
            return redirect('/forgot-password')
                ->withErrors([
                    'email' => 'Silakan verifikasi OTP terlebih dahulu.',
                ]);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect('/forgot-password')
                ->withErrors([
                    'email' => 'Akun tidak ditemukan.',
                ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        PasswordResetOtp::where('email', $email)->delete();

        $request->session()->forget([
            'password_reset_email',
            'password_reset_verified',
        ]);

        return redirect('/login')->with(
            'success',
            'Password berhasil diubah. Silakan login dengan password baru.'
        );
    }
}

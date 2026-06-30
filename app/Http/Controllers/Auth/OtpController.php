<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class OtpController extends Controller
{
    // 1. Tampilkan Halaman Input OTP
    public function showVerifyForm()
    {
        return view('auth.verify-otp');
    }

    // 2. Proses Verifikasi Kode OTP (Diproteksi Rate Limiting OWASP)
    public function verify(Request $classRequest)
    {
        $user = Auth::user();
        
        // Menggabungkan array input OTP menjadi 1 string (misal: -> "12345")
        $otpCode = implode('', $classRequest->input('otp', []));

        // Kunci Rate Limiter berdasarkan ID user untuk mencegah Brute Force (OWASP A07)
        $key = 'verify-otp:' . $user->id;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors(['otp' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik."]);
        }

        // [CONTOH LOGIKA SIMPEL] Ganti "12345" dengan logika pengecekan kolom OTP di database Anda nantinya
        if ($otpCode === '12345') {
            RateLimiter::clear($key);
            
            // Tandai session bahwa user sudah lolos 2FA/OTP
            session(['otp_verified' => true]);

            return redirect()->route('dashboard');
        }

        // Jika salah, catat sebagai percobaan gagal
        RateLimiter::hit($key, 60); // Reset kunci setelah 60 detik

        return back()->withErrors(['otp' => 'Kode OTP yang Anda masukkan salah!']);
    }
}
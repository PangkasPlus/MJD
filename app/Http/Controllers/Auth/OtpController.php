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
    public function verify(Request $request)
    {
        $user = Auth::user();
        
        // Proteksi jika user belum login sama sekali
        if (!$user) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi Anda telah berakhir. Silakan login kembali.'
                ], 401);
            }
            return redirect()->route('login');
        }

        // Tangkap kode OTP dari input hidden tunggal yang dikirim oleh JavaScript
        $otpCode = $request->input('otp_code');

        // Kunci Rate Limiter berdasarkan ID user untuk mencegah Brute Force (OWASP A07)
        $key = 'verify-otp:' . $user->id;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik."
                ]);
            }
            return back()->withErrors(['otp' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik."]);
        }

        // Pengecekan Kode OTP dummy '12345'
        if ($otpCode === '12345') {
            // Bersihkan history percobaan gagal jika sukses
            RateLimiter::clear($key);

            // Set sesi login sukses OTP agar lolos middleware pertahanan dashboard
            session(['otp_verified' => true]);

            // Respon sukses JSON untuk memicu animasi Centang Popping Out di Blade
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => route('dashboard')
                ]);
            }
    
            return redirect()->route('dashboard');
        } else {
            // Catat sebagai percobaan gagal jika kode OTP keliru
            RateLimiter::hit($key, 60); // Blokir sementara jika gagal hingga 5 kali dalam 60 detik

            // Respon gagal JSON untuk memicu Layar Biru Cerah di Blade
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode yang dimasukkan salah.'
                ]);
            }

            return back()->withErrors(['otp' => 'Kode yang dimasukkan salah.']);
        }
    }
}
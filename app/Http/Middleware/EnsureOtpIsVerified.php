<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureOtpIsVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login ke sistem utama Laravel
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Cek Sesi Tambahan: Apakah user sudah lolos verifikasi OTP?
        if (!session('otp_verified')) {
            // Jika request via AJAX JavaScript, berikan respon JSON agar ditangani sistem
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'redirect' => route('otp.verify')
                ], 403);
            }
            
            // Tembak balik ke halaman input OTP jika akses normal lewat URL browser
            return redirect()->route('otp.verify');
        }

        return $next($request);
    }
}
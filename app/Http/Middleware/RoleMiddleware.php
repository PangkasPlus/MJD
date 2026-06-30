<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // 2. Cek apakah akun aktif
        if ($user->status !== 'aktif') {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda telah dinonaktifkan. Silakan hubungi Admin.',
            ]);
        }

        // 3. Cek apakah role sesuai
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya hak akses, lempar error 403 (Unauthorized)
        abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
    }
}
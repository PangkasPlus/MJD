<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated; // Ambil namespace ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Atur agar jika user sudah login, otomatis dilempar ke route bernama 'dashboard'
        RedirectIfAuthenticated::redirectUsing(fn () => route('dashboard'));
    }
}

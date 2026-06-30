<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Route Tampilan & Aksi Verifikasi OTP
    Route::get('/verify-otp', [OtpController::class, 'showVerifyForm'])->name('otp.verify');
    Route::post('/verify-otp', [OtpController::class, 'verify']);

    // Route Dashboard (Pengecekan session OTP dilakukan di dalam Controller saja agar aman dari bug routing)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- PLACEHOLDER ROUTE (Agar Sidebar Tidak Error) ---
    Route::get('/kategori', function () { return "Halaman Kategori (Segera Hadir)"; })->name('kategori.index');
    Route::get('/produk', function () { return "Halaman Produk (Segera Hadir)"; })->name('produk.index');
    Route::get('/penjualan', function () { return "Halaman Penjualan (Segera Hadir)"; })->name('penjualan.index');
    Route::get('/user', function () { return "Halaman Kelola User (Segera Hadir)"; })->name('user.index');

    // Route Dashboard Utama yang mengarah ke Controller
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // --- PLACEHOLDER ROUTE (Agar Sidebar Tidak Error) ---
    
    // Kategori
    Route::get('/kategori', function () { return "Halaman Kategori (Segera Hadir)"; })->name('kategori.index');
    
    // Produk
    Route::get('/produk', function () { return "Halaman Produk (Segera Hadir)"; })->name('produk.index');
    
    // Penjualan
    Route::get('/penjualan', function () { return "Halaman Penjualan (Segera Hadir)"; })->name('penjualan.index');
    
    // Kelola User
    Route::get('/user', function () { return "Halaman Kelola User (Segera Hadir)"; })->name('user.index');
});

// Route Login Utama
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route OTP (Sesuai dokumen, pastikan mengarah ke halaman verifikasi)
Route::get('/verify-otp', [DashboardController::class, 'showOtpForm'])->name('otp.verify');
Route::post('/verify-otp', [DashboardController::class, 'verifyOtp'])->name('otp.submit');

// Route Dashboard (Dilindungi middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';

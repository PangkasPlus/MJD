<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CategoryController;

// 1. Halaman Depan / Welcome
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Route Login Utama
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// 3. Kelompok Route yang Wajib Login (Auth Middleware)
Route::middleware(['auth'])->group(function () {
    
    // Tampilan & Aksi Verifikasi OTP (Mengarah ke OtpController yang benar)
    Route::get('/verify-otp', [OtpController::class, 'showVerifyForm'])->name('otp.verify');
    Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.submit');

    // Dashboard Utama SIM MJD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- PLACEHOLDER ROUTE (Agar Sidebar Tidak Error) ---
    Route::get('/kategori', function () { return "Halaman Kategori (Segera Hadir)"; })->name('kategori.index');
    Route::get('/produk', function () { return "Halaman Produk (Segera Hadir)"; })->name('produk.index');
    Route::get('/penjualan', function () { return "Halaman Penjualan (Segera Hadir)"; })->name('penjualan.index');
    Route::get('/user', function () { return "Halaman Kelola User (Segera Hadir)"; })->name('user.index');
});

// Rute Authentication bawaan (Contoh)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// ========================================================
// PROSES OTP (Bisa diakses setelah login utama, sebelum dashboard)
// ========================================================
Route::middleware(['auth'])->group(function () {
    Route::get('/verify-otp', [OtpController::class, 'showVerifyForm'])->name('otp.verify');
    Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.submit');
});

// ========================================================
// AREA SECURE DASHBOARD (Wajib Lolos Login & Lolos Verifikasi OTP)
// ========================================================
Route::middleware(['auth', \App\Http\Middleware::class . '\EnsureOtpIsVerified'])->group(function () {
    
    // Halaman Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Fitur Tambahan Manajemen Lainnya di sini...
    // Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');

    // TOMBOL KELUAR (LOGOUT) DEMO
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Route Halaman Manajemen Produk
Route::get('/produk', [ProductController::class, 'index'])->name('produk');

// Route Halaman Riwayat Penjualan
Route::get('/penjualan', [SalesController::class, 'index'])->name('penjualan');

// Route Akses Kategori Kasir
Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori');

require __DIR__.'/auth.php';
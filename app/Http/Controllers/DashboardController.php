<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Penjualan;

class DashboardController extends Controller
{
    public function index()
    {
        if ($request->ajax()) {
            if ($otp_benar) {
                return response()->json([
                    'success' => true,
                    'redirect_url' => route('dashboard')
                ]);
            } else {
                return response()->json([
                    'success' => false
            ], 422);
        }
    }
        
        // 1. Jalankan proteksi keamanan sesi OTP
        if (!session('otp_verified')) {
            return redirect()->route('otp.verify');
        }

        // 2. Ambil data statistik dengan fallback nilai 0 jika tabel belum siap
        $totalProduk = class_exists(Produk::class) ? Produk::count() : 0;
        $totalKategori = class_exists(Kategori::class) ? Kategori::count() : 0;
        
        $transaksiHariIni = class_exists(Penjualan::class) 
            ? Penjualan::whereDate('created_at', today())->count() 
            : 0;

        $stokKritis = class_exists(Produk::class) 
            ? Produk::where('stok', '<', 5)->count() 
            : 0;

        // 3. Sediakan Data Grafik (Labels dan Data Penjualan)
        $labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $totals = [0, 0, 0, 0, 0, 0, 0]; // Diubah dari $dataPenjualan menjadi $totals

        // 4. Kirim semua variabel ke file blade
        return view('dashboard', compact(
            'totalProduk', 
            'totalKategori', 
            'transaksiHariIni', 
            'stokKritis',
            'labels',
            'totals' // Pastikan ini juga menggunakan 'totals'
        ));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) 
    {
        // 1. Data Ringkasan Atas (Kartu Statistik)
        $ringkasan = [
            'total_pendapatan' => 'Rp 5.345.897',
            'total_penjualan'   => '3.504',
            'pertumbuhan'       => '13%',
            'penjualan_rata'    => 'Rp 250.000'
        ];

        // 2. Data Grafik Ringkasan Penjualan Bulanan (Batang Merah & Hijau)
        $grafikBatang = [
            'labels'      => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'pengeluaran' => [720, 520, 560, 680, 500, 390, 780, 810, 740, 620, 500, 420],
            'pendapatan'  => [250, 410, 650, 720, 380, 210, 950, 430, 990, 850, 230, 610]
        ];

        // 3. Data Pemberitahuan Stok Kritis
        $stokKritis = [
            ['nama' => 'Filter Oli Cat 320D', 'status' => 'Kritis', 'sisa' => '3 Unit', 'level' => 'danger'],
            ['nama' => 'Selang 1 Inc', 'status' => 'Kritis', 'sisa' => '1 Meter', 'level' => 'danger'],
            ['nama' => 'Pin Bucket', 'status' => 'Rendah', 'sisa' => '3 Unit', 'level' => 'warning'],
            ['nama' => 'Seal Kit', 'status' => 'Rendah', 'sisa' => '3 Unit', 'level' => 'warning'],
        ];

        // 4. Data Grafik Horizontal (Hose)
        $grafikHose = [
            'labels' => ['Maguro', 'Donaldson', 'Liebherr', 'Cat', 'Zaxis', 'CorelDRAW', 'InDesign', 'Canva', 'Webflow', 'Affinity', 'Marker', 'Figma'],
            'values' => [77.55, 62.56, 60.78, 59.62, 59.34, 52.58, 52.42, 41.50, 29.49, 25.12, 21.54, 13.52]
        ];

        // 5. Data Kategori Penjualan Produk (Donut/Stacked)
        $kategoriPenjualan = [
            ['nama' => 'Maguro', 'persen' => 27, 'color' => '#E0E7FF'],
            ['nama' => 'Donaldson', 'persen' => 23, 'color' => '#EEF2F6'],
            ['nama' => 'Liebherr', 'persen' => 20, 'color' => '#06B6D4'],
            ['nama' => 'Cat', 'persen' => 15, 'color' => '#F1F5F9'],
            ['nama' => 'Zaxis', 'persen' => 10, 'color' => '#F8FAFC'],
            ['nama' => 'CorelDRAW', 'persen' => 5, 'color' => '#FBFBFB'],
        ];

        // PASTIKAN SEMUA VARIABEL BARU INI MASUK KE COMPACT!
        return view('dashboard', compact('ringkasan', 'grafikBatang', 'stokKritis', 'grafikHose', 'kategoriPenjualan'));
    }
}
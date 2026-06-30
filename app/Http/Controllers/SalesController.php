<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        // Data Dummy Riwayat Penjualan sesuai visualisasi gambar Anda
        $salesHistory = [
            [
                'id' => 1,
                'no_faktur' => '#J8610532/8852',
                'tanggal' => '23 Juni 2026',
                'pelanggan' => 'PT. Jasa Marga',
                'telp' => '+62857-0456-7564',
                'alamat' => 'Jl. Terasering, Lampung Selatan',
                'total' => 'Rp 3.523.000',
                'items' => [
                    ['kode' => 'J878/875', 'nama' => 'Filter Oli Kobelco Sk200-6/Sk210/Sk250', 'qty' => 1, 'unit' => 'pcs', 'harga' => 'Rp 1.500.000', 'subtotal' => 'Rp 1.500.000'],
                    ['kode' => 'MJD-022', 'nama' => 'Oli 10 Liter Cat Premium', 'qty' => 2, 'unit' => 'liter', 'harga' => 'Rp 1.011.500', 'subtotal' => 'Rp 2.023.000']
                ]
            ],
            [
                'id' => 2,
                'no_faktur' => '#J8610532/8853',
                'tanggal' => '24 Juni 2026',
                'pelanggan' => 'PT. Waskita Karya',
                'telp' => '+62812-3456-7890',
                'alamat' => 'Proyek Tol Trans Sumatera',
                'total' => 'Rp 1.038.000',
                'items' => [
                    ['kode' => 'OL-10', 'nama' => 'Oli 10', 'qty' => 1, 'unit' => 'liter', 'harga' => 'Rp 346.000', 'subtotal' => 'Rp 346.000'],
                    ['kode' => 'FL-KB', 'nama' => 'Filter Oli Kobelco Sk200-6/5210/Sk278', 'qty' => 1, 'unit' => 'pcs', 'harga' => 'Rp 346.000', 'subtotal' => 'Rp 346.000'],
                    ['kode' => 'FL-OL', 'nama' => 'Filter Oli', 'qty' => 2, 'unit' => 'pcs', 'harga' => 'Rp 173.000', 'subtotal' => 'Rp 346.000']
                ]
            ]
        ];

        return view('penjualan', compact('salesHistory'));
    }
}
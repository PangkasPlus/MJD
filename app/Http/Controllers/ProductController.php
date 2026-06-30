<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Data Dummy Suku Cadang Sesuai Desain Figma Anda
        $products = [
            [
                'id' => 1, 
                'nama' => 'Filter Oli Kobelco Sk200-6/super (MJD-001)', 
                'stok' => 47, 
                'gambar' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=150&auto=format&fit=crop'
            ],
            [
                'id' => 2, 
                'nama' => 'Filter Oli Caterpillar 320D (MJD-002)', 
                'stok' => 12, 
                'gambar' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=150&auto=format&fit=crop'
            ],
            [
                'id' => 3, 
                'nama' => 'Hose Hydraulic Maguro 1 Inch (MJD-003)', 
                'stok' => 25, 
                'gambar' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=150&auto=format&fit=crop'
            ],
            [
                'id' => 4, 
                'nama' => 'Seal Kit Boom Zaxis 200 (MJD-004)', 
                'stok' => 8, 
                'gambar' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=150&auto=format&fit=crop'
            ],
            [
                'id' => 5, 
                'nama' => 'Filter Solar Donaldson P550388 (MJD-005)', 
                'stok' => 34, 
                'gambar' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=150&auto=format&fit=crop'
            ],
        ];

        return view('produk', compact('products'));
    }
}
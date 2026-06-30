<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Data Dummy Rumpun Kategori Suku Cadang Sesuai Gambar Figma Kasir
        $categories = [
            ['id' => 1, 'nama' => 'Hose Hydraulic', 'gambar' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=300'],
            ['id' => 2, 'nama' => 'Nepple', 'gambar' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=300'],
            ['id' => 3, 'nama' => 'Filter', 'gambar' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=300'],
            ['id' => 4, 'nama' => 'Baut', 'gambar' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=300'],
            ['id' => 5, 'nama' => 'Seal Kit', 'gambar' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=300'],
            ['id' => 6, 'nama' => 'Ferulle', 'gambar' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=300'],
        ];

        return view('kategori', compact('categories'));
    }
}
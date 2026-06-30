<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Menghapus data lama jika ada agar tidak duplikat
        User::where('email', 'admin@mjd.com')->delete();

        // 1. Seed Users (Admin & Kasir)
        // Membuat user admin kustom yang valid
        User::create([
            'name' => 'Admin MJD',
            'email' => 'admin@mjd.com',
            'password' => bcrypt('password'), // Enkripsi standar Laravel
        ]);

        User::create([
            'name' => 'Kasir Mandiri Jaya',
            'email' => 'kasir@mjd.com',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
            'status' => 'aktif',
        ]);

        // 2. Seed Kategori (Suku Cadang)
        $kategori1 = Kategori::create(['nama_kategori' => 'Filter Diesel']);
        $kategori2 = Kategori::create(['nama_kategori' => 'Gasket & Seal']);

        // 3. Seed Produk Dummy
        Produk::create([
            'kode_produk' => 'PRD-0001',
            'nama_produk' => 'Filter Oli Caterpillar 1R-1808',
            'kategori_id' => $kategori1->id,
            'harga_jual' => 350000,
            'stok' => 20,
            'stok_minimum' => 5,
        ]);

        Produk::create([
            'kode_produk' => 'PRD-0002',
            'nama_produk' => 'Full Gasket Kit Komatsu 6D102',
            'kategori_id' => $kategori2->id,
            'harga_jual' => 1250000,
            'stok' => 3, // Sengaja di bawah stok minimum untuk testing dashboard nanti
            'stok_minimum' => 5,
        ]);
    }
}

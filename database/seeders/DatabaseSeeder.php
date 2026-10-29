<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Membuat Akun Admin (Untuk akses halaman /admin/dashboard)
        User::create([
            'name' => 'Fajar',
            'email' => 'admin@selekta.com',
            'password' => Hash::make('password123'), // Passwordnya: password123
            'role' => 'admin',
            'no_wa' => '081234567890',
            'alamat' => 'Toko Selekta, Teras, Boyolali'
        ]);

        // 2. Membuat Akun Penyewa (Untuk ngetes transaksi dari depan)
        User::create([
            'name' => 'Wildan',
            'email' => 'wildan@gmail.com',
            'password' => Hash::make('password123'), // Passwordnya: password123
            'role' => 'penyewa',
            'no_wa' => '089876543210',
            'alamat' => 'Surakarta'
        ]);

        // 3. Membuat Data Kategori Dasar
        $kategoris = [
            'Tenda & Shelter', 
            'Tas Carrier', 
            'Sleeping Bag & Matras', 
            'Peralatan Masak', 
            'Penerangan & Aksesoris'
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create([
                'nama_kategori' => $kategori
            ]);
        }
    }
}
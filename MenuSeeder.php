<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    Menu::create([
        'nama' => 'Nasi Ayam Goreng',
        'deskripsi' => 'Nasi + ayam goreng + sambal',
        'harga' => 15000,
        'stok' => 10,
        'gambar' => 'menu/ayam.jpg'
    ]);

    Menu::create([
        'nama' => 'Nasi Telur Balado',
        'deskripsi' => 'Nasi + telur balado pedas',
        'harga' => 12000,
        'stok' => 15,
        'gambar' => 'menu/telur.jpg'
    ]);

    Menu::create([
        'nama' => 'Ayam Goreng Saja',
        'deskripsi' => 'Ayam goreng tanpa nasi',
        'harga' => 10000,
        'stok' => 20,
        'gambar' => 'menu/ayam2.jpg'
    ]);
}
}
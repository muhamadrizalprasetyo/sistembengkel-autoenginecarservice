<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item; // Ini buat manggil file Model lo

class ItemSeeder extends Seeder
{
    public function run()
    {
        // Masukin data Oli
        Item::create([
            'name' => 'Oli Mesin Prima XP',
            'category' => 'sparepart',
            'price' => 150000,
            'stock' => 20
        ]);

        // Masukin data Busi
        Item::create([
            'name' => 'Busi Iridium NGK',
            'category' => 'sparepart',
            'price' => 85000,
            'stock' => 50
        ]);

        // Masukin data Jasa Tune Up
        Item::create([
            'name' => 'Jasa Tune Up Lengkap',
            'category' => 'service',
            'price' => 200000,
            'stock' => null // Jasa nggak punya stok, jadi dikosongin
        ]);

        // Masukin data Jasa Service AC
        Item::create([
            'name' => 'Jasa Service AC',
            'category' => 'service',
            'price' => 300000,
            'stock' => null
        ]);
    }
}
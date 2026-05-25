<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item; // Ini buat manggil file Model lo

class ItemSeeder extends Seeder
{
    public function run()
    {
        // ==========================================
        // DATA SPAREPART (Suku Cadang & Bahan)
        // ==========================================
        Item::create([
            'name' => 'Oli Mesin Prima XP (4 Liter)',
            'category' => 'sparepart',
            'price' => 250000,
            'stock' => 20
        ]);

        Item::create([
            'name' => 'Busi Iridium NGK',
            'category' => 'sparepart',
            'price' => 85000,
            'stock' => 50
        ]);

        Item::create([
            'name' => 'Filter Oli (Universal)',
            'category' => 'sparepart',
            'price' => 45000,
            'stock' => 30
        ]);

        Item::create([
            'name' => 'Filter Udara',
            'category' => 'sparepart',
            'price' => 120000,
            'stock' => 15
        ]);

        Item::create([
            'name' => 'Kampas Rem Depan (Brake Pad)',
            'category' => 'sparepart',
            'price' => 280000,
            'stock' => 10
        ]);

        Item::create([
            'name' => 'Aki Mobil (GS Astra 45Ah)',
            'category' => 'sparepart',
            'price' => 850000,
            'stock' => 5
        ]);

        Item::create([
            'name' => 'Air Radiator (Coolant 1 Liter)',
            'category' => 'sparepart',
            'price' => 35000,
            'stock' => 40
        ]);

        Item::create([
            'name' => 'Minyak Rem (DOT 4)',
            'category' => 'sparepart',
            'price' => 45000,
            'stock' => 25
        ]);

        Item::create([
            'name' => 'Wiper Kaca Depan (Sepasang)',
            'category' => 'sparepart',
            'price' => 150000,
            'stock' => 12
        ]);

        // ==========================================
        // DATA SERVICE (Jasa Bengkel)
        // ==========================================
        Item::create([
            'name' => 'Jasa Tune Up Lengkap',
            'category' => 'service',
            'price' => 250000,
            'stock' => null // Jasa nggak punya stok, jadi dikosongin
        ]);

        Item::create([
            'name' => 'Jasa Service AC',
            'category' => 'service',
            'price' => 350000,
            'stock' => null
        ]);

        Item::create([
            'name' => 'Jasa Ganti Oli',
            'category' => 'service',
            'price' => 50000,
            'stock' => null
        ]);

        Item::create([
            'name' => 'Jasa Spooring & Balancing',
            'category' => 'service',
            'price' => 200000,
            'stock' => null
        ]);

        Item::create([
            'name' => 'Jasa Ganti Kampas Rem',
            'category' => 'service',
            'price' => 100000,
            'stock' => null
        ]);
    }
}
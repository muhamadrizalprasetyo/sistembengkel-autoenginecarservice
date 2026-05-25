<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── USERS ─────────────────────────────────────
        // SuperAdmin (Owner & IT)
        User::updateOrCreate(
            ['email' => 'owner@autoengine.id'],
            [
                'name' => 'Owner / IT Support',
                'password' => Hash::make('owner123'),
                'role' => 'superadmin',
            ]
        );

        // Admin (Kasir & Staff)
        User::updateOrCreate(
            ['email' => 'staff@autoengine.id'],
            [
                'name' => 'Staff Administrasi',
                'password' => Hash::make('staff123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'kasir@autoengine.id'],
            [
                'name' => 'Kasir Utama',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
            ]
        );

        // ── DEFAULT SETTINGS ──────────────────────────
        $defaults = [
            'workshop_name' => 'AUTO ENGINE CAR SERVICE',
            'receipt_address' => 'Jl. Utama No. 123, Jakarta Selatan',
            'workshop_phone' => '081234567890',
            'receipt_footer' => 'Terima kasih telah mempercayakan kendaraan Anda. Garansi servis 1 minggu.',
            'wa_number' => '6281234567890',
        ];

        foreach ($defaults as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Run items seeder
        $this->call(ItemSeeder::class);
    }
}

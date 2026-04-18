<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    private const CACHE_KEY = 'workshop_settings';

    public function index()
    {
        $default = [
            'workshop_name' => 'AUTO ENGINE EXECUTIVE',
            'receipt_address' => 'Jl. Utama No. 123, Jakarta',
            'workshop_phone' => '081234567890',
            'receipt_footer' => 'Terima kasih, garansi servis 1 minggu',
        ];

        $settings = Cache::get(self::CACHE_KEY, $default);

        return view('settings.index', [
            'settings' => $settings,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'workshop_name' => 'required|string|max:120',
            'receipt_address' => 'required|string|max:255',
            'workshop_phone' => 'required|string|max:30',
            'receipt_footer' => 'required|string|max:255',
        ]);

        Cache::forever(self::CACHE_KEY, $validated);

        return redirect('/settings')->with('success', 'System settings berhasil diperbarui.');
    }
}

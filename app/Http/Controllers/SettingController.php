<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private const DEFAULTS = [
        'workshop_name' => 'AUTO ENGINE CAR SERVICE',
        'receipt_address' => 'Jl. Utama No. 123, Jakarta',
        'workshop_phone' => '081234567890',
        'receipt_footer' => 'Terima kasih, garansi servis 1 minggu.',
        'wa_number' => '6281234567890',
        'wa_token' => '',
        'workshop_logo' => null,
    ];

    public function index()
    {
        $settings = [];
        foreach (self::DEFAULTS as $key => $default) {
            $settings[$key] = Setting::get($key, $default);
        }

        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'workshop_name' => 'required|string|max:120',
            'receipt_address' => 'required|string|max:255',
            'workshop_phone' => 'required|string|max:30',
            'receipt_footer' => 'required|string|max:255',
            'wa_number' => '6281234567890',
            'wa_token' => 'nullable|string|max:100',
        ]);

        foreach ($request->only(array_keys(self::DEFAULTS)) as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect('/settings')->with('success', 'Pengaturan sistem berhasil disimpan.');
    }
}

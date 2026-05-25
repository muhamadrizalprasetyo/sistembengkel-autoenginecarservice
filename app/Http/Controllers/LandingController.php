<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Booking;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        // Ambil setting WA dari DB
        $waNumber = \App\Models\Setting::get('wa_number', '6281234567890');

        // Tampilkan layanan utama (Services), bukan sparepart 'dapur'
        $services = [
            [
                'name' => 'General Tune Up',
                'description' => 'Optimalisasi performa mesin, pembersihan throttle body, dan pengecekan 32 titik komponen.',
                'price' => '350.000',
                'icon' => 'fa-bolt'
            ],
            [
                'name' => 'Engine Overhaul',
                'description' => 'Restorasi mesin total untuk performa layaknya mobil baru. Presisi dan bergaransi.',
                'price' => 'Call for Est.',
                'icon' => 'fa-engine'
            ],
            [
                'name' => 'AC Performance',
                'description' => 'Servis AC berkala, pengisian freon, dan pembersihan evaporator agar kabin tetap sejuk.',
                'price' => '250.000',
                'icon' => 'fa-snowflake'
            ],
            [
                'name' => 'Brake & Suspension',
                'description' => 'Perawatan sistem pengereman dan kaki-kaki demi keamanan dan kenyamanan berkendara.',
                'price' => '150.000',
                'icon' => 'fa-shield-halved'
            ],
            [
                'name' => 'Oil & Fluid Change',
                'description' => 'Penggantian oli mesin, oli transmisi, dan minyak rem dengan produk premium original.',
                'price' => '95.000*',
                'icon' => 'fa-droplet'
            ],
            [
                'name' => 'Computer Diagnostic',
                'description' => 'Pemindaian sistem elektronik kendaraan menggunakan alat diagnosis standar pabrikan.',
                'price' => '150.000',
                'icon' => 'fa-microchip'
            ]
        ];

        // Hitung total item hanya untuk statistik counter di hero
        $sparepartCount = Item::where('category', 'sparepart')->count();

        return view('landing_page', compact('services', 'sparepartCount', 'waNumber'));
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'car_type' => 'required|string|max:255',
            'car_plate' => 'nullable|string|max:20',
            'service_type' => 'required|string|max:255',
            'booking_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string|max:500',
        ]);

        $validated['status'] = 'pending';
        $booking = Booking::create($validated);

        // Notify customer
        \App\Services\NotificationService::notifyBookingSuccess($booking);

        return view('booking_success', compact('booking'));
    }
}

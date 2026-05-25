<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Send WhatsApp message via Fonnte
     */
    public static function sendWhatsApp($target, $message)
    {
        $token = Setting::get('wa_token');

        if (!$token) {
            Log::warning("WhatsApp token not set. Message not sent: " . $message);
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                        'target' => $target,
                        'message' => $message,
                        'countryCode' => '62', // Default Indonesia
                    ]);

            if ($response->successful()) {
                return true;
            }

            Log::error("Fonnte API Error: " . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error("NotificationService Exception: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Notification for Booking Success
     */
    public static function notifyBookingSuccess($booking)
    {
        $message = "Halo " . $booking->customer_name . ",\n\nTerima kasih telah melakukan booking di *Auto Engine*. 🚗\n\nDetail Booking:\n📍 Kode: #" . $booking->id . "\n📅 Tanggal: " . $booking->booking_date->format('d/m/Y') . "\n🚘 Kendaraan: " . $booking->car_type . " (" . $booking->car_plate . ")\n\nAdmin kami akan segera memverifikasi pesanan Anda. Silakan cek status booking Anda di link berikut:\n" . route('booking.tracker', ['kode' => $booking->id]) . "\n\nTerima kasih!";

        return self::sendWhatsApp($booking->phone, $message);
    }

    /**
     * Notification for Service Completed
     */
    public static function notifyServiceCompleted($booking)
    {
        $message = "Halo " . $booking->customer_name . ",\n\nKabar baik! Servis kendaraan Anda (" . $booking->car_plate . ") telah *SELESAI* dikerjakan. ✅\n\nSilakan datang ke bengkel untuk pengambilan kendaraan.\n\nTerima kasih telah mempercayakan kendaraan Anda kepada kami!";

        return self::sendWhatsApp($booking->phone, $message);
    }
}

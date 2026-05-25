<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($sub) use ($q) {
                $sub->where('customer_name', 'like', "%{$q}%")
                    ->orWhere('car_plate', 'like', "%{$q}%")
                    ->orWhere('car_type', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%");
            });
        }

        $bookings = $query->orderBy('booking_date', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'diterima' => Booking::where('status', 'diterima')->count(),
            'selesai' => Booking::where('status', 'selesai')->count(),
        ];

        return view('admin.bookings', compact('bookings', 'stats'));
    }

    public function accept($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'diterima']);

        // Opsional: Notifikasi terima booking bisa ditambahkan di sini

        return redirect()->back()->with('success', 'Booking berhasil diterima!');
    }

    public function complete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'selesai']);

        // Notify customer
        \App\Services\NotificationService::notifyServiceCompleted($booking);

        return redirect()->back()->with('success', 'Booking telah ditandai sebagai selesai!');
    }

    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Booking berhasil dihapus.');
    }

    /**
     * Redirect ke kasir dengan pre-fill data dari booking
     */
    public function toKasir($id)
    {
        $booking = Booking::findOrFail($id);
        return redirect()->route('kasir', ['booking_id' => $booking->id]);
    }
}

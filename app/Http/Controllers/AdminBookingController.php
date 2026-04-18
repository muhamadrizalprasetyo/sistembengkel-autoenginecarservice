<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'diterima' => Booking::where('status', 'Diterima')->count(),
            'selesai' => Booking::where('status', 'Selesai')->count(),
        ];
        return view('admin.bookings', compact('bookings', 'stats'));
    }

    public function accept($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'Diterima']);
        return redirect()->back()->with('success', 'Booking berhasil diterima!');
    }

    public function complete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'Selesai']);
        return redirect()->back()->with('success', 'Booking telah ditandai sebagai selesai!');
    }
}

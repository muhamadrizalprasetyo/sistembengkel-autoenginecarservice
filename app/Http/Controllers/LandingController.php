<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Booking;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('category', 'like', '%' . $request->search . '%');
        }

        $spareparts = $query->where('category', 'sparepart')->orWhere('stock', '>', 0)->get();
        $allSpareparts = Item::where('category', 'sparepart')->get();

        return view('landing_page', compact('spareparts', 'allSpareparts'));
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'car_type' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'booking_date' => 'required|date',
        ]);

        $validated['status'] = 'pending';

        $booking = Booking::create($validated);

        return redirect()->route('booking.success', ['id' => $booking->id]);
    }
}

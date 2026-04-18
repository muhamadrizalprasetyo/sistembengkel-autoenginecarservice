<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Booking;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:saran,pertanyaan,kritik',
            'booking_ref' => 'nullable|string|max:50',
        ]);

        Feedback::create($validated);

        return redirect()->back()->with('feedback_success', 'Pesan Anda telah berhasil dikirim! Terima kasih.');
    }
}

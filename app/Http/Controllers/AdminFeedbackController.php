<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class AdminFeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->get();
        $stats = [
            'total' => Feedback::count(),
            'unread' => Feedback::where('is_read', false)->count(),
            'saran' => Feedback::where('type', 'saran')->count(),
            'pertanyaan' => Feedback::where('type', 'pertanyaan')->count(),
            'kritik' => Feedback::where('type', 'kritik')->count(),
        ];

        // Mark all as read when admin views them
        Feedback::where('is_read', false)->update(['is_read' => true]);

        return view('admin.feedbacks', compact('feedbacks', 'stats'));
    }

    public function destroy($id)
    {
        Feedback::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Feedback berhasil dihapus.');
    }
}

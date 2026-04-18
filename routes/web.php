<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminFeedbackController;

/* |-------------------------------------------------------------------------- | Web Routes - Auto Engine System |-------------------------------------------------------------------------- */

Route::get('/', [DashboardController::class , 'index']);

// Fitur Kasir & Transaksi
Route::get('/kasir', [TransactionController::class , 'index']);
Route::post('/transaksi/simpan', [TransactionController::class , 'store']);
Route::get('/riwayat', [TransactionController::class , 'history']);
Route::get('/transaksi/cetak/{id}', [TransactionController::class , 'cetak']);

// Fitur Manajemen Stok (CRUD Items)
Route::get('/items', [ItemController::class , 'manage']);
Route::post('/items/simpan', [ItemController::class , 'store']);
Route::get('/items/edit/{id}', [ItemController::class , 'edit']);
Route::post('/items/update/{id}', [ItemController::class , 'update']);
Route::get('/items/hapus/{id}', [ItemController::class , 'destroy']);
Route::post('/items/import', [ItemController::class , 'import'])->name('items.import');
Route::post('/items/bulk-delete', [ItemController::class , 'bulkDelete']);

// Katalog Harga
Route::get('/harga', [ItemController::class , 'index']);

// Menu Lainnya (Admin Panel)
Route::get('/reports', [ReportController::class , 'index']);
Route::get('/customers', [CustomerController::class , 'index']);
Route::get('/riwayat-struk', [ReportController::class , 'historyAndReceipt']);
Route::get('/settings', [SettingController::class , 'index']);
Route::post('/settings', [SettingController::class , 'update']);

// =============================================
// PUBLIC: Landing Page & Booking
// =============================================
Route::get('/landing', [LandingController::class , 'index'])->name('landing');
Route::post('/landing/store-booking', [LandingController::class , 'storeBooking'])->name('booking.store');
Route::get('/booking/success/{id}', function ($id) {
    $booking = \App\Models\Booking::findOrFail($id);
    return view('booking_success', compact('booking'));
})->name('booking.success');

// Feedback dari pelanggan
Route::post('/feedback/store', [FeedbackController::class , 'store'])->name('feedback.store');

// Presentasi View (Public)
Route::get('/presentasi', function () {
    return view('presentation_view');
})->name('presentasi');

// =============================================
// ADMIN: Bookings Management
// =============================================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/bookings', [AdminBookingController::class , 'index'])->name('bookings.index');
    Route::post('/bookings/{id}/accept', [AdminBookingController::class , 'accept'])->name('bookings.accept');
    Route::post('/bookings/{id}/complete', [AdminBookingController::class , 'complete'])->name('bookings.complete');

    Route::get('/feedbacks', [AdminFeedbackController::class , 'index'])->name('feedbacks.index');
    Route::delete('/feedbacks/{id}', [AdminFeedbackController::class , 'destroy'])->name('feedbacks.destroy');
});
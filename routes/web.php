<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;

/* |--------------------------------------------------------------------------|
 | PUBLIC ROUTES — Tidak butuh login
 |--------------------------------------------------------------------------- */

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Landing Page publik
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/landing/store-booking', [LandingController::class, 'storeBooking'])->name('booking.store');
Route::get('/booking/success/{id}', function ($id) {
    $booking = \App\Models\Booking::findOrFail($id);
    return view('booking_success', compact('booking'));
})->name('booking.success');

// Public: cek status booking (service tracker)
Route::get('/cek-booking', function () {
    $booking = null;
    if (request()->filled('kode')) {
        $booking = \App\Models\Booking::where('id', request('kode'))->first();
    }
    return view('booking_tracker', compact('booking'));
})->name('booking.tracker');

// Feedback dari pelanggan
Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');

// Presentasi
Route::get('/presentasi', fn() => view('presentation_view'))->name('presentasi');


/* |--------------------------------------------------------------------------|
 | PROTECTED ROUTES — Butuh login
 |--------------------------------------------------------------------------- */
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ── KASIR — semua role bisa akses
    Route::get('/kasir', [TransactionController::class, 'index'])->name('kasir');
    Route::post('/transaksi/simpan', [TransactionController::class, 'store'])->name('transaksi.simpan');
    Route::get('/riwayat', [TransactionController::class, 'history'])->name('riwayat');
    Route::get('/transaksi/cetak/{id}', [TransactionController::class, 'cetak'])->name('transaksi.cetak');

    // ── MANAJEMEN STOK — admin & superadmin
    Route::middleware(['role:superadmin,admin'])->group(function () {
        Route::get('/items', [ItemController::class, 'manage'])->name('items.index');
        Route::post('/items/simpan', [ItemController::class, 'store'])->name('items.store');
        Route::get('/items/edit/{id}', [ItemController::class, 'edit'])->name('items.edit');
        Route::post('/items/update/{id}', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
        Route::post('/items/import', [ItemController::class, 'import'])->name('items.import');
        Route::post('/items/bulk-delete', [ItemController::class, 'bulkDelete'])->name('items.bulk-delete');

        // Expense Management
        Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
        Route::post('/expenses/simpan', [ExpenseController::class, 'store'])->name('expenses.store');
        Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
    });

    // Katalog harga (semua bisa lihat)
    Route::get('/harga', [ItemController::class, 'index'])->name('harga');

    // ── LAPORAN & ANALITIK — admin & superadmin
    Route::middleware(['role:superadmin,admin'])->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export-excel', [ReportController::class, 'exportExcel'])->name('reports.export-excel');
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/riwayat-struk', [ReportController::class, 'historyAndReceipt'])->name('riwayat-struk');
    });

    // ── SETTINGS — superadmin only
    Route::middleware(['role:superadmin'])->group(function () {
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // ── ADMIN: BOOKINGS — admin & superadmin
    Route::prefix('admin')->name('admin.')->middleware(['role:superadmin,admin'])->group(function () {
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::post('/bookings/{id}/accept', [AdminBookingController::class, 'accept'])->name('bookings.accept');
        Route::post('/bookings/{id}/complete', [AdminBookingController::class, 'complete'])->name('bookings.complete');
        Route::delete('/bookings/{id}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');
        Route::get('/bookings/{id}/kasir', [AdminBookingController::class, 'toKasir'])->name('bookings.to-kasir');

        // Feedbacks
        Route::get('/feedbacks', [AdminFeedbackController::class, 'index'])->name('feedbacks.index');
        Route::delete('/feedbacks/{id}', [AdminFeedbackController::class, 'destroy'])->name('feedbacks.destroy');
    });
});
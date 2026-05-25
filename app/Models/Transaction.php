<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'booking_id',
        'vehicle_id',
        'customer_name',
        'customer_phone',
        'car_image',
        'total_price',
        'payment_method',
        'amount_paid',
        'change_amount',
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Generate next invoice number: INV-YYYY-NNNN
     */
    public static function generateInvoiceNumber(): string
    {
        $year = now()->year;
        $last = static::whereYear('created_at', $year)
            ->whereNotNull('invoice_number')
            ->orderByDesc('id')
            ->first();

        $seq = 1;
        if ($last && preg_match('/INV-\d{4}-(\d+)/', $last->invoice_number, $m)) {
            $seq = (int) $m[1] + 1;
        }

        return 'INV-' . $year . '-' . str_pad($seq, 4, '0', STR_PAD_LEFT);
    }
}
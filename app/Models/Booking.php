<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'customer_name',
        'phone',
        'car_type',
        'car_plate',
        'notes',
        'service_type',
        'booking_date',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    // Status helpers
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
    public function isDiterima(): bool
    {
        return $this->status === 'diterima';
    }
    public function isSelesai(): bool
    {
        return $this->status === 'selesai';
    }

    // Relation to transaction
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}

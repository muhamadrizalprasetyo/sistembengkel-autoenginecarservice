<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name', 
        'customer_phone', 
        'car_image', 
        'total_price'
    ];

    // INI YANG KURANG: Hubungin ke tabel detail
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
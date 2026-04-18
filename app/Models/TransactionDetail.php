<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    // Tambahin baris ini juga
    protected $fillable = ['transaction_id', 'item_id', 'item_name', 'qty', 'subtotal'];
}


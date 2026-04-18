<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Tambahin baris ini buat ngizinin input data barang
    protected $fillable = ['name', 'category', 'price', 'stock'];
}
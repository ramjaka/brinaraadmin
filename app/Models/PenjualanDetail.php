<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenjualanDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'penjualan_id',
        'product_id',
        'sell_price',
        'quantity',
        'amount',
        'discount',
        'subtotal',
        'deleted_at',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'merk',
        'category_id',
        'stock',
        'buy_price',
        'sell_price',
        'discount',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $latest = 0;
            $checkProduct = $model->orderby('id', 'DESC')->first();

            if ($checkProduct) {
                $latest = $checkProduct->id;
            }

            $model->setAttribute('code', ('P000' . ($latest + 1)));
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

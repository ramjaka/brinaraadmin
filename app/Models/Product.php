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
            $model->setAttribute('code', ('P000'.$model->orderby('id', 'DESC')->first()->id ?? 0) + 1);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'phone',
        'address',
        'deleted_at',
    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute('code', 'M000' . (($model->orderby('id', 'DESC')->first()->id ?? 0) + 1));
        });
    }
}

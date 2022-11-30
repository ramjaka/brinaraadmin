<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_phone',
        'company_address',
        'company_logo',
        'company_member_card',
        'company_discount',
    ];

    public function hasMemberCardImage()
    {
        return ! blank($this->company_member_card);
    }

    public function hasLogoImage()
    {
        return ! blank($this->company_logo);
    }

    public function getMemberCardImage()
    {
        return Storage::disk('public')->url($this->path() . '/' . $this->company_member_card);
    }

    public function getLogoImage()
    {
        return Storage::disk('public')->url($this->path() . '/' . $this->company_logo);
    }

    public function path()
    {
        return 'company';
    }
}

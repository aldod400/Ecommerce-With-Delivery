<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'expiry_date',
    ];

    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }
}

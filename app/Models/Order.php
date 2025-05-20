<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\UserType;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'deliveryman_id',
        'status',
        'payment_method',
        'payment_status',
        'address',
        'latitude',
        'longitude',
        'total',
        'notes',
        'city_id',
        'area_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deliveryman()
    {
        return $this->belongsTo(User::class)->where('user_type', UserType::DELIVERYMAN);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details', 'order_id', 'product_id')
            ->withPivot('quantity', 'price', 'product_id');
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}

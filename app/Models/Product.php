<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'slug',
        'description',
        'price',
        'discount_price',
        'quantity',
        'status',
        'brand_id',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function attribute()
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute_values')
            ->withPivot('id', 'attribute_value_id', 'product_id');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}

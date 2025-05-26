<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use App\Repository\Contracts\ProductRepositoryInterface;
use App\Enums\ProductStatus;

class ProductRepository implements ProductRepositoryInterface
{
    public function find($id)
    {
        return Product::where('status', ProductStatus::ACTIVE)->findOrFail($id);
    }
    public function paginate(int $perPage, array $columns)
    {
        return Product::where('status', ProductStatus::ACTIVE)->paginate($perPage, $columns);
    }
    public function latest(int $take)
    {
        return Product::with(['images' => function ($query) {
            $query->take(1);
        }])
            ->where('status', ProductStatus::ACTIVE->value)
            ->latest()
            ->take($take)
            ->select(
                'id',
                app()->getLocale() === 'ar' ? 'name_ar as name' : 'name_en as name',
                'description',
                'price',
                'discount_price',
                'quantity',
                'category_id',
                'brand_id'
            )
            ->get();
    }
}

<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use App\Repository\Contracts\ProductRepositoryInterface;
use App\Enums\ProductStatus;

class ProductRepository implements ProductRepositoryInterface
{
    public function find($id)
    {
        return Product::with(['images', 'productAttributes'])
            ->where('status', ProductStatus::ACTIVE)
            ->select(
                'id',
                app()->getLocale() === 'ar' ? 'name_ar as name' : 'name_en as name',
                'slug',
                'description',
                'price',
                'discount_price',
                'quantity',
                'status',
                'category_id',
                'brand_id'
            )
            ->findOrFail($id);
    }
    public function paginate(?string $search = null, int $perPage)
    {
        return Product::with(['images' => function ($query) {
            $query->take(1);
        }])->latest()
            ->where('status', ProductStatus::ACTIVE->value)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where(
                        app()->getLocale() == 'ar' ? 'name_ar' : 'name_en',
                        'like',
                        "%{$search}%"
                    )
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('price', 'like', "%{$search}%")
                        ->orWhere('discount_price', 'like', "%{$search}%")
                        ->orWhere('quantity', 'like', "%{$search}%")
                        ->orWhereRelation(
                            'brand',
                            app()->getLocale() == 'ar' ? 'name_ar' : 'name_en',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhereRelation(
                            'category',
                            app()->getLocale() == 'ar' ? 'name_ar' : 'name_en',
                            'like',
                            "%{$search}%"
                        );
                });
            })->select(
                'id',
                app()->getLocale() === 'ar' ? 'name_ar as name' : 'name_en as name',
                'slug',
                'description',
                'price',
                'discount_price',
                'quantity',
                'status',
                'category_id',
                'brand_id'
            )
            ->paginate($perPage);
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
                'slug',
                'description',
                'price',
                'discount_price',
                'quantity',
                'status',
                'category_id',
                'brand_id'
            )
            ->get();
    }
    public function getProductsByCategoryId(int $categoryId, int $perPage)
    {
        return Product::where('status', ProductStatus::ACTIVE->value)
            ->where('category_id', $categoryId)
            ->select(
                'id',
                app()->getLocale() === 'ar' ? 'name_ar as name' : 'name_en as name',
                'slug',
                'description',
                'price',
                'discount_price',
                'quantity',
                'status',
                'category_id',
                'brand_id'
            )
            ->paginate($perPage);
    }
    public function getProductsByCategoryIds(array $categoryIds, int $perPage)
    {
        return Product::with(['images' => function ($query) {
            $query->take(1);
        }])->where('status', ProductStatus::ACTIVE->value)
            ->whereIn('category_id', $categoryIds)
            ->latest()
            ->select(
                'id',
                app()->getLocale() === 'ar' ? 'name_ar as name' : 'name_en as name',
                'slug',
                'description',
                'price',
                'discount_price',
                'quantity',
                'status',
                'category_id',
                'brand_id'
            )
            ->paginate($perPage);
    }
}

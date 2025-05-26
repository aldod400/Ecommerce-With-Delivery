<?php

namespace App\Services\Implementations;

use App\Repository\Contracts\ProductRepositoryInterface;
use App\Services\Contracts\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    protected $productRepo;
    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    public function getProductById(int $id)
    {
        return $this->productRepo->find($id);
    }
    public function getProducts(int $perPage, array $columns)
    {
        return $this->productRepo->paginate($perPage, $columns);
    }
    public function getLatestProducts(int $take)
    {
        $products = $this->productRepo->latest($take);

        $products->map(function ($product) {
            $product->image = optional($product->images->first())->image;
            unset($product->images);
            return $product;
        });
        return $products;
    }
}

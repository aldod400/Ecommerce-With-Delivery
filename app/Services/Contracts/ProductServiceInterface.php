<?php

namespace App\Services\Contracts;

interface ProductServiceInterface
{
    public function getProductById(int $id);
    public function getProducts(int $perPage, array $columns);
    public function getLatestProducts(int $take);
}

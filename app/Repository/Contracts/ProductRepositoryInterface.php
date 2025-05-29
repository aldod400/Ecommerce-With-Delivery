<?php

namespace App\Repository\Contracts;

interface ProductRepositoryInterface
{
    public function find(int $id);
    public function paginate(int $perPage, array $columns);
    public function latest(int $take);
    public function getProductsByCategoryId(int $categoryId, int $perPage);
    public function getProductsByCategoryIds(array $ids, int $perPage);
}

<?php

namespace App\Repository\Contracts;

interface ProductRepositoryInterface
{
    public function find(int $id);
    public function paginate(int $perPage, array $columns);
    public function latest(int $take);
}

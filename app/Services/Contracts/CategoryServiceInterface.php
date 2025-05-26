<?php

namespace App\Services\Contracts;

interface CategoryServiceInterface
{
    public function getCategories(int $perPage, array $columns);
    public function getCategoryById(string $id);
    public function getPopularCategory(int $limit = 20);
}

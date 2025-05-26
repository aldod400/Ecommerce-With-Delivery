<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Repository\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function find(int $id)
    {
        return Category::with(['parent'])->findOrFail($id);
    }
    public function paginate(int $perPage, array $columns)
    {
        return Category::with(['parent'])->paginate($perPage, $columns);
    }
    public function popular(int $limit = 20)
    {
        return Category::where('popular', true)
            ->latest()
            ->take($limit)
            ->select('id', app()->getLocale() == 'ar' ? 'name_ar as name' : 'name_en as name', 'image')
            ->get();
    }

    public function getNonPopularExcluding(array $excludeIds, int $limit)
    {
        return Category::where('popular', false)
            ->whereNotIn('id', $excludeIds)
            ->latest()
            ->take($limit)
            ->select('id', app()->getLocale() == 'ar' ? 'name_ar as name' : 'name_en as name', 'image')
            ->get();
    }
}

<?php

namespace App\Services;

use App\Models\Category;

class CategoryPersister
{
    public function create(string $categoryName): Category
    {
        $category = new Category();
        $category->name = $categoryName;

        $category->save();

        return $category;
    }
}
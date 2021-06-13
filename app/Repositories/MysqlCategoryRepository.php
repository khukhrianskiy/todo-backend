<?php

namespace App\Repositories;

use App\Models\Category;

class MysqlCategoryRepository implements CategoryRepositoryInterface
{
    public function findByName(string $name): ?Category
    {
        return Category::where(['name' => $name])->first();
    }
}

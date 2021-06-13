<?php

namespace App\Repositories;

use App\Models\TodoItem;
use Illuminate\Database\Eloquent\Collection;

class MysqlTodoItemRepository implements TodoItemRepositoryInterface
{
    public function findAll(): Collection
    {
        return TodoItem::with(['categories', 'hashtags'])->get();
    }

    public function find(int $id): ?TodoItem
    {
        return TodoItem::find($id);
    }
}

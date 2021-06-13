<?php

namespace App\Repositories;

use App\Models\TodoItem;
use Illuminate\Database\Eloquent\Collection;

interface TodoItemRepositoryInterface
{
    public function findAll(): Collection;

    public function find(int $id): ?TodoItem;
}
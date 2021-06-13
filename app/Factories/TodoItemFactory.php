<?php

namespace App\Factories;

use App\Dto\TodoItemDto;
use App\Models\TodoItem;

class TodoItemFactory
{
    public function fromDto(TodoItemDto $todoItemDto): TodoItem
    {
        $todoItem = new TodoItem();
        $todoItem->text = $todoItemDto->getText();
        $todoItem->end_date = $todoItemDto->getEndDate();

        return $todoItem;
    }
}
<?php

namespace App\Http\Requests;

use App\Dto\TodoItemDto;
use App\Models\TodoItem;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class TodoItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['text' => "string", 'categories' => "string", 'hashtags' => "string", 'endDate' => "string"])]
    public function rules(): array
    {
        return [
            'text' => 'required|string',
            'categories' => 'required|array',
            'hashtags' => 'required|array',
            'endDate' => 'nullable',
        ];
    }

    public function getDto(): TodoItemDto
    {
        return new TodoItemDto(
            $this->request->get('text'),
            (array)$this->request->get('categories', []),
            (array)$this->request->get('hashtags', []),
            \DateTime::createFromFormat(TodoItem::END_DATE_FORMAT, $this->request->get('endDate'))
                ?: null
        );
    }
}

<?php

namespace App\Dto;

use DateTime;

class TodoItemDto
{
    private string $text;

    private array $categories;

    private array $hashtags;

    private ?DateTime $endDate;

    public function __construct(string $text, array $categories, array $hashtags, ?DateTime $endDate)
    {
        $this->text = $text;
        $this->categories = $categories;
        $this->hashtags = $hashtags;
        $this->endDate = $endDate;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getHashtags(): array
    {
        return $this->hashtags;
    }

    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }
}

<?php

namespace App\Services;

use App\Dto\TodoItemDto;
use App\Factories\TodoItemFactory;
use App\Models\TodoItem;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\HashtagRepositoryInterface;
use App\Repositories\TodoItemRepositoryInterface;

class TodoItemPersister
{
    private TodoItemFactory $todoItemFactory;
    private TodoItemRepositoryInterface $todoItemRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private HashtagRepositoryInterface $hashtagRepository;
    private CategoryPersister $categoryPersister;
    private HashtagPersister $hashtagPersister;

    public function __construct(
        TodoItemFactory $todoItemFactory,
        TodoItemRepositoryInterface $todoItemRepository,
        CategoryRepositoryInterface $categoryRepository,
        HashtagRepositoryInterface $hashtagRepository,
        CategoryPersister $categoryPersister,
        HashtagPersister $hashtagPersister
    ) {
        $this->todoItemFactory = $todoItemFactory;
        $this->todoItemRepository = $todoItemRepository;
        $this->categoryRepository = $categoryRepository;
        $this->hashtagRepository = $hashtagRepository;
        $this->categoryPersister = $categoryPersister;
        $this->hashtagPersister = $hashtagPersister;
    }

    public function saveFromDto(TodoItemDto $todoItemDto): void
    {
        $todoItem = $this->todoItemFactory->fromDto($todoItemDto);

        $todoItem->save();

        $todoItem = $this->addCategories($todoItem, $todoItemDto->getCategories());
        $todoItem = $this->addHashtags($todoItem, $todoItemDto->getHashtags());

        $todoItem->save();
    }

    public function updateFromDto(int $id, TodoItemDto $todoItemDto): TodoItem
    {
        $todoItem = $this->todoItemRepository->find($id);

        $todoItem->categories()->detach();
        $todoItem->hashtags()->detach();

        $todoItem = $this->addCategories($todoItem, $todoItemDto->getCategories());
        $todoItem = $this->addHashtags($todoItem, $todoItemDto->getHashtags());

        $todoItem->save();

        return $todoItem;
    }

    public function remove(int $id): void
    {
        $todoItem = $this->todoItemRepository->find($id);

        $todoItem->delete();
    }

    /**
     * @param string[] $categories
     */
    private function addCategories(TodoItem $todoItem, array $categories): TodoItem
    {
        foreach ($categories as $categoryName) {
            $category = $this->categoryRepository->findByName($categoryName)
                ?: $this->categoryPersister->create($categoryName);

            $todoItem->categories()->save($category);
        }

        return $todoItem;
    }

    /**
     * @param string[] $hashtags
     */
    private function addHashtags(TodoItem $todoItem, array $hashtags): TodoItem
    {
        foreach ($hashtags as $hashtagName) {
            $hashtag = $this->hashtagRepository->findByName($hashtagName)
                ?: $this->hashtagPersister->create($hashtagName);

            $todoItem->hashtags()->save($hashtag);
        }

        return $todoItem;
    }
}
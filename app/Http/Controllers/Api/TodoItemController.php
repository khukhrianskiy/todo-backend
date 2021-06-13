<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoItemRequest;
use App\Models\TodoItem;
use App\Repositories\TodoItemRepositoryInterface;
use App\Services\TodoItemPersister;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TodoItemController extends Controller
{
    private TodoItemRepositoryInterface $todoItemRepository;
    private TodoItemPersister $todoItemPersister;

    public function __construct(
        TodoItemRepositoryInterface $todoItemRepository,
        TodoItemPersister $todoItemPersister
    ) {
        $this->todoItemRepository = $todoItemRepository;
        $this->todoItemPersister = $todoItemPersister;
    }

    public function index(): Collection
    {
        return $this->todoItemRepository->findAll();
    }

    public function store(TodoItemRequest $request): Response
    {
        $todoItemDto = $request->getDto();
        $this->todoItemPersister->saveFromDto($todoItemDto);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    public function show(int $id): ?TodoItem
    {
        return $this->todoItemRepository->find($id);
    }

    public function update(TodoItemRequest $request, int $id): Response
    {
        $todoItemDto = $request->getDto();
        $todoItem = $this->todoItemPersister->updateFromDto($id, $todoItemDto);

        return new JsonResponse($todoItem, Response::HTTP_CREATED);
    }

    public function destroy(int $id): Response
    {
        $this->todoItemPersister->remove($id);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}

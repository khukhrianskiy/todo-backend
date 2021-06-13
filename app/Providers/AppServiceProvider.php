<?php

namespace App\Providers;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\HashtagRepositoryInterface;
use App\Repositories\MysqlCategoryRepository;
use App\Repositories\MysqlHashtagRepository;
use App\Repositories\MysqlTodoItemRepository;
use App\Repositories\TodoItemRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        TodoItemRepositoryInterface::class => MysqlTodoItemRepository::class,
        CategoryRepositoryInterface::class => MysqlCategoryRepository::class,
        HashtagRepositoryInterface::class => MysqlHashtagRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

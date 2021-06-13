<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoItemCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_item_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('todo_item_id');
            $table->unsignedBigInteger('category_id');
            $table->unique(['todo_item_id', 'category_id']);
            $table->foreign('todo_item_id')
                ->references('id')
                ->on('todo_items')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todo_item_categories', function (Blueprint $table) {
            $table->dropForeign(['todo_item_id', 'category_id']);
        });

        Schema::dropIfExists('todo_item_categories');
    }
}

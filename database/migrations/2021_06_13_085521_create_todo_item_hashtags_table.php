<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoItemHashtagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_item_hashtags', function (Blueprint $table) {
            $table->unsignedBigInteger('todo_item_id');
            $table->unsignedBigInteger('hashtag_id');
            $table->unique(['todo_item_id', 'hashtag_id']);
            $table->foreign('todo_item_id')
                ->references('id')
                ->on('todo_items')
                ->onDelete('cascade');
            $table->foreign('hashtag_id')
                ->references('id')
                ->on('hashtags')
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
        Schema::table('todo_item_hashtags', function (Blueprint $table) {
            $table->dropForeign(['todo_item_id', 'hashtag_id']);
        });

        Schema::dropIfExists('todo_item_hashtags');
    }
}

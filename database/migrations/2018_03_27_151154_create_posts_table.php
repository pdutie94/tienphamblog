<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->integer('author_id')->unsigned();
            $table->integer('cat_id')->unsigned();
            $table->text('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->tinyInteger('state')->default(1)->comment("0 - Unpublish | 1 - Published");
            $table->integer('hit')->default(0);
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

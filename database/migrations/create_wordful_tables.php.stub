<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordfulTables extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('html');
            $table->string('status', 50)->default('draft');
            $table->string('type', 50)->default('post');
            $table->dateTime('published_at')->nullable();
            $table->bigInteger('author_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->timestamps();

            $table->index('created_at');
        });

        Schema::create('posts_tags', function (Blueprint $table) {
            $table->bigInteger('post_id');
            $table->bigInteger('tag_id');

            $table->unique(['post_id', 'tag_id']);
        });
    }
}

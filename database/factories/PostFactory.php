<?php

namespace Radiocubito\Wordful\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Wordful;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'html' => $this->faker->paragraph(),
            'status' => 'draft',
            'type' => 'post',
            'author_id' => Wordful::userModel()::factory(),
            'meta' => [],
        ];
    }

    public function published()
    {
        return $this->state(function () {
            return [
                'status' => 'published',
                'published_at' => now(),
            ];
        });
    }

    public function draft()
    {
        return $this->state(function () {
            return [
                'status' => 'draft',
            ];
        });
    }

    public function page()
    {
        return $this->state(function () {
            return [
                'type' => 'page',
            ];
        });
    }

    public function post()
    {
        return $this->state(function () {
            return [
                'type' => 'post',
            ];
        });
    }
}

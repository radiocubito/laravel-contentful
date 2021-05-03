<?php

namespace Radiocubito\Wordful\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Radiocubito\Wordful\Models\Tag;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'meta' => [],
        ];
    }
}

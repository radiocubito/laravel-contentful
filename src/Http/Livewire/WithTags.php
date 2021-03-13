<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Illuminate\Support\Str;
use Radiocubito\Wordful\Models\Tag;

trait WithTags
{
    public $incomingTags = [];

    private function collectTags()
    {
        $allTags = Tag::all();

        return collect($this->incomingTags)->map(function ($incomingTag) use ($allTags) {
            $tag = $allTags->where('slug', Str::slug($incomingTag))->first();

            if (! $tag) {
                $tag = Tag::create([
                    'name' => $incomingTag,
                    'slug' => Str::slug($incomingTag),
                ]);
            }

            return $tag->id;
        })->toArray();
    }
}

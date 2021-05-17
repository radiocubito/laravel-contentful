<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Radiocubito\Wordful\Models\Post;

class ShowPosts extends Component
{
    public function render()
    {
        return view('wordful::livewire.show-posts', [
            'publishedPosts' => Post::published()->ofType('post')->orderBy('created_at', 'desc')->get(),
            'draftPosts' => Post::draft()->ofType('post')->orderBy('created_at', 'desc')->get(),
        ])->layout('wordful::layouts.dev-wordful');
    }
}

<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Models\Post;

class ShowPosts extends Component
{
    public function render()
    {
        return view('wordful::livewire.show-posts', [
            'posts' => Post::published()->ofType('post')->orderBy('created_at', 'desc')->get(),
            'draftCount' => Post::draft()->ofType('post')->count(),
            'firstDraft' => Post::draft()->ofType('post')->first(),
        ])->layout('wordful::layouts.wordful');
    }
}

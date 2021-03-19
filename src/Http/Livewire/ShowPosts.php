<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Radiocubito\Wordful\Models\Post;

class ShowPosts extends Component
{
    use WithPagination;

    public function render()
    {
        return view('wordful::livewire.show-posts', [
            'posts' => Post::published()->ofType('post')->orderBy('created_at', 'desc')->simplePaginate(10),
            'draftCount' => Post::draft()->ofType('post')->count(),
            'firstDraft' => Post::draft()->ofType('post')->first(),
        ])->layout('wordful::layouts.wordful');
    }
}

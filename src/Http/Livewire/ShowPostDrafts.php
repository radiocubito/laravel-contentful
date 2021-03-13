<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Models\Post;

class ShowPostDrafts extends Component
{
    public function render()
    {
        return view('wordful::livewire.show-post-drafts', [
            'posts' => Post::draft()->ofType('post')->orderBy('created_at', 'desc')->get(),
        ])->layout('wordful::layouts.wordful');
    }
}

<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Models\Post;

class ShowPageDrafts extends Component
{
    public function render()
    {
        return view('wordful::livewire.show-page-drafts', [
            'posts' => Post::draft()->ofType('page')->orderBy('created_at', 'desc')->get(),
        ])->layout('wordful::layouts.wordful');
    }
}

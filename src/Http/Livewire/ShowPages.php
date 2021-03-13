<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Models\Post;

class ShowPages extends Component
{
    public function render()
    {
        return view('wordful::livewire.show-pages', [
            'posts' => Post::published()->ofType('page')->orderBy('created_at', 'desc')->get(),
            'draftCount' => Post::draft()->ofType('page')->count(),
            'firstDraft' => Post::draft()->ofType('page')->first(),
        ])->layout('wordful::layouts.wordful');
    }
}

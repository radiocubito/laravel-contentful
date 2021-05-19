<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Radiocubito\Wordful\Models\Post;

class ShowPages extends Component
{
    public function render()
    {
        return view('wordful::livewire.show-pages', [
            'publishedPages' => Post::published()->ofType('page')->orderBy('created_at', 'desc')->get(),
            'draftPages' => Post::draft()->ofType('page')->orderBy('created_at', 'desc')->get(),
        ])->layout('wordful::layouts.html');
    }
}

<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Radiocubito\Wordful\Models\Post;

class ShowPages extends Component
{
    use WithPagination;

    public function render()
    {
        return view('wordful::livewire.show-pages', [
            'posts' => Post::published()->ofType('page')->orderBy('created_at', 'desc')->simplePaginate(10),
            'draftCount' => Post::draft()->ofType('page')->count(),
            'firstDraft' => Post::draft()->ofType('page')->first(),
        ])->layout('wordful::layouts.wordful');
    }
}

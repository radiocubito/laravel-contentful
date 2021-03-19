<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Radiocubito\Wordful\Models\Post;

class ShowPageDrafts extends Component
{
    use WithPagination;

    public function render()
    {
        return view('wordful::livewire.show-page-drafts', [
            'posts' => Post::draft()->ofType('page')->orderBy('created_at', 'desc')->simplePaginate(10),
        ])->layout('wordful::layouts.wordful');
    }
}

<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Contentful\Models\Post;

class ShowPages extends Component
{
    public function render()
    {
        return view('contentful::livewire.show-pages', [
            'posts' => Post::published()->ofType('page')->orderBy('created_at', 'desc')->get(),
            'draftCount' => Post::draft()->ofType('page')->count(),
            'firstDraft' => Post::draft()->ofType('page')->first(),
        ])->layout('contentful::layouts.contentful');
    }
}

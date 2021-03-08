<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Contentful\Models\Post;

class ShowPageDrafts extends Component
{
    public function render()
    {
        return view('contentful::livewire.show-page-drafts', [
            'posts' => Post::draft()->ofType('page')->orderBy('created_at', 'desc')->get(),
        ])->layout('contentful::layouts.contentful');
    }
}

<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Contentful\Models\Post;

class ShowPostDrafts extends Component
{
    public function render()
    {
        return view('contentful::livewire.show-post-drafts', [
            'posts' => Post::draft()->orderBy('created_at', 'desc')->get(),
        ])->layout('contentful::layouts.contentful');
    }
}

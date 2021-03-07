<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Contentful\Models\Post;

class ShowPosts extends Component
{
    public function render()
    {
        return view('contentful::livewire.show-posts', [
            'posts' => Post::published()->orderBy('created_at', 'desc')->get(),
            'draftCount' => Post::draft()->count(),
            'firstDraft' => Post::draft()->first(),
        ])->layout('contentful::layouts.contentful');
    }
}

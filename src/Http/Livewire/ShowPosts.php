<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Contentful\Models\Post;

class ShowPosts extends Component
{
    public function render()
    {
        return view('contentful::livewire.show-posts', [
            'posts' => Post::published()->ofType('post')->orderBy('created_at', 'desc')->get(),
            'draftCount' => Post::draft()->ofType('post')->count(),
            'firstDraft' => Post::draft()->ofType('post')->first(),
        ])->layout('contentful::layouts.contentful');
    }
}

<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Contentful\Models\Post;

class ShowPosts extends Component
{
    public function render()
    {
        return view('contentful::livewire.show-posts', [
            'posts' => Post::all(),
        ])->layout('contentful::layouts.contentful');
    }
}

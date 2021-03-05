<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Contentful\Models\Post;

class ShowPost extends Component
{
    public Post $post;

    public function render()
    {
        return view('contentful::livewire.show-post')->layout('contentful::layouts.contentful');
    }
}

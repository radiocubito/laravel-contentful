<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Contentful\Models\Post;

class ShowPost extends Component
{
    public Post $post;

    public function publish()
    {
        $this->post->markAsPublished();

        redirect()->to(route('contentful.posts.show', $this->post));
    }

    public function delete()
    {
        $this->post->delete();

        redirect()->to(route('contentful.posts.index', $this->post));
    }

    public function render()
    {
        return view('contentful::livewire.show-post')->layout('contentful::layouts.contentful');
    }
}

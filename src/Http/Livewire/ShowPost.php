<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Models\Post;

class ShowPost extends Component
{
    public Post $post;

    public function publish()
    {
        $this->post->markAsPublished();

        redirect()->to(route('wordful.posts.show', $this->post));
    }

    public function delete()
    {
        $this->post->delete();

        redirect()->to(route('wordful.posts.index', $this->post));
    }

    public function render()
    {
        return view('wordful::livewire.show-post')->layout('wordful::layouts.wordful');
    }
}

<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Models\Post;

class ShowPage extends Component
{
    public Post $post;

    public function publish()
    {
        $this->post->markAsPublished();

        redirect()->to(route('wordful.pages.show', $this->post));
    }

    public function render()
    {
        return view('wordful::livewire.show-page')->layout('wordful::layouts.wordful');
    }
}

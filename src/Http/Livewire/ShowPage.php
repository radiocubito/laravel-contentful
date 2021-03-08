<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Contentful\Models\Post;

class ShowPage extends Component
{
    public Post $post;

    public function publish()
    {
        $this->post->markAsPublished();

        redirect()->to(route('contentful.pages.show', $this->post));
    }

    public function render()
    {
        return view('contentful::livewire.show-page')->layout('contentful::layouts.contentful');
    }
}

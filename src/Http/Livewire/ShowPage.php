<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Models\Post;

class ShowPage extends Component
{
    public Post $page;

    public function publish()
    {
        $this->page->markAsPublished();

        redirect()->to(route('wordful.pages.show', $this->page));
    }

    public function delete()
    {
        $this->page->delete();

        redirect()->to(route('wordful.pages.index', $this->page));
    }

    public function render()
    {
        return view('wordful::livewire.show-page')->layout('wordful::layouts.html');
    }
}

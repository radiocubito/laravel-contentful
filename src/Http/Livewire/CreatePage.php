<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Radiocubito\Wordful\Models\Post;

class CreatePage extends Component
{
    use WithFileUploads;
    use WithTrixImages;

    public Post $page;

    protected $rules = [
        'page.title' => ['required', 'string', 'max:255'],
        'page.html' => ['required'],
    ];

    public function save()
    {
        $this->savePage();

        redirect()->to(route('wordful.pages.show', $this->page));
    }

    public function publish()
    {
        $this->savePage();

        $this->page->markAsPublished();

        redirect()->to(route('wordful.pages.show', $this->page));
    }

    protected function savePage()
    {
        $this->validate();

        return $this->page->fill([
            'type' => 'page',
            'author_id' => Auth::user()->id,
        ])->save();
    }

    public function mount()
    {
        $this->page = new Post;
    }

    public function render()
    {
        return view('wordful::livewire.create-page')->layout('wordful::layouts.html');
    }
}

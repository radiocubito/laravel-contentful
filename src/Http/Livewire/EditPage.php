<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Radiocubito\Wordful\Models\Post;

class EditPage extends Component
{
    use WithFileUploads;
    use WithTrixImages;

    public Post $page;

    protected function rules()
    {
        return [
            'page.title' => ['required', 'string', 'max:255'],
            'page.html' => ['required'],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->page->save();

        redirect()->to(route('wordful.pages.show', $this->page));
    }

    public function saveAndPublish()
    {
        $this->validate();

        $this->page->save();

        $this->page->markAsPublished();

        redirect()->to(route('wordful.pages.show', $this->page));
    }

    public function render()
    {
        return view('wordful::livewire.edit-page')->layout('wordful::layouts.html');
    }
}

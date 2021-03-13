<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Radiocubito\Wordful\Models\Post;

class EditPage extends Component
{
    use WithFileUploads;
    use WithTrixImages;

    public Post $post;

    protected function rules()
    {
        return [
            'post.title' => ['required', 'string', 'max:255'],
            'post.slug' => ['required', 'string', 'max:255', 'unique:posts,slug,'.$this->post['id']],
            'post.html' => ['required'],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->post->save();

        redirect()->to(route('wordful.pages.show', $this->post));
    }

    public function saveAndPublish()
    {
        $this->validate();

        $this->post->save();

        $this->post->markAsPublished();

        redirect()->to(route('wordful.pages.show', $this->post));
    }

    public function render()
    {
        return view('wordful::livewire.edit-page')->layout('wordful::layouts.wordful');
    }
}

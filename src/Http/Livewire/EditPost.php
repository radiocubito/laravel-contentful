<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Radiocubito\Wordful\Models\Post;

class EditPost extends Component
{
    use WithFileUploads;
    use WithTrixImages;
    use WithTags;

    public Post $post;

    protected function rules()
    {
        return [
            'post.title' => ['required', 'string', 'max:255'],
            'post.html' => ['required'],
        ];
    }

    public function save()
    {
        $this->savePost();

        redirect()->to(route('wordful.posts.show', $this->post));
    }

    public function saveAndPublish()
    {
        $this->savePost();

        $this->post->markAsPublished();

        redirect()->to(route('wordful.posts.show', $this->post));
    }

    protected function savePost()
    {
        $this->validate();

        $this->post->save();
    }

    public function mount()
    {
        $this->incomingTags = $this->post->tags->pluck('name')->toArray();
    }

    public function render()
    {
        return view('wordful::livewire.edit-post')->layout('wordful::layouts.html');
    }
}

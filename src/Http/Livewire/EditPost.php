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
            'post.slug' => ['required', 'string', 'max:255', 'unique:posts,slug,'.$this->post['id']],
            'post.html' => ['required'],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->savePost();

        redirect()->to(route('wordful.posts.show', $this->post));
    }

    public function saveAndPublish()
    {
        $this->validate();

        $this->savePost();

        $this->post->markAsPublished();

        redirect()->to(route('wordful.posts.show', $this->post));
    }

    protected function savePost()
    {
        $this->validate();

        $this->post->save();

        $this->post->tags()->sync(
            $this->collectTags()
        );
    }

    public function mount()
    {
        $this->incomingTags = $this->post->tags->pluck('name')->toArray();
    }

    public function render()
    {
        return view('wordful::livewire.edit-post')->layout('wordful::layouts.wordful');
    }
}

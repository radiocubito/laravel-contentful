<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Radiocubito\Wordful\Models\Post;

class CreatePost extends Component
{
    use WithFileUploads;
    use WithTrixImages;
    use WithTags;

    public Post $post;

    protected $rules = [
        'post.title' => ['required', 'string', 'max:255'],
        'post.slug' => ['required', 'string', 'max:255', 'unique:posts,slug'],
        'post.html' => ['required'],
    ];

    public function save()
    {
        $this->savePost();

        redirect()->to(route('wordful.posts.show', $this->post));
    }

    public function publish()
    {
        $this->savePost();

        $this->post->markAsPublished();

        redirect()->to(route('wordful.posts.show', $this->post));
    }

    protected function savePost()
    {
        $this->validate();

        $this->post->fill(['author_id' => Auth::user()->id])->save();

        $this->post->tags()->sync(
            $this->collectTags()
        );
    }

    public function mount()
    {
        $this->post = new Post;
    }

    public function render()
    {
        return view('wordful::livewire.create-post')->layout('wordful::layouts.wordful');
    }
}

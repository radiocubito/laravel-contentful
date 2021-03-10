<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Radiocubito\Contentful\Models\Post;

class CreatePage extends Component
{
    use WithFileUploads;
    use WithTrixImages;

    public Post $post;

    protected $rules = [
        'post.title' => ['required', 'string', 'max:255'],
        'post.slug' => ['required', 'string', 'max:255', 'unique:posts,slug'],
        'post.html' => ['required'],
    ];

    public function save()
    {
        $this->savePost();

        redirect()->to(route('contentful.pages.show', $this->post));
    }

    public function publish()
    {
        $this->savePost();

        $this->post->markAsPublished();

        redirect()->to(route('contentful.pages.show', $this->post));
    }

    protected function savePost()
    {
        $this->validate();

        return $this->post->fill([
            'type' => 'page',
            'author_id' => Auth::user()->id,
        ])->save();
    }

    public function mount()
    {
        $this->post = new Post;
    }

    public function render()
    {
        return view('contentful::livewire.create-page')->layout('contentful::layouts.contentful');
    }
}

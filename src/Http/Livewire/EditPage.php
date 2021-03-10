<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Radiocubito\Contentful\Models\Post;

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

        redirect()->to(route('contentful.pages.show', $this->post));
    }

    public function saveAndPublish()
    {
        $this->validate();

        $this->post->save();

        $this->post->markAsPublished();

        redirect()->to(route('contentful.pages.show', $this->post));
    }

    public function render()
    {
        return view('contentful::livewire.edit-page')->layout('contentful::layouts.contentful');
    }
}

<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Radiocubito\Contentful\Models\Post;

class CreatePage extends Component
{
    use WithFileUploads;

    public Post $post;
    public $newFiles = [];

    protected $rules = [
        'post.title' => ['required', 'string', 'max:255'],
        'post.slug' => ['required', 'string', 'max:255', 'unique:posts,slug'],
        'post.html' => ['required'],
    ];

    public function save()
    {
        $this->validate();

        $this->post->fill(['type' => 'page'])->save();

        redirect()->to(route('contentful.pages.show', $this->post));
    }

    public function publish()
    {
        $this->validate();

        $this->post->fill(['type' => 'page'])->save();

        $this->post->markAsPublished();

        redirect()->to(route('contentful.pages.show', $this->post));
    }

    public function completeUpload($uploadedUrl, $eventName)
    {
        foreach ($this->newFiles as $image) {
            if ($image->getFilename() === $uploadedUrl) {
                $imagePath = $this->post->storeImage($image);
                $url = $this->post->getImageUrlAttribute($imagePath);

                $this->dispatchBrowserEvent($eventName, ['url' => $url, 'href' => $url]);

                return;
            }
        }
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

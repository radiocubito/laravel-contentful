<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Radiocubito\Contentful\Models\Post;

class EditPost extends Component
{
    use WithFileUploads;

    public Post $post;
    public $newFiles = [];

    protected $rules = [
        'post.title' => '',
        'post.slug' => '',
        'post.html' => '',
    ];

    public function save()
    {
        $this->validate();

        $this->post->save();

        redirect()->to(route('contentful.posts.show', $this->post));
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

    public function render()
    {
        return view('contentful::livewire.edit-post')->layout('contentful::layouts.contentful');
    }
}

<?php

namespace Radiocubito\Contentful\Http\Livewire;

use Illuminate\Support\Facades\Storage;
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
        foreach ($this->newFiles as $file) {
            if ($file->getFilename() === $uploadedUrl) {
                $newFilename = $file->store('/', 'post-attachments');
                $url = Storage::disk('post-attachments')->url($newFilename);

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

<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Radiocubito\Wordful\Mail\PostEmailed;
use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Models\Subscriber;

class EmailPostToSubscribers extends Component
{
    public Post $post;
    public $subscribersCount;

    public function emailPost()
    {
        if (! is_null($this->post->emailed_at)) {
            return redirect()->to(route('wordful.posts.show', $this->post));
        }

        $this->post->update([
            'emailed_at' => $this->post->emailed_at ?? $this->post->freshTimestamp(),
        ]);

        foreach (Subscriber::whereNotNull('confirmed_at')->cursor() as $subscriber) {
            Mail::to($subscriber->email)->queue(new PostEmailed($this->post, $subscriber));
        }

        return redirect()->to(route('wordful.posts.show', $this->post));
    }

    public function mount()
    {
        $this->subscribersCount = Subscriber::whereNotNull('confirmed_at')->count();
    }

    public function render()
    {
        return view('wordful::livewire.email-post-to-subscribers');
    }
}

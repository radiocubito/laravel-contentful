<?php

namespace Radiocubito\Wordful\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Models\Subscriber;

class PostEmailed extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    protected $post;
    protected $subscriber;

    public function __construct(Post $post, Subscriber $subscriber)
    {
        $this->post = $post;
        $this->subscriber = $subscriber;
    }

    public function build()
    {
        return $this->subject($this->post->title)
            ->view('wordful::posts.emailed')
                ->with([
                    'post' => $this->post,
                    'subscriber' => $this->subscriber,
                ])
            ->text('wordful::posts.emailed_plain')
                ->with([
                    'post' => $this->post,
                    'subscriber' => $this->subscriber,
                ]);
    }
}

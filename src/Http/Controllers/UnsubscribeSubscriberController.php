<?php

namespace Radiocubito\Wordful\Http\Controllers;

use Illuminate\View\View;
use Radiocubito\Wordful\Models\Subscriber;

class UnsubscribeSubscriberController
{
    public function index(Subscriber $subscriber): View
    {
        return view('wordful::subscribers.unsubscribe', [
            'subscriber' => $subscriber,
        ]);
    }

    public function store(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('wordful.subscribers.unsubscribed.index');
    }
}

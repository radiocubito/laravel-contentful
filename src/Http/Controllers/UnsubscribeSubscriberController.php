<?php

namespace Radiocubito\Wordful\Http\Controllers;

use Illuminate\Http\Request;
use Radiocubito\Wordful\Models\Subscriber;

class UnsubscribeSubscriberController
{
    public function index(Subscriber $subscriber)
    {
        return view('wordful::subscribers.unsubscribe', [
            'subscriber' => $subscriber,
        ]);
    }

    public function store(Subscriber $subscriber, Request $request)
    {
        $subscriber->delete();

        return redirect()->route('wordful.subscribers.unsubscribed.index');
    }
}

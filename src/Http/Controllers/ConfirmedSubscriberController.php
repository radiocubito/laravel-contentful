<?php

namespace Radiocubito\Wordful\Http\Controllers;

use Illuminate\Http\Request;
use Radiocubito\Wordful\Models\Subscriber;

class ConfirmedSubscriberController
{
    public function index(Subscriber $subscriber)
    {
        return view('wordful::subscribers.confirmed', [
            'subscriber' => $subscriber,
        ]);
    }

    public function store(Subscriber $subscriber, Request $request)
    {
        if (is_null($subscriber->confirmed_at)) {
            $subscriber->forceFill([
                'confirmed_at' => $subscriber->freshTimestamp(),
            ])->save();
        }

        return redirect()->signedRoute('wordful.subscribers.confirmed.index', $subscriber);
    }
}

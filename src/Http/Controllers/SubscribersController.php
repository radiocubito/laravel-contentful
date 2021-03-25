<?php

namespace Radiocubito\Wordful\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Radiocubito\Wordful\Models\Subscriber;
use Radiocubito\Wordful\Notifications\ConfirmSubscription;

class SubscribersController
{
    public function create()
    {
        return view('wordful::subscribers.create');
    }

    public function show(Subscriber $subscriber)
    {
        return view('wordful::subscribers.show', [
            'subscriber' => $subscriber,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $subscriber = Subscriber::where('email', $request->email)
            ->firstOr(function () use ($request) {
                $subscriber = Subscriber::create([
                    'email' => $request->email,
                ]);

                Notification::route('mail', $subscriber->email)
                    ->notify(new ConfirmSubscription($subscriber));

                return $subscriber;
            });

        return redirect()->signedRoute('wordful.subscribers.show', $subscriber);
    }
}

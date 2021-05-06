<?php

namespace Radiocubito\Wordful\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class ConfirmSubscription extends Notification implements ShouldQueue
{
    use Queueable;

    public $subscriber;

    public function __construct($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        $url = URL::signedRoute('wordful.subscribers.confirmed.index', $this->subscriber);
        $siteName = config('app.name');

        return (new MailMessage)
            ->subject(__('Please confirm your subscription to :siteName', ['siteName' => $siteName]))
            ->line(__('You‘re almost subscribed to updates from :siteName', ['siteName' => $siteName]))
            ->line(__('If you want to get notified whenever they decide to send something new, click the button below to confirm.'))
            ->action(__('Confirm my subscription'), $url);
    }
}

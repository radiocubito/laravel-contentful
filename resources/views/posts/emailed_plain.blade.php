{!! strip_tags(str_replace('<br>', "\n", $post->html)) !!}

--

{{ __('You’re subscribed to :siteName', ['siteName' => config('app.name', 'Wordful')]) }}

{{ __('Don’t want these posts anymore? Unsubscribe:') }} {{ \URL::signedRoute('wordful.subscribers.unsubscribe.index', $subscriber) }}

{!! strip_tags(str_replace('<br>', "\n", $post->html)) !!}

--

You’re subscribed to {{ config('app.name', 'Wordful') }}

Don’t want these posts anymore? Unsubscribe: {{ \URL::signedRoute('wordful.subscribers.unsubscribe.index', $subscriber) }}

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" id="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=10.0,initial-scale=1.0" />

        <style>
            html{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}h1{font-size:1.2em;line-height:1.2;margin:0}ul,ol{margin:0;padding:0}ul li,ol li,li li{margin:0 0 0 36px}[dir=rtl] li{margin:0 18px 0 0}blockquote{border-color:#dfdee1;border-style:solid;border-width:0 0 0 1px;margin:0;padding:0 0 0 1em}[dir=rtl] blockquote,blockquote[dir=rtl]{border-width:0 1px 0 0;padding:0 1em 0 0}pre{font-family:"SFMono-Regular", Consolas, "Liberation Mono", Menlo, Courier, monospace;font-size:0.9em;margin:0;padding:1rem;background-color:#f6f5f3;white-space:pre-wrap;word-wrap:break-word;overflow:visible}.message-content{font-family:-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";line-height:1.4}.attachment{display:inline-block;margin:0;padding:0}.attachment__caption{padding:0;text-align:center}.attachment__caption a[href]{text-decoration:none;color:#333333}.attachment--preview{width:100%;text-align:center;margin:0.625em 0}.attachment--preview img{border:1px solid #dfdee1;vertical-align:middle;width:auto;max-width:100%;max-height:640px}.attachment--preview .attachment__caption{color:#716d7b;font-size:0.85em;margin-top:0.625em}.attachment--file{color:#282138;line-height:1;margin:0 2px 2px 0;padding:0.4em 1em;border:1px solid #dfdee1;border-radius:5px}.permalink{color:inherit}.txt--xx-small{font-size:14px}.flush{margin:0;padding:0}.push--bottom{margin-bottom:8px}.border--top{border-top:1px solid #ECE9E6}.btn{padding:0.2em 0.4em;font-weight:500;text-decoration:none;border-radius:3rem;white-space:nowrap;background:#5522FA;border-color:#5522FA;color:#ffffff}.btn--email{display:inline-block;text-align:center;font-weight:500;font-size:1em;text-decoration:none;border-radius:2em;white-space:nowrap;background:#5522FA;border-color:#5522FA;color:#ffffff;border-top:0.3em solid #5522FA;border-left:1em solid #5522FA;border-bottom:0.3em solid #5522FA;border-right:1em solid #5522FA}
        </style>
    </head>

    <body>
        <div class="message-content">
            <div class="trix-content">
                <div>{!! $post->html !!}</div>
            </div>

            <br>

            <hr class="border--top">

            <p class="txt--xx-small flush push--bottom">
                {{ __('You’re subscribed to') }} <a class="permalink" href="{{ url('/') }}">{{ config('app.name', 'Wordful') }}</a>
            </p>

            <p class="txt--xx-small flush push--bottom">
                {{ __('Don’t want these posts anymore?') }} <a class="permalink" href="{{ \URL::signedRoute('wordful.subscribers.unsubscribe.index', $subscriber) }}">{{ __('Unsubscribe') }}</a>
            </p>
        </div>
    </body>
</html>

<x-wordful::subscribers-layout>
    <main class="p-4 max-w-3xl mx-auto min-h-screen">
        <section>
            <div class="p-6 mx-auto text-center rounded shadow-lg lg:p-8 max-w-lg border">
                @if (is_null($subscriber->confirmed_at))
                    <h1 class="m-0 text-2xl lg:text-3xl font-bold leading-none text-center">
                        {{ __('You’re almost done.') }}
                    </h1>

                    <p class="mt-5 text-lg lg:text-xl">{{ __('Confirm your subscription to continue.') }}</p>

                    <form method="POST" action="{{ \URL::signedRoute('wordful.subscribers.confirmed.store', $subscriber) }}" class="mt-1">
                        @csrf
                        <input type="submit" value="{{ __('Confirm subscription') }}" class="font-medium text-xs border rounded-full py-1 px-2 bg-white border-gray-900 cursor-pointer">
                    </form>

                    <script>document.getElementsByTagName("form")[0].submit()</script>
                @else
                    <h1 class="m-0 text-2xl lg:text-3xl font-bold leading-none text-center">
                        {{ __('You’re on the list.') }}
                    </h1>

                    <p class="mt-5 text-lg leading-tight">
                        {{ __('Also, so you know') }}, <strong>{{ config('app.name', 'Wordful') }} {{ __('may not send every post to the mailing list') }}</strong>. {{ __('While every post hits the web, each author gets to decide which posts are sent to their list.') }}
                    </p>

                    <p class="mt-5">
                        <a class="rounded-full border border-gray-900 py-2 px-4 font-medium text-xl" href="/">{{ __('See all posts') }}</a>
                    </p>
                @endif
            </div>

            <p class="my-5 text-center text-gray-500 underline">
                <a href="{{ \URL::signedRoute('wordful.subscribers.unsubscribe.index', $subscriber) }}">{{ __('Unsubscribe') }}</a>
            </p>
        </section>
    </main>
</x-wordful::subscribers-layout>

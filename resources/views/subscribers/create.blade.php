<x-wordful::subscribers-layout>
    <main class="p-4 max-w-3xl mx-auto min-h-screen">
        <section>
            <div class="p-6 mx-auto text-center rounded shadow-lg lg:p-8 max-w-lg border">
                <form action="{{ route('wordful.subscribers.store') }}" method="POST">
                    @csrf

                    <label for="email" class="font-bold">
                        {{ __('Subscribe below to get future posts from') }} <span class="whitespace-nowrap">{{ config('app.name', 'Wordful') }}</span>
                    </label>

                    <div class="flex mt-2">
                        <input type="email" name="email" placeholder="{{ __('Type your email…') }}" required class="text-sm lg:text-base rounded-full rounded-r border-r-0 py-2 px-4 w-full border-gray-200" />

                        <button class="text-sm lg:text-base rounded-full rounded-l border bg-gray-100 px-4 py-2 border-gray-200">
                            {{ __('Subscribe') }}
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</x-wordful::subscribers-layout>

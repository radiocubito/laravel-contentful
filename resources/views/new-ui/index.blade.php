<x-dev-wordful-layout>
    <x-wordful::page-heading>
        <x-slot name="heading">
            <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
                {{ $post->title }}
            </h1>
        </x-slot>

        <x-slot name="actions">
            <div class="flex items-center divide-x">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('wordful.posts.edit', $post) }}" class="px-3 py-2 text-sm leading-4 font-medium rounded flex items-center text-gray-500 hover:bg-gray-200">
                        Cancel
                    </a>
                    <a href="{{ route('wordful.posts.create') }}" class="order-0 inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded text-gray-700 bg-gray-100 hover:bg-gray-200">
                        Save
                    </a>
                </div>
            </div>
        </x-slot>
    </x-wordful::page-heading>

    <div class="py-8 xl:py-10">
        <div class="max-w-2xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div>
                <livewire:wordful::email-post-to-subscribers :post="$post" />

                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h1>
                </div>

                <div class="py-3 xl:pt-6 xl:pb-0">
                    <div class="prose max-w-none">
                        {!! $post->html !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dev-wordful-layout>

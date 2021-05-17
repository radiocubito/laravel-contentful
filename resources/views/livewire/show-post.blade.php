<div>
    <x-wordful::page-heading>
        <x-slot name="heading">
            <div class="flex items-center">
                <a href="{{ route('wordful.posts.index') }}" class="text-gray-500 mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
                    {{ $post->title }}
                </h1>
            </div>
        </x-slot>

        <x-slot name="actions">
            <div class="flex items-center divide-x">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('wordful.posts.edit', $post) }}" class="p-2 rounded flex items-center text-gray-500 hover:bg-gray-200">
                        <span class="sr-only">Edit</span>
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('wordful.posts.settings', $post) }}" class="p-2 rounded flex items-center text-gray-500 hover:bg-gray-200">
                        <span class="sr-only">Settings</span>
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <x-wordful::dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button type="button" class="p-2 rounded flex items-center text-gray-500 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <span class="sr-only">Open options</span>
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-wordful::dropdown.link :href="route('wordful.posts.edit', $post)">
                                {{ __('Edit') }}
                            </x-wordful::dropdown.link>
                            <x-wordful::dropdown.link :href="route('wordful.posts.settings', $post)">
                                {{ __('Settings') }}
                            </x-wordful::dropdown.link>
                            <x-wordful::dropdown.link
                                :href="route('wordful.posts.edit', $post)"
                                onclick="event.preventDefault();
                                    confirm('Are you sure you want to delete this post?') || event.stopImmediatePropagation();"
                                wire:click="delete"
                            >
                                {{ __('Delete') }}
                            </x-wordful::dropdown.link>
                        </x-slot>
                    </x-wordful::dropdown>
                </div>
                @if ($post->isDraft())
                    <div class="ml-3 pl-3">
                        <a href="{{ route('wordful.posts.create') }}" class="order-0 inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded text-gray-700 bg-gray-100 hover:bg-gray-200">
                            Publish
                        </a>
                    </div>
                @endif
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
</div>

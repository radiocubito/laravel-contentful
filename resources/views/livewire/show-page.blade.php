<div class="py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div>
            @if ($post->isDraft())
                <div class="pb-6">
                    <div class="bg-gray-50 border border-gray-200 sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex justify-center space-x-2">
                                <x-wordful::button.primary href="{{ route('wordful.pages.edit', $post) }}">
                                    {{ __('Continue editing') }}
                                </x-wordful::button.primary>
                                <x-wordful::button.secondary type="button" wire:click="publish">
                                    {{ __('Publish this page') }}
                                </x-wordful::button.secondary>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex items-start justify-between space-x-4 border-b pb-6">
                <div>
                    <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl">{{ $post->title }}</h1>
                    <p class="mt-2 text-sm text-gray-500">
                        {{ __('By') }} <span class="font-medium text-gray-900">{{ $post->author->name }}</span>

                        @if ($post->tags->count() > 0)
                            {{ __('in') }} <span class="font-medium text-gray-900">{{ $post->tags->first()->name }}</span>
                        @endif

                        @if ($post->isPublished())
                            · {{ optional($post->published_at)->format('F j, Y') }}
                        @endif
                    </p>
                </div>
                <div class="flex space-x-1.5 sm:mt-1">
                    <a href="{{ route('wordful.pages.edit', $post) }}" class="p-2 rounded-full flex items-center text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                        <span class="sr-only">{{ __('Edit') }}</span>
                        <svg class="h-5 w-5" x-description="Heroicon name: solid/pencil" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                    </a>

                    <a href="{{ route('wordful.pages.settings', $post) }}" class="p-2 rounded-full flex items-center text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                        <span class="sr-only">{{ __('Settings') }}</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </a>

                    <x-wordful::dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button type="button" class="p-2 rounded-full flex items-center text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                                <span class="sr-only">{{ __('Open options') }}</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-wordful::dropdown.link :href="route('wordful.pages.edit', $post)">
                                {{ __('Edit') }}
                            </x-wordful::dropdown.link>

                            <x-wordful::dropdown.link :href="route('wordful.pages.settings', $post)">
                                {{ __('Settings') }}
                            </x-wordful::dropdown.link>

                            <x-wordful::dropdown.link
                                :href="route('wordful.pages.edit', $post)"
                                onclick="event.preventDefault();
                                    confirm('Are you sure you want to delete this post?') || event.stopImmediatePropagation();"
                                wire:click="delete"
                            >
                                {{ __('Delete') }}
                            </x-wordful::dropdown.link>
                        </x-slot>
                    </x-wordful::dropdown>
                </div>
            </div>

            <div class="py-3 xl:pt-6 xl:pb-0">
                <h2 class="sr-only">{{ __('Content') }}</h2>

                <div class="prose max-w-none">
                    {!! $post->html !!}
                </div>
            </div>
        </div>
    </div>
</div>

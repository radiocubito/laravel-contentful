<div class="py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div>
            @if ($post->isDraft())
                <div class="pb-6">
                    <div class="bg-gray-50 border border-gray-200 sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex justify-center space-x-2">
                                <x-wordful::button.primary href="{{ route('wordful.posts.edit', $post) }}">
                                    {{ __('Continue editing') }}
                                </x-wordful::button.primary>
                                <x-wordful::button.secondary type="button" wire:click="publish">
                                    {{ __('Publish this post') }}
                                </x-wordful::button.secondary>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (config('wordful.pro'))
                <livewire:wordful-pro::email-post-to-subscribers :post="$post" />
            @endif

            <div class="flex items-start justify-between space-x-4 border-b pb-6">
                <div>
                    <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl">{{ $post->title }}</h1>
                    <p class="mt-2 text-sm text-gray-500 font-medium">
                        By <span class="text-gray-900">{{ $post->author->name }}</span>

                        @if ($post->tags->count() > 0)
                            in <span class="text-gray-900">{{ $post->tags->first()->name }}</span>
                        @endif

                        @if ($post->isPublished())
                            · {{ optional($post->published_at)->format('F j, Y') }}
                        @endif
                    </p>
                </div>
                <div class="flex space-x-1.5 sm:mt-1">
                    <a href="{{ route('wordful.posts.edit', $post) }}" class="p-2 rounded-full flex items-center text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                        <span class="sr-only">Edit</span>
                        <svg class="h-5 w-5" x-description="Heroicon name: solid/pencil" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                    </a>

                    <x-wordful::dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button type="button" class="p-2 rounded-full flex items-center text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                                <span class="sr-only">Open options</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-wordful::dropdown.link :href="route('wordful.posts.edit', $post)">
                                {{ __('Edit') }}
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
            </div>

            <div class="py-3 xl:pt-6 xl:pb-0">
                <h2 class="sr-only">Content</h2>

                <div class="prose max-w-none">
                    {!! $post->html !!}
                </div>
            </div>
        </div>

        <div class="mt-6 border-t border-gray-200 py-6 space-y-8">
            <div>
                <h2 class="text-sm font-medium text-gray-500">Tags</h2>

                @if ($post->tags->count() > 1)
                    <ul class="mt-2 leading-8">
                        @foreach ($post->tags as $tag)
                            <li class="inline">
                                <div class="relative inline-flex items-center rounded-full border border-gray-300 px-3 py-0.5">
                                    <div class="text-sm font-medium text-gray-900">{{ $tag->name }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="mt-2 leading-8 text-sm font-medium text-gray-900">No tags</div>
                @endif
            </div>
        </div>
    </div>
</div>

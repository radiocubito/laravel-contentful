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
                    <x-wordful::button.edit href="{{ route('wordful.posts.edit', $post) }}" />
                    <x-wordful::button.settings href="{{ route('wordful.posts.settings', $post) }}" />
                    <x-wordful::dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <x-wordful::button.options type="button" />
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
                        <x-wordful::button color="secondary" type="button" wire:click="publish">
                            {{ __('Publish') }}
                        </x-wordful::button>
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

<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        @if ($post->isDraft())
            <div class="bg-gray-50 sm:rounded-lg mb-8">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex justify-center space-x-2">
                        <x-contentful::button.primary href="{{ route('contentful.pages.edit', $post) }}">
                            {{ __('Continue editing') }}
                        </x-contentful::button.primary>

                        <x-contentful::button.secondary type="button" wire:click="publish">
                            {{ __('Publish this page') }}
                        </x-contentful::button.secondary>
                    </div>
                </div>
            </div>
        @endif

        <div class="pb-5 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
            <h1 class="text-4xl font-bold text-gray-900">
                {{ $post->title }}
            </h1>
            <div class="mt-3 sm:mt-0 sm:ml-4">
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-contentful::dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>
                                    <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-contentful::dropdown.link :href="route('contentful.pages.edit', $post)">
                                {{ __('Edit') }}
                            </x-contentful::dropdown.link>
                        </x-slot>
                    </x-contentful::dropdown>
                </div>
            </div>
        </div>

        @if ($post->isPublished())
            <p class="text-base py-2 border-b border-gray-200 text-gray-700">{{ optional($post->published_at)->format('F j, Y') }}</p>
        @endif

        <div class="prose mt-12">{!! $post->html !!}</div>
    </div>
</div>

<form wire:submit.prevent="save">
    <x-wordful::page-heading>
        <x-slot name="heading">
            <div class="flex items-center">
                <a href="{{ route('wordful.posts.show', $post) }}" class="text-gray-500 mr-2">
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
                    <a href="{{ route('wordful.posts.show', $post) }}" class="px-3 py-2 text-sm leading-4 font-medium rounded flex items-center text-gray-500 hover:bg-gray-200">
                        Cancel
                    </a>
                </div>

                <div class="ml-3 pl-3 flex items-center space-x-2">
                    @if ($post->isPublished())
                        <button type="submit" class="order-0 inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded text-gray-700 bg-gray-100 hover:bg-gray-200">
                            Save
                        </button>
                    @elseif ($post->isDraft())
                        <button type="submit" class="px-3 py-2 text-sm leading-4 font-medium rounded flex items-center text-gray-500 hover:bg-gray-200">
                            Save
                        </button>

                        <button type="button" wire:click="saveAndPublish" class="order-0 inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded text-gray-700 bg-gray-100 hover:bg-gray-200">
                            Publish
                        </button>
                    @endif
                </div>
            </div>
        </x-slot>
    </x-wordful::page-heading>

    <div class="py-8 xl:py-10">
        <div class="max-w-2xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div>
                <x-wordful::input.errors class="mb-4" :errors="$errors" />

                <div>
                    <label for="title" class="sr-only">{{ __('Title') }}</label>
                    <x-wordful::input.textarea wire:model.defer="post.title" sharedBorder placeholder="{{ __('Post title') }}" rows="1" class="border-0 text-2xl font-bold text-gray-900 resize-none" />
                </div>

                <div class="py-3 xl:pt-6 xl:pb-0">
                    <label for="html" class="sr-only">{{ __('HTML') }}</label>
                    <x-wordful::input.rich-text wire:model.defer="post.html" id="html" />
                </div>
            </div>
        </div>
    </div>
</div>

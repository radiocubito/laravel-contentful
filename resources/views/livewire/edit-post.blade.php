<x-wf-dashboard>
    <x-slot name="sidebar">
        <x-wordful::sidebar-navigation />
    </x-slot>

    <x-slot name="header">
        <x-wordful::navbar />
    </x-slot>

    <form wire:submit.prevent="save">
        <x-wordful::page-heading>
            <x-slot name="heading">
                <div class="flex items-center">
                    <span class="mr-2 inline-flex">
                        <x-wordful::button.back href="{{ route('wordful.posts.show', $post) }}" />
                    </span>
                    <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
                        {{ $post->title }}
                    </h1>
                </div>
            </x-slot>

            <x-slot name="actions">
                <div class="flex items-center divide-x">
                    <div class="flex items-center space-x-2">
                        <x-wordful::button color="transparent" href="{{ route('wordful.posts.show', $post) }}">
                            {{ __('Cancel') }}
                        </x-wordful::button>
                    </div>

                    <div class="ml-3 pl-3 flex items-center space-x-2">
                        @if ($post->isPublished())
                            <x-wordful::button color="secondary">
                                {{ __('Save') }}
                            </x-wordful::button>
                        @elseif ($post->isDraft())
                            <x-wordful::button color="transparent">
                                {{ __('Save') }}
                            </x-wordful::button>

                            <x-wordful::button color="secondary" type="button" wire:click="saveAndPublish">
                                {{ __('Publish') }}
                            </x-wordful::button>
                        @endif
                    </div>
                </div>
            </x-slot>
        </x-wordful::page-heading>

        <div class="py-8 xl:py-10">
            <div class="max-w-3xl px-4 sm:px-6 lg:px-8 mx-auto">
                <div>
                    <x-wordful::input.errors class="mb-4" :errors="$errors" />

                    <div>
                        <label for="title" class="sr-only">{{ __('Title') }}</label>
                        <x-wordful::input.textarea wire:model.defer="post.title" sharedBorder placeholder="{{ __('Post title') }}" rows="1" class="border-0 text-4xl py-0 font-extrabold text-gray-900 resize-none" />
                    </div>

                    <div class="py-3 xl:pt-6 xl:pb-0">
                        <label for="html" class="sr-only">{{ __('HTML') }}</label>
                        <x-wordful::input.editor wire:model.defer="post.html" id="html" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-wf-dashboard>

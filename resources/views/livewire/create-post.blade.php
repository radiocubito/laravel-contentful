<form wire:submit.prevent="publish">
    <x-wordful::page-heading>
        <x-slot name="heading">
            <div class="flex items-center">
                <span class="mr-2 inline-flex">
                    <x-wordful::button.back href="{{ route('wordful.posts.index') }}" />
                </span>
                <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
                    {{ __('New post') }}
                </h1>
            </div>
        </x-slot>

        <x-slot name="actions">
            <div class="flex items-center divide-x">
                <div class="flex items-center space-x-2">
                    <x-wordful::button color="white" href="{{ route('wordful.posts.index') }}">
                        {{ __('Cancel') }}
                    </x-wordful::button>
                </div>

                <div class="ml-3 pl-3 flex items-center space-x-2">
                    <x-wordful::button color="white" type="button" wire:click="save">
                        {{ __('Save draft') }}
                    </x-wordful::button>

                    <x-wordful::button color="secondary">
                        {{ __('Publish') }}
                    </x-wordful::button>
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

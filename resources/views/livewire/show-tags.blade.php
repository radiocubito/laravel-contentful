<x-wf-dashboard>
    <x-slot name="sidebar">
        <x-wordful::sidebar-navigation />
    </x-slot>

    <x-slot name="header">
        <x-wordful::navbar />
    </x-slot>

    <x-wordful::page-heading>
        <x-slot name="heading">
            <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
                {{ __('Tags') }}
            </h1>
        </x-slot>

        <x-slot name="actions">
            <x-wordful::button color="secondary" href="{{ route('wordful.posts.create') }}">
                <span class="-ml-1 mr-0.5 ">
                    <x-wordful::icon.new class="h-4 w-4" />
                </span>
                {{ __('Tag') }}
            </x-wordful::button>
        </x-slot>
    </x-wordful::page-heading>

    <div class="py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="pb-5 border-b border-gray-200">
                <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    {{ __('Tags') }}
                </h1>
                <p class="mt-2 max-w-4xl text-sm font-medium text-gray-500">{{ __('Manage tag settings') }}</p>
            </div>

            <div class="flex items-center justify-between pt-6">
                <p class="max-w-xs text-sm text-gray-500">
                    {{ __('Tags make it easy to organize your posts or pages.') }}
                </p>

                <div class="flex-shrink-0 ml-4">
                    <x-wordful::button.primary type="button" wire:click="$set('showCreateTagForm', true)">
                        {{ __('New tag') }}
                    </x-wordful::button.primary>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-1 pt-6">
                @if ($showCreateTagForm)
                    <form class="rounded border border-gray-200 bg-gray-50 p-2 flex items-center space-x-3" wire:submit.prevent="saveNewTag">
                        <div class="flex-1 min-w-0">
                            <div class="flex">
                                <div class="flex-grow">
                                    <x-wordful::input.text id="newTagName" wire:model.defer="newTag.name" type="text" class="block w-full" placeholder="{{ __('Tag name') }}" />
                                </div>
                                <span class="ml-2 flex space-x-2 border-l border-gray-100 pl-2">
                                    <x-wordful::button.secondary type="button" wire:click="$set('showCreateTagForm', false)">
                                        {{ __('Cancel') }}
                                    </x-wordful::button.secondary>

                                    <x-wordful::button.primary>
                                        {{ __('Save') }}
                                    </x-wordful::button.primary>
                                </span>
                            </div>

                            <x-wordful::input.error for="newTag.name" class="mt-2"/>
                        </div>
                    </form>
                @endif

                @foreach ($tags as $tag)
                    <div class="relative rounded border border-gray-200 bg-gray-50 py-2 px-3 flex items-center space-x-3 hover:border-gray-300 focus-within:ring-2 focus-within:ring-offset-1 focus-within:ring-primary-500">
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('wordful.tags.edit', $tag) }}" class="focus:outline-none">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $tag->name }}
                                </p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-wf-dashboard>

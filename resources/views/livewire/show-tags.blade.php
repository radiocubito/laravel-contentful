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
            <x-wordful::button color="secondary" wire:click="$set('showCreateTagForm', true)">
                <span class="-ml-1 mr-0.5 ">
                    <x-wordful::icon.new class="h-4 w-4" />
                </span>
                {{ __('Tag') }}
            </x-wordful::button>
        </x-slot>
    </x-wordful::page-heading>

    <x-wordful::tags-list :tags="$tags" />

    @if ($showCreateTagForm)
        <form wire:submit.prevent="saveNewTag" wire:keydown.escape="$set('showCreateTagForm', false)" x-data x-init="$refs.newTagName.focus()">
            <div class="px-4 sm:px-6 lg:px-5 py-3">
                <div class="bg-gray-50 rounded p-3">
                    <div class="flex items-center">
                        <div class="flex-grow">
                            <label for="newTagName" class="sr-only">{{ __('Tag name') }}</label>
                            <x-wordful::input.text id="newTagName" wire:model.defer="newTag.name" x-ref="newTagName" type="text" class="block w-full" placeholder="{{ __('Tag name') }}" />
                        </div>
                        <div class="ml-4 flex-shrink-0 space-x-2">
                            <x-wordful::button color="white" type="button" wire:click="$set('showCreateTagForm', false)">
                                {{ __('Cancel') }}
                            </x-wordful::button>
                            <x-wordful::button color="primary">
                                {{ __('Create tag') }}
                            </x-wordful::button>
                        </div>
                    </div>
                    <x-wordful::input.error for="newTag.name" class="mt-2"/>
                </div>
            </div>
        </form>
    @endif
</x-wf-dashboard>

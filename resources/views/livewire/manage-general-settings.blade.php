<x-wf-dashboard>
    <x-slot name="sidebar">
        <x-wordful::sidebar-navigation />
    </x-slot>

    <x-slot name="header">
        <x-wordful::navbar />
    </x-slot>

    <x-wordful::page-heading>
        <x-slot name="heading">
            <div class="flex items-center">
                <span class="mr-2 inline-flex">
                    <x-wordful::button.back href="{{ route('wordful.posts.index') }}" />
                </span>
                <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
                    Settings
                </h1>
            </div>
        </x-slot>
    </x-wordful::page-heading>

    <div class="py-6 px-6 sm:px-14 lg:px-16">
        <div class="space-y-8">
            <h1 class="text-lg font-medium leading-5 text-gray-900 sm:truncate">
                {{ __('General') }}
            </h1>

            <form wire:submit.prevent="save">
                <x-wordful::input.section>
                    <x-slot name="heading">
                        <div>
                            <h2 class="text-sm font-medium text-gray-900">
                                {{ __('Title & description') }}
                            </h2>
                            <p class="text-sm leading-normal text-gray-500">{{ __('The details used to identify your site around the web.') }}</p>
                        </div>
                    </x-slot>

                    <x-wordful::input.inline-group>
                        <x-slot name="label">
                            <x-wordful::input.label for="name" value="{{ __('Site name') }}" />
                        </x-slot>
                        <x-wordful::input.text id="name" type="text" class="block w-full max-w-lg sm:max-w-xs" wire:model.defer="name" />
                        <x-wordful::input.error for="name" class="mt-2"/>
                    </x-wordful::input.inline-group>
                    <x-wordful::input.inline-group>
                        <x-slot name="label">
                            <x-wordful::input.label for="description" value="{{ __('Site description') }}" />
                        </x-slot>
                        <x-wordful::input.textarea id="description" class="block w-full max-w-lg" wire:model.defer="description" rows="4" />
                        <x-wordful::input.error for="description" class="mt-2"/>
                    </x-wordful::input.inline-group>

                    <x-wordful::input.section-actions>
                        <x-wordful::button color="primary">
                            {{ __('Save settings') }}
                        </x-wordful::button>
                    </x-wordful::input.section-actions>
                </x-wordful::input.section>
            </form>
        </div>
    </div>
</x-wf-dashboard>

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

    <div class="py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <form wire:submit.prevent="save">
                <div class="pb-5 border-b border-gray-200">
                    <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        {{ __('General') }}
                    </h1>
                    <p class="mt-2 max-w-4xl text-sm font-medium text-gray-500">{{ __('Manage your general settings') }}</p>
                </div>
                <div class="py-6">
                    <div class="space-y-8">
                        <x-wordful::input.section>
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
                                    {{ __('Save changes') }}
                                </x-wordful::button.primary>
                            </x-wordful::input.section-actions>
                        </x-wordful::input.section>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-wf-dashboard>

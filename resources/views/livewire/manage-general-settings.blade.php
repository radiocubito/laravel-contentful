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
                    {{ __('Settings') }}
                </h1>
            </div>
        </x-slot>
    </x-wordful::page-heading>

    <div class="py-6 px-6 sm:px-14 lg:px-16">
        <div class="space-y-8">
            <h1 class="text-lg font-medium leading-5 text-gray-900 sm:truncate">
                {{ __('General') }}
            </h1>

            <livewire:wordful::settings.update-site-title-and-description-form />

            <livewire:wordful::settings.update-site-locale-and-timezone-form />

            <livewire:wordful::settings.update-site-identity-form />
        </div>
    </div>
</x-wf-dashboard>

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
                    <x-wordful::button.back href="{{ route('wordful.pages.index') }}" />
                </span>
                <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
                    {{ $page->title }}
                </h1>
            </div>
        </x-slot>

        <x-slot name="actions">
            <div class="flex items-center divide-x">
                <div class="flex items-center space-x-2">
                    <x-wordful::button.edit href="{{ route('wordful.pages.edit', $page) }}" />
                    <x-wordful::button.settings href="{{ route('wordful.pages.settings', $page) }}" />
                    <x-wordful::dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <x-wordful::button.options type="button" />
                        </x-slot>
                        <x-slot name="content">
                            <x-wordful::dropdown.link :href="route('wordful.pages.edit', $page)">
                                {{ __('Edit') }}
                            </x-wordful::dropdown.link>

                            <x-wordful::dropdown.link :href="route('wordful.pages.settings', $page)">
                                {{ __('Settings') }}
                            </x-wordful::dropdown.link>

                            <x-wordful::dropdown.link
                                :href="route('wordful.pages.edit', $page)"
                                onclick="event.preventDefault();
                                    confirm('{{ __('Are you sure you want to delete this page?') }}') || event.stopImmediatePropagation();"
                                wire:click="delete"
                            >
                                {{ __('Delete') }}
                            </x-wordful::dropdown.link>
                        </x-slot>
                    </x-wordful::dropdown>
                </div>
                @if ($page->isDraft())
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
        <div class="max-w-3xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div>
                <div>
                    <h1 class="text-4xl font-extrabold text-gray-900">{{ $page->title }}</h1>
                </div>

                <div class="py-3 xl:pt-6 xl:pb-0">
                    <div class="prose max-w-none">
                        {!! $page->html !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-wf-dashboard>

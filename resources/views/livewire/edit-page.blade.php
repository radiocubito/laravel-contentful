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
                        <x-wordful::button.back href="{{ route('wordful.pages.show', $page) }}" />
                    </span>
                    <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
                        {{ $page->title }}
                    </h1>
                </div>
            </x-slot>

            <x-slot name="actions">
                <div class="flex items-center divide-x">
                    <div class="flex items-center space-x-2">
                        <x-wordful::button color="white" href="{{ route('wordful.pages.show', $page) }}">
                            {{ __('Cancel') }}
                        </x-wordful::button>
                    </div>

                    <div class="ml-3 pl-3 flex items-center space-x-2">
                        @if ($page->isPublished())
                            <x-wordful::button color="secondary">
                                {{ __('Save') }}
                            </x-wordful::button>
                        @elseif ($page->isDraft())
                            <x-wordful::button color="white">
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
                        <x-wordful::input.textarea wire:model.defer="page.title" sharedBorder placeholder="{{ __('Page title') }}" rows="1" class="border-0 text-2xl font-bold text-gray-900 resize-none" />
                    </div>

                    <div class="py-3 xl:pt-6 xl:pb-0">
                        <label for="html" class="sr-only">{{ __('HTML') }}</label>
                        <x-wordful::input.rich-text wire:model.defer="page.html" id="html" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-wf-dashboard>

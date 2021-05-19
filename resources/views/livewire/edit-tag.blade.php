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
                        <x-wordful::button.back href="{{ route('wordful.tags.index') }}" />
                    </span>
                    <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
                        {{ $tag->name }}
                    </h1>
                </div>
            </x-slot>

            <x-slot name="actions">
                <div class="flex items-center divide-x">
                    <div class="flex items-center space-x-2">
                        <x-wordful::button color="transparent" href="{{ route('wordful.tags.index') }}">
                            {{ __('Cancel') }}
                        </x-wordful::Cancel>

                        <x-wordful::button color="secondary">
                            {{ __('Save') }}
                        </x-wordful::button>
                    </div>
                </div>
            </x-slot>
        </x-wordful::page-heading>
        <div class="py-10">
            <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="pb-5 border-b border-gray-200">
                    <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        {{ $tag->name }}
                    </h1>
                    <p class="mt-2 max-w-4xl text-sm font-medium text-gray-500">{{ __('Manage tag settings') }}</p>
                </div>
                <div class="py-6">
                    <div>
                        <div class="p-4 border border-gray-200 rounded-md bg-gray-50">
                            <div class="divide-y divide-gray-200 -my-4 sm:-my-5">
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <x-wordful::input.label for="name" value="{{ __('Name') }}" class="sm:mt-px sm:pt-2"/>

                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <x-wordful::input.text id="name" type="text" class="block w-full" wire:model.defer="tag.name" />
                                        <x-wordful::input.error for="tag.name" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <x-wordful::input.label for="slug" value="{{ __('Slug') }}" class="sm:mt-px sm:pt-2"/>

                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <x-wordful::input.text id="slug" type="text" class="block w-full" leading-add-on="{{ request()->getHost() }}/tags/" wire:model.defer="tag.slug" />
                                        <x-wordful::input.error for="tag.slug" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <x-wordful::input.label for="description" value="{{ __('Description') }}" class="sm:mt-px sm:pt-2"/>

                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <x-wordful::input.textarea id="description" class="block w-full" wire:model.defer="tag.description" rows="4" />
                                        <x-wordful::input.error for="tag.description" class="mt-2"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div x-data="{ on: @entangle('customMetaDataEnabled') }">
                        <div class="flex pt-6 items-center justify-between">
                            <span class="flex-grow flex flex-col" id="availability-label" @click="on = !on; $refs.switch.focus()">
                                <span class="text-sm font-medium text-gray-900">{{ __('Use custom meta data') }}</span>
                                <span class="text-sm leading-normal text-gray-500">{{ __('Customise extra content for search engines.') }}</span>
                            </span>
                            <button wire:click="$toggle('customMetaDataEnabled')" type="button" class="bg-gray-200 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" aria-pressed="false" x-ref="switch" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'bg-primary-600': on, 'bg-gray-200': !(on) }" aria-labelledby="availability-label" :aria-pressed="on.toString()">
                                <span class="sr-only">{{ __('Use custom excerpt setting') }}</span>
                                <span aria-hidden="true" class="translate-x-0 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'translate-x-5': on, 'translate-x-0': !(on) }"></span>
                            </button>
                        </div>
                        <div>
                            <div x-show="on" class="mt-4 p-4 border border-gray-200 rounded-md bg-gray-50">
                                <div class="divide-y divide-gray-200 -my-4 sm:-my-5">
                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <x-wordful::input.label for="excerpt" value="{{ __('Meta title') }}" class="sm:mt-px sm:pt-2"/>
                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                            <x-wordful::input.text id="meta_title" type="text" class="block w-full" wire:model.defer="tag.meta.meta_title" :placeholder="$tag->name" />
                                            <x-wordful::input.error for="tag.meta.meta_title" class="mt-2"/>
                                        </div>
                                    </div>

                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <x-wordful::input.label for="excerpt" value="{{ __('Meta description') }}" class="sm:mt-px sm:pt-2"/>
                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                            <x-wordful::input.textarea id="meta_description" class="block w-full" wire:model.defer="tag.meta.meta_description" :placeholder="$tag->description" rows="4" />
                                            <x-wordful::input.error for="tag.meta.meta_description" class="mt-2"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-wf-dashboard>

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
                <div class="flex items-center divide-x pr-8">
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

        <div class="py-6 px-16">
            <div class="space-y-8">
                <x-wordful::input.section>
                    <x-slot name="heading">
                        <h2 class="text-sm font-medium text-gray-900">
                            {{ __('Manage tag settings') }}
                        </h2>
                    </x-slot>

                    <x-wordful::input.inline-group>
                        <x-slot name="label">
                            <x-wordful::input.label for="name" value="{{ __('Name') }}" />
                        </x-slot>

                        <x-wordful::input.text id="name" type="text" class="block w-full max-w-lg sm:max-w-xs" wire:model.defer="tag.name" />
                        <x-wordful::input.error for="tag.name" class="mt-2"/>
                    </x-wordful::input.inline-group>

                    <x-wordful::input.inline-group>
                        <x-slot name="label">
                            <x-wordful::input.label for="slug" value="{{ __('Slug') }}" />
                        </x-slot>

                        <div class="max-w-lg">
                            <x-wordful::input.text id="slug" type="text" class="block w-full" leading-add-on="{{ request()->getHost() }}/tags/" wire:model.defer="tag.slug" />
                            <x-wordful::input.error for="tag.slug" class="mt-2"/>
                        </div>
                    </x-wordful::input.inline-group>

                    <x-wordful::input.inline-group>
                        <x-slot name="label">
                            <x-wordful::input.label for="description" value="{{ __('Description') }}" />
                        </x-slot>

                        <x-wordful::input.textarea id="description" class="block w-full max-w-lg" wire:model.defer="tag.description" rows="4" />
                        <x-wordful::input.error for="tag.description" class="mt-2"/>
                    </x-wordful::input.inline-group>
                </x-wordful::input.section>

                <x-wordful::input.section wire:model="customMetaDataEnabled" expandable>
                    <x-slot name="heading">
                        <div class="flex flex-col">
                            <h2
                                id="custom-metadata-label"
                                @click="{{ $component->attributes->get('clickExpression') }}"
                                class="text-sm font-medium text-gray-900"
                            >{{ __('Use custom meta data') }}</h2>
                            <p class="text-sm leading-normal text-gray-500">{{ __('Customise extra content for search engines.') }}</p>
                        </div>
                    </x-slot>

                    <x-slot name="switch">
                        <x-wordful::button.switch wire:click="$toggle('customMetaDataEnabled')" aria-labelledby="custom-metadata-label">
                            {{ __('Use custom excerpt setting') }}
                        </x-wordful::button.switch>
                    </x-slot>

                    <x-wordful::input.inline-group>
                        <x-slot name="label">
                            <x-wordful::input.label for="meta-title" value="{{ __('Meta title') }}" />
                        </x-slot>

                        <x-wordful::input.text id="meta-title" type="text" class="block w-full max-w-lg sm:max-w-xs" wire:model.defer="tag.meta.meta_title" :placeholder="$tag->name" />
                        <x-wordful::input.error for="tag.meta.meta_title" class="mt-2" />
                    </x-wordful::input.inline-group>

                    <x-wordful::input.inline-group>
                        <x-slot name="label">
                            <x-wordful::input.label for="meta-description" value="{{ __('Meta description') }}" />
                        </x-slot>

                        <x-wordful::input.textarea id="meta-description" class="block w-full max-w-lg" wire:model.defer="tag.meta.meta_description" :placeholder="$tag->description" rows="4" />

                        <x-wordful::input.error for="tag.meta.meta_description" class="mt-2"/>
                    </x-wordful::input.inline-group>
                </x-wordful::input.section>

                <x-wordful::input.section-actions>
                    <x-wordful::button color="white" href="{{ route('wordful.tags.index') }}">
                        {{ __('Cancel') }}
                    </x-wordful::Cancel>

                    <x-wordful::button color="primary">
                        {{ __('Save') }}
                    </x-wordful::button>
                </x-wordful::input.section-actions>
            </div>
        </div>
    </form>
</x-wf-dashboard>

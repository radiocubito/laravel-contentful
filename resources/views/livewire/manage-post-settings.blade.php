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
                        <x-wordful::button.back href="{{ route('wordful.posts.show', $post) }}" />
                    </span>
                    <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
                        {{ $post->title }}
                    </h1>
                </div>
            </x-slot>

            <x-slot name="actions">
                <div class="flex items-center divide-x">
                    <div class="flex items-center space-x-2">
                        <x-wordful::button color="transparent" href="{{ route('wordful.posts.show', $post) }}">
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
                            {{ __('Manage post settings') }}
                        </h2>
                    </x-slot>

                    <x-wordful::input.inline-group>
                        <x-slot name="label">
                            <x-wordful::input.label for="slug" value="{{ __('Slug') }}" />
                        </x-slot>

                        <div class="max-w-lg">
                            <x-wordful::input.text id="slug" type="text" class="block w-full" leading-add-on="{{ request()->getHost() }}/" wire:model.defer="post.slug" />
                            <x-wordful::input.error for="post.slug" class="mt-2"/>
                        </div>
                    </x-wordful::input.inline-group>

                    <x-wordful::input.inline-group>
                        <x-slot name="label">
                            <x-wordful::input.label for="status" value="{{ __('Status') }}" />
                        </x-slot>

                        <x-wordful::input.select id="status" wire:model="post.status" class="max-w-xs block w-full">
                            <x-slot name="leadingIcon">
                                @if ($post->isPublished())
                                    <svg class="h-5 w-5 text-primary-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                @elseif ($post->isDraft())
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </x-slot>
                            <option value="published">{{ __('Published') }}</option>
                            <option value="draft">{{ __('Draft') }}</option>
                        </x-wordful::input.select>
                        <x-wordful::input.error for="post.status" class="mt-2"/>
                    </x-wordful::input.inline-group>

                    @if ($post->isPublished())
                        <x-wordful::input.inline-group>
                            <x-slot name="label">
                                <x-wordful::input.label for="publish-date" value="{{ __('Publish date') }}" />
                            </x-slot>

                            <x-wordful::input.text id="publish-date" type="text" class="block w-full max-w-xs" wire:model.defer="publishDate" placeholder="{{ now()->format('Y-m-d H:i:s') }}" />
                            <x-wordful::input.error for="publishDate" class="mt-2"/>
                        </x-wordful::input.inline-group>
                    @endif

                    <x-wordful::input.inline-group>
                        <x-slot name="label">
                            <x-wordful::input.label for="incomingTag" value="{{ __('Tags') }}" />
                        </x-slot>

                        @unless ($showCreateTagForm)
                            <div class="flex" id="tag-select">
                                <x-wordful::input.select id="incomingTag" wire:model="incomingTag" class="block w-full max-w-xs" placeholder="{{ __('Add tag') }}">
                                    @foreach ($selectableTags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </x-wordful::input.select>

                                <span class="ml-2 border-l border-gray-100 pl-2">
                                    <x-wordful::button color="secondary" type="button" wire:click="$set('showCreateTagForm', true)">
                                        {{ __('Create tag') }}
                                    </x-wordful::button>
                                </span>
                            </div>
                            <x-wordful::input.error for="incomingTag" class="mt-2"/>
                        @endunless
                        @if ($showCreateTagForm)
                            <div class="flex">
                                <div class="max-w-xs w-full">
                                    <x-wordful::input.text id="newTagName" wire:model.defer="newTagName" type="text" class="block w-full" placeholder="{{ __('Tag name') }}" />
                                </div>

                                <span class="ml-2 flex space-x-2 border-l border-gray-100 pl-2">
                                    <x-wordful::button color="transparent" type="button" wire:click="$set('showCreateTagForm', false)">
                                        {{ __('Cancel') }}
                                    </x-wordful::button>
                                    <x-wordful::button color="primary" type="button" wire:click.prevent="saveTag">
                                        {{ __('Create tag') }}
                                    </x-wordful::button>
                                </span>
                            </div>
                            <x-wordful::input.error for="newTagName" class="mt-2"/>
                        @endif
                        @if ($selectedTags->count() > 0)
                            <ul class="mt-2 leading-8">
                                @foreach ($selectedTags as $tag)
                                    <li class="inline">
                                        <span class="inline-flex rounded-full border border-gray-200 items-center py-0.5 pl-2.5 pr-1 text-sm font-medium bg-white text-gray-700">
                                            {{ $tag->name }}
                                            <button wire:click="removeTag({{ $tag->id }})" type="button" class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-gray-400 hover:bg-gray-200 hover:text-gray-500 focus:outline-none focus:bg-gray-500 focus:text-white">
                                                <span class="sr-only">Remove {{ $tag->name }} tag</span>
                                                <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                                    <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"></path>
                                                </svg>
                                            </button>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </x-wordful::input.inline-group>
                </x-wordful::input.section>

                <x-wordful::input.section wire:model="customExcerptEnabled" expandable>
                    <x-slot name="heading">
                        <div class="flex flex-col">
                            <h2 id="custom-excerpt-label"
                                    @click="on = !on; $refs.switch.focus()"
                                    class="text-sm font-medium text-gray-900">
                                {{ __('Use custom excerpt') }}
                            </h2>
                            <p class="text-sm leading-normal text-gray-500">{{ __('Customise excerpt data.') }}</p>
                        </div>
                    </x-slot>

                    <x-slot name="switch">
                        <x-wordful::button.switch wire:click="$toggle('customExcerptEnabled')" aria-labelledby="custom-excerpt-label">
                            {{ __('Use custom excerpt setting') }}
                        </x-wordful::button.switch>
                    </x-slot>

                    <x-wordful::input.inline-group>
                        <x-slot name="label">
                            <x-wordful::input.label for="excerpt" value="{{ __('Excerpt') }}" />
                        </x-slot>

                        <x-wordful::input.textarea id="excerpt" class="block w-full max-w-lg" wire:model.defer="post.custom_excerpt" :placeholder="$post->excerpt" rows="5" />

                        <x-wordful::input.error for="post.custom_excerpt" class="mt-2"/>
                    </x-wordful::input.inline-group>
                </x-wordful::input.section>

                <x-wordful::input.section wire:model="customMetaDataEnabled" expandable>
                    <x-slot name="heading">
                        <div class="flex flex-col">
                            <h2 id="custom-metadata-label"
                                    @click="on = !on; $refs.switch.focus()"
                                    class="text-sm font-medium text-gray-900">
                                {{ __('Use custom meta data') }}
                            </h2>
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

                        <x-wordful::input.text id="meta-title" type="text" class="block w-full max-w-lg sm:max-w-xs" wire:model.defer="post.meta.meta_title" :placeholder="$post->title" />
                        <x-wordful::input.error for="post.meta.meta_title" class="mt-2" />
                    </x-wordful::input.inline-group>

                    <x-wordful::input.inline-group>
                        <x-slot name="label">
                            <x-wordful::input.label for="meta-description" value="{{ __('Meta description') }}" />
                        </x-slot>

                        <x-wordful::input.textarea id="meta-description" class="block w-full max-w-lg" wire:model.defer="post.meta.meta_description" :placeholder="$post->excerpt" rows="4" />

                        <x-wordful::input.error for="post.meta.meta_description" class="mt-2"/>
                    </x-wordful::input.inline-group>
                </x-wordful::input.section>

                <x-wordful::input.section-actions>
                    <x-wordful::button color="white" href="{{ route('wordful.posts.index') }}">
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

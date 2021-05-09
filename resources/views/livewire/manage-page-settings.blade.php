<div class="py-10">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <form wire:submit.prevent="save">
            <div class="pb-5 border-b border-gray-200">
                <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    {{ $post->title }}
                </h1>
                <p class="mt-2 max-w-4xl text-sm font-medium text-gray-500">{{ __('Manage page settings') }}</p>
            </div>
            <div class="py-6">
                <div>
                    <div class="p-4 border border-gray-200 rounded-md bg-gray-50">
                        <div class="divide-y divide-gray-200 -my-4 sm:-my-5">
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <x-wordful::input.label for="slug" value="{{ __('Slug') }}" class="sm:mt-px sm:pt-2"/>

                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <x-wordful::input.text id="slug" type="text" class="block w-full" leading-add-on="{{ request()->getHost() }}/" wire:model.defer="post.slug" />
                                    <x-wordful::input.error for="post.slug" class="mt-2"/>
                                </div>
                            </div>

                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <x-wordful::input.label for="status" value="{{ __('Status') }}" class="sm:mt-px sm:pt-2"/>

                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <x-wordful::input.select id="status" wire:model="post.status" class="max-w-lg block w-full">
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
                                </div>
                            </div>

                            @if ($post->isPublished())
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <x-wordful::input.label for="slug" value="{{ __('Publish date') }}" class="sm:mt-px sm:pt-2"/>

                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <x-wordful::input.text id="publish_date" type="text" class="block w-full" wire:model.defer="publishDate" placeholder="{{ now()->format('Y-m-d H:i:s') }}" />
                                        <x-wordful::input.error for="publishDate" class="mt-2"/>
                                    </div>
                                </div>
                            @endif

                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <x-wordful::input.label for="incomingTag" value="{{ __('Tags') }}" class="sm:mt-px sm:pt-2"/>

                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    @unless ($showCreateTagForm)
                                        <div class="flex">
                                            <div class="flex-grow">
                                                <x-wordful::input.select id="incomingTag" wire:model="incomingTag" class="block w-full" placeholder="Add Tag">
                                                    @foreach ($selectableTags as $tag)
                                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                    @endforeach
                                                </x-wordful::input.select>
                                            </div>
                                            <span class="ml-2 border-l border-gray-100 pl-2">
                                                <x-wordful::button.primary type="button" wire:click="$set('showCreateTagForm', true)">
                                                    {{ __('Create tag') }}
                                                </x-wordful::button.primary>
                                            </span>
                                        </div>

                                        <x-wordful::input.error for="incomingTag" class="mt-2"/>
                                    @endunless

                                    @if ($showCreateTagForm)
                                        <div class="flex">
                                            <div class="flex-grow">
                                                <x-wordful::input.text id="newTagName" wire:model.defer="newTagName" type="text" class="block w-full" placeholder="Tag name" />
                                            </div>
                                            <span class="ml-2 flex space-x-2 border-l border-gray-100 pl-2">
                                                <x-wordful::button.secondary type="button" wire:click="$set('showCreateTagForm', false)">
                                                    {{ __('Cancel') }}
                                                </x-wordful::button.secondary>

                                                <x-wordful::button.primary type="button" wire:click.prevent="saveTag">
                                                    {{ __('Save') }}
                                                </x-wordful::button.primary>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-data="{ on: @entangle('customExcerptEnabled') }">
                    <div class="flex pt-6 items-center justify-between">
                        <span class="flex-grow flex flex-col" id="availability-label" @click="on = !on; $refs.switch.focus()">
                            <span class="text-sm font-medium text-gray-900">{{ __('Use custom excerpt') }}</span>
                            <span class="text-sm leading-normal text-gray-500">{{ __('Customise excerpt data.') }}</span>
                        </span>
                        <button wire:click="$toggle('customExcerptEnabled')" type="button" class="bg-gray-200 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" aria-pressed="false" x-ref="switch" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'bg-primary-600': on, 'bg-gray-200': !(on) }" aria-labelledby="availability-label" :aria-pressed="on.toString()">
                            <span class="sr-only">{{ __('Use custom excerpt setting') }}</span>
                            <span aria-hidden="true" class="translate-x-0 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'translate-x-5': on, 'translate-x-0': !(on) }"></span>
                        </button>
                    </div>
                    <div>
                        <div x-show="on" class="mt-4 p-4 border border-gray-200 rounded-md bg-gray-50">
                            <div class="divide-y divide-gray-200 -my-4 sm:-my-5">
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <x-wordful::input.label for="excerpt" value="{{ __('Excerpt') }}" class="sm:mt-px sm:pt-2"/>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <x-wordful::input.textarea id="custom_excerpt" class="block w-full" wire:model.defer="post.custom_excerpt" :placeholder="$post->excerpt" rows="5" />
                                        <x-wordful::input.error for="post.custom_excerpt" class="mt-2"/>
                                    </div>
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
                                        <x-wordful::input.text id="meta_title" type="text" class="block w-full" wire:model.defer="post.meta.meta_title" :placeholder="$post->title" />
                                        <x-wordful::input.error for="post.meta.meta_title" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <x-wordful::input.label for="excerpt" value="{{ __('Meta description') }}" class="sm:mt-px sm:pt-2"/>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <x-wordful::input.textarea id="meta_description" class="block w-full" wire:model.defer="post.meta.meta_description" :placeholder="$post->excerpt" rows="4" />
                                        <x-wordful::input.error for="post.meta.meta_description" class="mt-2"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-6">
                    <div class="flex space-x-3">
                        <x-wordful::button.primary>
                            {{ __('Save changes') }}
                        </x-wordful::button.primary>
                    </div>
                    <div class="mt-2">
                        {{ __('Or,') }} <x-wordful::link href="{{ route('wordful.pages.show', $post) }}">{{ __('discard my changes') }}</x-wordful::link>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

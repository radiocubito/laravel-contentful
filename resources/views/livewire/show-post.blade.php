<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg">
            @if ($post->isDraft())
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <div class="bg-gray-50 sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex justify-center space-x-2">
                                <x-contentful::button.primary href="{{ route('contentful.posts.edit', $post) }}">
                                    {{ __('Continue editing') }}
                                </x-contentful::button.primary>
                                <x-contentful::button.secondary type="button" wire:click="publish">
                                    {{ __('Publish this post') }}
                                </x-contentful::button.secondary>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="px-4 py-5 sm:px-6 sm:flex sm:items-start sm:justify-between">
                <div>
                    <h1 class="text-4xl leading-10 font-semibold text-gray-900">
                        {{ $post->title }}
                    </h1>

                    <p class="mt-1 max-w-2xl text-base text-gray-500">
                        By <span class="font-medium">{{ $post->author->name }}</span>

                        @if ($post->tags->count() > 0)
                            in <span class="font-medium">{{ $post->tags->first()->name }}</span>
                        @endif

                        @if ($post->isPublished())
                            · {{ optional($post->published_at)->format('F j, Y') }}
                        @endif
                    </p>
                </div>
                <div class="mt-3 sm:mt-0 sm:ml-4">
                    <!-- Settings Dropdown -->
                    <div class="flex items-center space-x-4">
                        <a class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out" href="{{ route('contentful.posts.edit', $post) }}">
                            <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>
                        <x-contentful::dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>
                                        <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-contentful::dropdown.link :href="route('contentful.posts.edit', $post)">
                                    {{ __('Edit') }}
                                </x-contentful::dropdown.link>
                            </x-slot>
                        </x-contentful::dropdown>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <div class="prose text-gray-900">
                    {!! $post->html !!}
                </div>
            </div>

            @if ($post->tags->count() > 1)
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                All tags
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <ul class="leading-8">
                                    @foreach ($post->tags as $tag)
                                        <li class="inline">
                                            <div class="relative inline-flex items-center rounded-full border border-gray-300 px-3 py-0.5">
                                                <div class="text-sm font-medium text-gray-900">{{ $tag->name }}</div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
            @endif
        </div>
    </div>
</div>

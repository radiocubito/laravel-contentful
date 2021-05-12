<div class="py-10">
    <header>
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        {{ __('Posts') }}
                    </h1>
                </div>

                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <x-wordful::button.primary href="{{ route('wordful.posts.create') }}">
                        {{ __('Create post') }}
                    </x-wordful::button.primary>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 py-8 sm:px-0">
                <div class="rounded-lg bg-white overflow-hidden border">
                    <div class="p-6">
                        @if ($posts->count() > 0)
                            @if ($draftCount === 1)
                                <div class="text-center mb-6">
                                    <x-wordful::link href="{{ route('wordful.posts.edit', $firstDraft) }}">{{ __('Continue writing your draft…') }}</x-wordful::link>
                                </div>
                            @elseif ($draftCount > 1)
                                <div class="text-center mb-6">
                                    <x-wordful::link href="{{ route('wordful.posts.drafts.index') }}">{{ __('Continue writing your draft…', ['draftCount', $draftCount]) }}</x-wordful::link>
                                </div>
                            @endif

                            <div class="flow-root">
                                <ul class="-my-5 divide-y divide-gray-200">
                                    @foreach ($posts as $post)
                                        <li class="py-5">
                                            <div class="relative focus-within:ring-2 focus-within:ring-primary-500">
                                                <div class="flex justify-between space-x-3">
                                                    <div class="min-w-0 flex-1">
                                                        <h3 class="text-lg font-semibold text-gray-800">
                                                            <a href="{{ route('wordful.posts.show', $post) }}" class="hover:underline focus:outline-none">
                                                                <!-- Extend touch target to entire panel -->
                                                                <span class="absolute inset-0" aria-hidden="true"></span>
                                                                {{ $post->title }}
                                                            </a>
                                                        </h3>

                                                        <p class="text-sm text-gray-500 truncate">
                                                            {{ __('By') }} <span class="font-medium">{{ $post->author->name }}</span>
                                                            @if ($post->tags->count() > 0)
                                                                {{ __('in') }}
                                                                @foreach ($post->tags as $tag)
                                                                    <span class="font-medium">{{ $tag->name }}</span>@unless ($loop->last)<span aria-hidden="true">,</span> @endunless
                                                                @endforeach
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <time datetime="{{ optional($post->created_at)->format('Y-m-d') }}" class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">{{ optional($post->created_at)->format('F j, Y') }}</time>
                                                </div>

                                                <p class="mt-1 text-sm text-gray-700 line-clamp-2">
                                                    {{ $post->excerpt }}
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            @if ($posts->hasPages())
                                <div class="mt-6">
                                    {{ $posts->links() }}
                                </div>
                            @endif
                        @else
                            <div class="flex items-center flex-col justify-center" style="min-height: 60vh;">
                                <p class="text-gray-500">{{ __('No published posts.') }}</p>

                                @if ($draftCount === 1)
                                    <div>
                                        <x-wordful::link href="{{ route('wordful.posts.edit', $firstDraft) }}">{{ __('Continue writing your draft') }}</x-wordful::link>
                                    </div>

                                    <div class="text-gray-500">
                                        {{ __('Or,') }}
                                        <x-wordful::link href="{{ route('wordful.posts.create') }}">{{ __('create a new post') }}</x-wordful::link>
                                    </div>
                                @elseif ($draftCount > 1)
                                    <div>
                                        <x-wordful::link href="{{ route('wordful.posts.drafts.index') }}">{{ __('Continue writing :draftCount drafts', ['$draftCount' => $draftCount]) }}</x-wordful::link>
                                    </div>

                                    <div class="text-gray-500">
                                        {{ __('Or,') }}
                                        <x-wordful::link href="{{ route('wordful.posts.create') }}">{{ __('create a new post') }}</x-wordful::link>
                                    </div>
                                @else
                                    <div>
                                        <x-wordful::link href="{{ route('wordful.posts.create') }}">{{ __('Create a new post') }}</x-wordful::link>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

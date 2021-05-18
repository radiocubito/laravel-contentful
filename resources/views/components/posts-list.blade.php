@props(['groupedPosts'])

<x-wordful::page-heading>
    <x-slot name="heading">
        <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
            {{ __('Posts') }}
        </h1>
    </x-slot>

    <x-slot name="actions">
        <x-wordful::button color="secondary" href="{{ route('wordful.posts.create') }}">
            <span class="-ml-1 mr-0.5 ">
                <x-wordful::icon.new class="h-4 w-4" />
            </span>
            {{ __('Post') }}
        </x-wordful::button>
    </x-slot>
</x-wordful::page-heading>

<!-- Posts list (only on smallest breakpoint) -->
<div class="mt-3 sm:hidden space-y-3">
    @foreach ($groupedPosts as $postGroup)
        <div class="px-4 sm:px-6">
            <h2 class="text-gray-500 text-sm leading-4 font-medium">{{ $postGroup['sectionTitle'] }}</h2>
        </div>

        <ul class="border-t border-gray-200 divide-y divide-gray-100" x-max="1">
            @foreach ($postGroup['posts'] as $post)
                <li>
                    <a href="{{ route('wordful.posts.show', $post) }}" class="group flex items-center justify-between px-4 py-3 hover:bg-gray-50 sm:px-6">
                        <span class="flex items-center truncate space-x-3">
                            <span class="font-medium truncate text-sm leading-6">
                                {{ $post->title }}
                                <!-- space -->
                                @if ($post->tags->count() > 0)
                                    <span class="truncate font-normal text-gray-500">
                                        {{ __('in') }}

                                        @foreach ($post->tags as $tag)
                                            <span>{{ $tag->name }}</span>@unless ($loop->last)<span aria-hidden="true">,</span> @endunless
                                        @endforeach
                                    </span>
                                @endif
                            </span>
                        </span>
                        <svg class="ml-4 h-4 w-4 text-gray-400 group-hover:text-gray-500" x-description="Heroicon name: solid/chevron-right" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </li>
            @endforeach
        </ul>
    @endforeach
</div>

<!-- Posts table (small breakpoint and up) -->
<div class="hidden sm:block">
    <div class="align-middle inline-block min-w-full border-b border-gray-200">
        @foreach ($groupedPosts as $postGroup)
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500" colspan="4">
                            <span class="lg:pl-2">{{ $postGroup['sectionTitle'] }}</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100" x-max="1">
                    @foreach ($postGroup['posts'] as $post)
                        <tr>
                            <td class="px-6 py-3 max-w-0 w-full whitespace-nowrap text-sm font-medium text-gray-900">
                                <div class="flex items-center space-x-3 lg:pl-2">
                                    <a href="{{ route('wordful.posts.show', $post) }}" class="truncate hover:text-gray-600">
                                        <span>
                                            {{ $post->title }}
                                            <!-- space -->
                                            @if ($post->tags->count() > 0)
                                                <span class="text-gray-500 font-normal">
                                                    {{ __('in') }}

                                                    @foreach ($post->tags as $tag)
                                                        <span>{{ $tag->name }}</span>@unless ($loop->last)<span aria-hidden="true">,</span> @endunless
                                                    @endforeach
                                                </span>
                                            @endif
                                        </span>
                                    </a>
                                </div>
                            </td>
                            <td class="hidden md:table-cell px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                {{ optional($post->created_at)->format('F j, Y') }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500 font-medium">
                                <div class="flex items-center space-x-2">
                                    <img class="max-w-none h-5 w-5 rounded-full ring-2 ring-white" src="{{ Auth::user()->profile_photo_url }}">
                                </div>
                            </td>
                            <td class="pr-6">
                                <x-wordful::dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <x-wordful::button.options type="button" />
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-wordful::dropdown.link :href="route('wordful.posts.edit', $post)">
                                            {{ __('Edit') }}
                                        </x-wordful::dropdown.link>

                                        <x-wordful::dropdown.link :href="route('wordful.posts.settings', $post)">
                                            {{ __('Settings') }}
                                        </x-wordful::dropdown.link>
                                    </x-slot>
                                </x-wordful::dropdown>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
</div>

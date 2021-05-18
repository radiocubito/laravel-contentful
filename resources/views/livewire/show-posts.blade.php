<x-wf-dashboard>
    <x-slot name="sidebar">
        <x-wordful::sidebar-navigation />
    </x-slot>

    <x-slot name="header">
        <x-wordful::navbar />
    </x-slot>

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

    <x-wordful::posts-list :listTitle="__('Draft')" :posts="$draftPosts" />

    <x-wordful::posts-list :listTitle="__('Published')" :posts="$publishedPosts" />
</x-wf-dashboard>

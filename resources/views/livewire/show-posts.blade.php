<div>
    <x-wordful::page-heading>
        <x-slot name="heading">
            <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
                Posts
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

    <div class="mt-3 sm:hidden space-y-3">
        <x-wordful::posts-list :heading="__('Drafts')" :posts="$draftPosts" />

        <x-wordful::posts-list :heading="__('Published')" :posts="$publishedPosts" />
    </div>

    <div class="hidden sm:block">
        <div class="align-middle inline-block min-w-full border-b border-gray-200">
            <x-wordful::posts-table :heading="__('Drafts')" :posts="$draftPosts" />

            <x-wordful::posts-table :heading="__('Published')" :posts="$publishedPosts" />
        </div>
    </div>
</div>

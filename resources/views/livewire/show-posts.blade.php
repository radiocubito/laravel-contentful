<div>
    <x-wordful::page-heading>
        <x-slot name="heading">
            <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
                Posts
            </h1>
        </x-slot>

        <x-slot name="actions">
            <a href="{{ route('wordful.posts.create') }}" class="order-0 inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded text-gray-700 bg-gray-100 hover:bg-gray-200">
                <svg class="-ml-1 mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Post
            </a>
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

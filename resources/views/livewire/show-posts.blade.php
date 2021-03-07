<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="pb-5 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
            <h1 class="text-3xl leading-6 font-bold text-gray-900">
                {{ __('Posts') }}
            </h1>
            <div class="mt-3 sm:mt-0 sm:ml-4">
                <a href="{{ route('contentful.posts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Create post') }}
                </a>
            </div>
        </div>

        @if ($draftCount === 1)
            <div class="mt-5 text-center"><a href="{{ route('contentful.posts.edit', $firstDraft) }}" class="font-medium text-indigo-600 hover:text-indigo-500 underline">Continue writing your draft…</a></div>
        @elseif ($draftCount > 1)
            <div class="mt-5 text-center"><a href="{{ route('contentful.posts.drafts.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500 underline">Continue writing {{ $draftCount }} drafts…</a></div>
        @endif

        <ul class="divide-y divide-gray-200 mt-5" x-max="1">
            @foreach ($posts as $post)
                <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                    <div class="flex justify-between space-x-3">
                        <div class="min-w-0 flex-1">
                            <a href="{{ route('contentful.posts.show', $post) }}" class="block focus:outline-none">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                <p class="text-lg font-bold text-gray-900 truncate">{{ $post->title }}</p>
                                <!-- <p class="text-base text-gray-500 truncate">Author name</p> -->
                            </a>
                        </div>
                        <time datetime="2021-01-27T16:35" class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">{{ optional($post->created_at)->format('F j, Y') }}</time>
                    </div>
                    <div class="mt-1">
                        <p class="line-clamp-2 text-base text-gray-600">
                            {{ $post->excerpt }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

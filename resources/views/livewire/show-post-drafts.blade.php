<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:px-6 sm:flex sm:items-center sm:justify-between">
                <h1 class="text-3xl leading-6 font-bold text-gray-900">
                    {{ __('Post drafs') }}
                </h1>
            </div>

            <div class="border-t border-gray-200">
                <ul class="divide-y divide-gray-200" x-max="1">
                    @foreach ($posts as $post)
                        <li class="relative bg-white px-4 py-5 sm:px-6 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a href="{{ route('contentful.posts.show', $post) }}" class="block focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-lg font-bold text-gray-900 truncate">{{ $post->title }}</p>
                                        <p class="text-base text-gray-500 truncate font-medium">{{ $post->author->name }}</p>
                                    </a>
                                </div>
                                <time datetime="2021-01-27T16:35" class="flex-shrink-0 whitespace-nowrap text-base text-gray-500">{{ optional($post->created_at)->format('F j, Y') }}</time>
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
    </div>
</div>

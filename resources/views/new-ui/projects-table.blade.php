<div class="hidden sm:block">
    <div class="align-middle inline-block min-w-full border-b border-gray-200">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500" colspan="4">
                        <span class="lg:pl-2">Drafts</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100" x-max="1">
                @foreach ($draftPosts as $post)
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
                            <div x-data="{ open: false }" @keydown.escape="open = false" @click.away="open = false" class="relative flex justify-end items-center">
                                <button id="project-options-menu-0" aria-haspopup="true" :aria-expanded="open" type="button" @click="open = !open" class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    <span class="sr-only">Open options</span>
                                    <svg class="w-4 h-4" x-description="Heroicon name: solid/dots-vertical" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                    </svg>
                                </button>
                                <transition enter-active-class="transition ease-out duration-100" enter-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                    <div x-show="open" x-description="Dropdown panel, show/hide based on dropdown state." class="mx-3 origin-top-right absolute right-7 top-0 w-48 mt-1 rounded shadow-lg z-10 bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200" role="menu" aria-orientation="vertical" aria-labelledby="project-options-menu-0">
                                        <div class="py-1" role="none">
                                            <a href="{{ route('wordful.posts.edit', $post) }}" class="group flex items-center px-4 py-2 text-sm leading-4 text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                                <svg class="mr-3 h-4 w-4 text-gray-400 group-hover:text-gray-500" x-description="Heroicon name: solid/pencil-alt" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <a href="{{ route('wordful.posts.settings', $post) }}" class="group flex items-center px-4 py-2 text-sm leading-4 text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                                <svg class="mr-3 h-4 w-4 text-gray-400 group-hover:text-gray-500" x-description="Heroicon name: solid/duplicate" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z"></path>
                                                    <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z"></path>
                                                </svg>
                                                Settings
                                            </a>
                                        </div>
                                    </div>
                                </transition>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500" colspan="4">
                        <span class="lg:pl-2">Published</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100" x-max="1">
                @foreach ($publishedPosts as $post)
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
                            <div x-data="{ open: false }" @keydown.escape="open = false" @click.away="open = false" class="relative flex justify-end items-center">
                                <button id="project-options-menu-0" aria-haspopup="true" :aria-expanded="open" type="button" @click="open = !open" class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    <span class="sr-only">Open options</span>
                                    <svg class="w-4 h-4" x-description="Heroicon name: solid/dots-vertical" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                    </svg>
                                </button>
                                <transition enter-active-class="transition ease-out duration-100" enter-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                    <div x-show="open" x-description="Dropdown panel, show/hide based on dropdown state." class="mx-3 origin-top-right absolute right-7 top-0 w-48 mt-1 rounded shadow-lg z-10 bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200" role="menu" aria-orientation="vertical" aria-labelledby="project-options-menu-0">
                                        <div class="py-1" role="none">
                                            <a href="{{ route('wordful.posts.edit', $post) }}" class="group flex items-center px-4 py-2 text-sm leading-4 text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                                <svg class="mr-3 h-4 w-4 text-gray-400 group-hover:text-gray-500" x-description="Heroicon name: solid/pencil-alt" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <a href="{{ route('wordful.posts.settings', $post) }}" class="group flex items-center px-4 py-2 text-sm leading-4 text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                                <svg class="mr-3 h-4 w-4 text-gray-400 group-hover:text-gray-500" x-description="Heroicon name: solid/duplicate" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z"></path>
                                                    <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z"></path>
                                                </svg>
                                                Settings
                                            </a>
                                        </div>
                                    </div>
                                </transition>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

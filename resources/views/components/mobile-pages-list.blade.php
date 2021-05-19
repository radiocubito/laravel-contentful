@props(['listTitle', 'pages'])

@if (count($pages) > 0)
    <div class="space-y-3">
        <div class="px-4 sm:px-6">
            <h2 class="text-gray-500 text-sm leading-4 font-medium">{{ $listTitle }}</h2>
        </div>

        <ul class="border-t border-gray-200 divide-y divide-gray-100" x-max="1">
            @foreach ($pages as $page)
                <li>
                    <a href="{{ route('wordful.pages.show', $page) }}" class="group flex items-center justify-between px-4 py-3 hover:bg-gray-50 sm:px-6">
                        <span class="flex items-center truncate space-x-3">
                            <span class="font-medium truncate text-sm leading-6">
                                {{ $page->title }}
                                <!-- space -->
                                @if ($page->tags->count() > 0)
                                    <span class="truncate font-normal text-gray-500">
                                        {{ __('in') }}

                                        @foreach ($page->tags as $tag)
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
    </div>
@endif

@props(['listTitle', 'pages'])

@if (count($pages) > 0)
    <div class="hidden sm:block">
        <div class="align-middle inline-block min-w-full border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-sm font-medium text-gray-500" colspan="3">
                            <span class="lg:pl-2">{{ $listTitle }}</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100" x-max="1">
                    @foreach ($pages as $page)
                        <tr>
                            <td class="px-6 py-3 max-w-0 w-full whitespace-nowrap text-sm font-medium text-gray-900">
                                <div class="flex items-center space-x-3 lg:pl-2">
                                    <a href="{{ route('wordful.pages.show', $page) }}" class="truncate hover:text-gray-600">
                                        <span>
                                            {{ $page->title }}
                                            <!-- space -->
                                            @if ($page->tags->count() > 0)
                                                <span class="text-gray-500 font-normal">
                                                    {{ __('in') }}

                                                    @foreach ($page->tags as $tag)
                                                        <span>{{ $tag->name }}</span>@unless ($loop->last)<span aria-hidden="true">,</span> @endunless
                                                    @endforeach
                                                </span>
                                            @endif
                                        </span>
                                    </a>
                                </div>
                            </td>
                            <td class="hidden md:table-cell px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                {{ optional($page->created_at)->format('F j, Y') }}
                            </td>
                            <td class="pr-6">
                                <x-wordful::dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <x-wordful::button.options type="button" />
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-wordful::dropdown.link :href="route('wordful.pages.edit', $page)">
                                            {{ __('Edit') }}
                                        </x-wordful::dropdown.link>

                                        <x-wordful::dropdown.link :href="route('wordful.pages.settings', $page)">
                                            {{ __('Settings') }}
                                        </x-wordful::dropdown.link>
                                    </x-slot>
                                </x-wordful::dropdown>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 sm:hidden">
        <x-wordful::mobile-pages-list :listTitle="$listTitle" :pages="$pages" />
    </div>
@endif

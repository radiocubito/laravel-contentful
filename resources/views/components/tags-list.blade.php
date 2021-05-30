@if (count($tags) > 0)
    <div class="hidden sm:block">
        <div class="align-middle inline-block min-w-full border-b border-gray-200">
            <table class="min-w-full">
                <tbody class="bg-white divide-y divide-gray-100" x-max="1">
                    @foreach ($tags as $tag)
                        <tr>
                            <td class="px-6 py-3 max-w-0 w-full whitespace-nowrap text-sm font-medium text-gray-900">
                                <div class="flex items-center space-x-3 lg:pl-2">
                                    <a href="{{ route('wordful.tags.edit', $tag) }}" class="truncate hover:text-gray-600">
                                        <span>
                                            {{ $tag->name }}
                                        </span>
                                    </a>
                                </div>
                            </td>
                            <td class="hidden md:table-cell px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-right">
                                {{ $tag->slug }}
                            </td>
                            <td class="pr-6">
                                <x-wordful::dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <x-wordful::button.options type="button" />
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-wordful::dropdown.link :href="route('wordful.tags.edit', $tag)">
                                            {{ __('Edit') }}
                                        </x-wordful::dropdown.link>
                                        <x-wordful::dropdown.link
                                            :href="route('wordful.tags.index')"
                                            onclick="event.preventDefault();
                                                confirm('{{ __('Are you sure you want to delete this tag?') }}') || event.stopImmediatePropagation();"
                                            wire:click="deleteTag({{ $tag->id }})"
                                        >
                                            {{ __('Delete') }}
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
        <x-wordful::mobile-tags-list :tags="$tags" />
    </div>
@endif

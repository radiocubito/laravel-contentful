@props([
    'links' => [
        [__('Posts'), route('wordful.posts.index'), 'wordful::icon.post', request()->routeIs('wordful.posts.*')],
        [__('Pages'), route('wordful.pages.index'), 'wordful::icon.page', request()->routeIs('wordful.pages.*')],
        [__('Tags'), route('wordful.tags.index'), 'wordful::icon.tag', request()->routeIs('wordful.tags.*')],
    ]
])

<div class="hidden lg:flex lg:flex-shrink-0">
    <div class="flex flex-col w-56 border-r border-gray-200 pt-5 pb-4 bg-gray-100">
        <div class="relative" x-data="{ profileOpen: false }" >
            <div class="flex items-center flex-shrink-0 px-3 justify-between space-x-3">
                <div class="pl-1.5 flex items-center flex-1 overflow-hidden">
                    <img class="h-5 w-auto rounded" src="{{ config('site.logo') }}" alt="{{ config('app.name') }}">
                    <span class="text-sm leading-4 font-medium ml-2.5 whitespace-nowrap overflow-hidden overflow-ellipsis">{{ config('app.name') }}</span>
                </div>

                <div @keydown.escape="profileOpen = false" @click.away="profileOpen = false" class="relative inline-block text-left">
                    <button @click="profileOpen = !profileOpen" type="button" class="group bg-gray-100 rounded p-1.5 border border-transparent text-sm leading-4 font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-primary-500">
                        <span class="flex items-center space-x-2">
                            <span class="min-w-0">
                                <img class="w-5 h-5 bg-gray-300 rounded-full flex-shrink-0" src="{{ Auth::user()->profile_photo_url }}">
                            </span>
                            <svg class="flex-shrink-0 h-4 w-4 text-gray-400 group-hover:text-gray-500" x-description="Heroicon name: solid/selector" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                </div>
            </div>

            <div x-show="profileOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    style="display: none;"
                    class="z-10 mx-3 origin-top absolute right-0 left-0 mt-1 rounded shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200">
                <div class="py-1">
                    @if (\Radiocubito\Wordful\Wordful::hasAuthenticationFeature())
                        <livewire:wordful::auth.logout-link />
                    @elseif (Route::has('logout'))
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-wordful::dropdown.link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log out') }}
                            </x-wordful::dropdown.link>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="h-0 flex-1 flex flex-col overflow-y-auto">
            <div class="px-3 mt-5">
                <a href="{{ route('wordful.posts.create') }}" class="flex items-center px-2 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                    <x-wordful::icon.new-post class="text-gray-500 mr-3 h-4 w-4" />
                    {{ __('New post') }}
                </a>
            </div>

            <!-- Navigation -->
            <nav class="px-3 mt-6">
                <div class="space-y-1">
                    @foreach ($links as list($title, $link, $icon, $active))
                        <a
                            href="{{ $link }}"
                            class="{{ $active ? 'bg-gray-200 text-gray-900' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50' }} group flex items-center px-2 py-2 text-sm leading-4 font-medium rounded"
                        >
                            <x-dynamic-component
                                :component="$icon"
                                class="{{ $active ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }} mr-3 h-4 w-4"
                            />
                            {{ $title }}
                        </a>
                    @endforeach
                </div>
            </nav>
        </div>
    </div>
</div>

<div x-show="sidebarOpen" class="lg:hidden" x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state.">
    <x-wordful::mobile-menu :links="$links" />
</div>

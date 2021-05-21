<div class="fixed inset-0 flex z-40">
    <div @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-show="sidebarOpen"
            class="fixed inset-0">
        <div class="absolute inset-0 bg-transparent"></div>
    </div>

    <div x-show="sidebarOpen"
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="relative flex-1 flex flex-col w-full pt-5 pb-4 border-r border-gray-200 bg-gray-100" style="max-width: 14rem;">
        <div class="absolute top-0 right-0 -mr-12 pt-2">
            <button x-show="sidebarOpen" @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                <svg class="h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="flex-shrink-0 flex items-center pl-4 pr-2">
            <div class="relative" x-data="{ profileOpen: false }" >
                <div class="flex items-center flex-shrink-0 justify-between space-x-3">
                    <div class="flex items-center flex-1 overflow-hidden">
                        <img class="h-5 w-auto rounded" src="{{ config('site.logo') }}" alt="{{ config('app.name') }}">
                        <span class="text-sm leading-4 font-medium ml-2.5 whitespace-nowrap overflow-hidden overflow-ellipsis">{{ config('app.name') }}</span>
                    </div>

                    <div @keydown.escape="profileOpen = false" @click.away="profileOpen = false" class="relative inline-block text-left">
                        <button @click="profileOpen = !profileOpen" type="button" class="group bg-gray-100 rounded p-1.5 border border-transparent text-sm leading-4 font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-primary-500">
                            <span class="flex items-center space-x-2">
                                <span class="min-w-0">
                                    <img class="w-5 h-5 bg-gray-300 rounded-full flex-shrink-0" src="{{ Auth::user()->profile_photo_url }}">
                                </span>
                                <svg class="flex-shrink-0 h-4 w-4 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor">
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
        </div>
        <div class="px-2 mt-5">
            <a href="{{ route('wordful.posts.create') }}" class="flex items-center px-2 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                <x-wordful::icon.new-post class="text-gray-500 mr-3 h-4 w-4" />
                {{ __('New post') }}
            </a>
        </div>
        <div class="mt-5 flex-1 h-0 overflow-y-auto">
            <nav class="px-2">
                <div class="space-y-0.5">
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

            @if (\Radiocubito\Wordful\Wordful::hasAuthenticationFeature())
                <div class="px-3 mt-8">
                    <!-- Settings navigation -->
                    <h3 class="px-2 text-xs font-medium text-gray-500"">
                        {{ __('Settings') }}
                    </h3>
                    <div class="mt-1 space-y-0.5">
                        @foreach ($settingsLinks as list($title, $link, $active))
                            <a
                                href="{{ $link }}"
                                class="{{ $active ? 'bg-gray-200 text-gray-900' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50' }} group flex items-center px-2 py-2 text-sm leading-4 font-medium rounded"
                            >
                                {{ $title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="flex-shrink-0 w-14"><!-- Dummy element to force sidebar to shrink to fit close icon --></div>
</div>

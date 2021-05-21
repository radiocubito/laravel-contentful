<div class="relative z-10 flex-shrink-0 flex h-14 bg-white border-b border-gray-200 lg:hidden">
    <button x-description="Sidebar toggle, controls the 'sidebarOpen' sidebar state." @click.stop="sidebarOpen = true" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500 lg:hidden">
        <span class="sr-only">{{ __('Open sidebar') }}</span>
        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
        </svg>
    </button>
    <div class="flex-1 flex justify-end px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-3">
            <x-wordful::dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="max-w-xs bg-white hover:bg-gray-200 flex items-center text-sm rounded p-1.5 border border-transparent focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-ou">
                        <span class="sr-only">{{ __('Open user menu') }}</span>
                        <img class="h-5 w-5 rounded-full" src="{{ Auth::user()->profile_photo_url }}">

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
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
                </x-slot>
            </x-wordful::dropdown>
        </div>
    </div>
</div>

<div class="relative z-10 flex-shrink-0 flex h-14 bg-white border-b border-gray-200 lg:hidden">
    <button x-description="Sidebar toggle, controls the 'sidebarOpen' sidebar state." @click.stop="sidebarOpen = true" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500 lg:hidden">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
        </svg>
    </button>
    <div class="flex-1 flex justify-end px-4 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <!-- Profile dropdown -->
            <div @click.away="open = false" class="ml-3 relative" x-data="{ open: false }">
                <div>
                    <button @click="open = !open" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" id="user-menu" aria-haspopup="true" x-bind:aria-expanded="open">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-5 w-5 rounded-full" src="{{ Auth::user()->profile_photo_url }}">
                    </button>
                </div>
                <transition enter-active-class="transition ease-out duration-100" enter-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                    <div x-show="open" x-description="Profile dropdown panel, show/hide based on dropdown state." class="origin-top-right absolute right-0 mt-2 w-48 rounded shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                        <div class="py-1" role="none">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Logout</a>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</div>

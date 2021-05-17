<div class="hidden lg:flex lg:flex-shrink-0">
    <div class="flex flex-col w-56 border-r border-gray-200 pt-5 pb-4 bg-gray-100">
        <div class="relative" x-data="{ profileOpen: false }" >
            <div class="flex items-center flex-shrink-0 px-3 justify-between space-x-3">
                <div class="pl-1.5 flex items-center flex-1 overflow-hidden">
                    <img class="h-5 w-auto rounded" src="{{ config('site.logo') }}" alt="{{ config('app.name') }}">
                    <span class="text-sm leading-4 font-medium ml-2.5 whitespace-nowrap overflow-hidden overflow-ellipsis">{{ config('app.name') }}</span>
                </div>

                <!-- User account dropdown -->
                <div @keydown.escape="profileOpen = false" @click.away="profileOpen = false" class="relative inline-block text-left">
                    <div x-description="Dropdown menu toggle, controlling the show/hide state of dropdown menu.">
                        <button @click="profileOpen = !profileOpen" type="button" class="group bg-gray-100 rounded px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-gray-500" id="options-menu" aria-haspopup="true" aria-expanded="true" x-bind:aria-expanded="profileOpen">
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
            </div>

            <transition enter-active-class="transition ease-out duration-100" enter-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                <div x-show="profileOpen" x-description="Dropdown panel, show/hide based on dropdown state." class="z-10 mx-3 origin-top absolute right-0 left-0 mt-1 rounded shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Logout</a>
                    </div>
                </div>
            </transition>
        </div>

        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="h-0 flex-1 flex flex-col overflow-y-auto">
            <div class="px-3 mt-5">
                <a href="{{ route('wordful.posts.create') }}" class="flex items-center px-2 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="text-gray-500 mr-3 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                    </svg>
                    New post
                </a>
            </div>
            <!-- Navigation -->
            <nav class="px-3 mt-6">
                <div
                    class="space-y-1">
                    <!-- Current: "bg-gray-200 text-gray-900", Default: "text-gray-700 hover:text-gray-900 hover:bg-gray-50" -->
                    <a href="{{ route('wordful.posts.index') }}" class="bg-gray-200 text-gray-900 group flex items-center px-2 py-2 text-sm leading-4 font-medium rounded">
                        <!-- Current: "text-gray-500", Default: "text-gray-400 group-hover:text-gray-500" -->
                        <svg class="text-gray-500 mr-3 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                            <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                        </svg>
                        Posts
                    </a>
                    <a href="{{ route('wordful.pages.index') }}" class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm leading-4 font-medium rounded">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                        </svg>
                        Pages
                    </a>
                    <a href="{{ route('wordful.tags.index') }}" class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm leading-4 font-medium rounded">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                        Tags
                    </a>
                </div>
            </nav>
        </div>
    </div>
</div>

<div class="fixed inset-0 flex z-40">
    <transition enter-active-class="transition-opacity ease-linear duration-300" enter-class="opacity-0" enter-to-class="opacity-100" leave-active-class="transition-opacity ease-linear duration-300" leave-class="opacity-100" leave-to-class="opacity-0">
        <div @click="sidebarOpen = false" x-show="sidebarOpen" x-description="Off-canvas menu overlay, show/hide based on off-canvas menu state." class="fixed inset-0" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
        </div>
    </transition>
    <transition enter-active-class="transition ease-in-out duration-300 transform" enter-class="-translate-x-full" enter-to-class="translate-x-0" leave-active-class="transition ease-in-out duration-300 transform" leave-class="translate-x-0" leave-to-class="-translate-x-full">
        <div x-show="sidebarOpen" x-description="Off-canvas menu, show/hide based on off-canvas menu state." class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white">
            <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button x-show="sidebarOpen" @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="h-6 w-6 text-white" x-description="Heroicon name: outline/x" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="flex-shrink-0 flex items-center px-4">
                <div class="flex items-center">
                    <img class="h-5 w-auto rounded" src="{{ config('site.logo') }}" alt="{{ config('app.name') }}">
                    <span class="text-sm leading-4 font-medium ml-2.5 whitespace-nowrap overflow-hidden overflow-ellipsis">{{ config('app.name') }}</span>
                </div>
            </div>
            <div class="mt-5 flex-1 h-0 overflow-y-auto">
                <nav class="px-2">
                    <div class="space-y-1">
                        @foreach ($links as list($title, $link, $icon, $active))
                            <a
                                href="{{ $link }}"
                                class="{{ $active ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} group flex items-center px-2 py-2 text-sm leading-4 font-medium rounded"
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
    </transition>
    <div class="flex-shrink-0 w-14" aria-hidden="true"><!-- Dummy element to force sidebar to shrink to fit close icon --></div>
</div>

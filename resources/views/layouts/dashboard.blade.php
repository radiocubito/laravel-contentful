<div class="font-sans antialiased h-screen flex overflow-hidden bg-white" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">
    {{ $sidebar ?? null }}

    <!-- Main column -->
    <div class="flex flex-col w-0 flex-1 overflow-hidden">
        {{ $header ?? null }}

        <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0" x-data="" x-init="$el.focus()">
            {{ $slot }}
        </main>
    </div>
</div>

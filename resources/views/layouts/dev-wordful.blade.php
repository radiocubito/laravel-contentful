<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('vendor/wordful/css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Alpine -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

        @livewireStyles
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@1.2.3/dist/trix.css">
    </head>
    <body class="font-sans antialiased">
        <div style="min-height: 640px;">
            <div class="h-screen flex overflow-hidden bg-white" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">
                @include('wordful::new-ui.sidebar.mobile')

                @include('wordful::new-ui.sidebar.desktop')

                <!-- Main column -->
                <div class="flex flex-col w-0 flex-1 overflow-hidden">
                    @include('wordful::new-ui.search-header')

                    <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0" x-data="" x-init="$el.focus()">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>

        @livewireScripts
        <script src="https://unpkg.com/trix@1.2.3/dist/trix.js"></script>
    </body>
</html>

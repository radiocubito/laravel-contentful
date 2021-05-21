@props(['href' => null])

@php
$hyperscript = $href ? 'a' : 'button';
@endphp

<span class="inline-flex rounded">
    <{{ $hyperscript }} {{ $attributes->merge(['type' => $href ? null : 'submit', 'href' => $href, 'class' => "inline-flex items-center p-2 border rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 border-transparent text-gray-500 bg-white hover:bg-gray-200"]) }}>
        <span class="sr-only">{{ ('Settings') }}</span>
        <x-wordful::icon.settings class="h-4 w-4" />
    </{{ $hyperscript }}>
</span>

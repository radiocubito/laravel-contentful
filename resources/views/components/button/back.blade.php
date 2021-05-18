@props(['href' => null])

@php
$hyperscript = $href ? 'a' : 'button';
@endphp

<span class="inline-flex">
    <{{ $hyperscript }} {{ $attributes->merge(['type' => $href ? null : 'submit', 'href' => $href, 'class' => "text-gray-500"]) }}>
        <span class="sr-only">{{ ('Back') }}</span>
        <x-wordful::icon.back class="h-6 w-6" />
    </{{ $hyperscript }}>
</span>

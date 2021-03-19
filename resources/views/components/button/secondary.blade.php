@props(['href' => null])

@php
$hyperscript = $href ? 'a' : 'button';
@endphp

<{{ $hyperscript }} {{ $attributes->merge(['type' => $href ? null : 'submit', 'href' => $href, 'class' => 'inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500']) }}>
    {{ $slot }}
</{{ $hyperscript }}>

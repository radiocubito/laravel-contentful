@props(['href' => null])

@php
$hyperscript = $href ? 'a' : 'button';
@endphp

<{{ $hyperscript }} {{ $attributes->merge(['type' => $href ? null : 'submit', 'href' => $href, 'class' => 'inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500']) }}>
    {{ $slot }}
</{{ $hyperscript }}>

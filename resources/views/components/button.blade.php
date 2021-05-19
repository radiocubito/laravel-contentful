@props(['href' => null, 'color' => 'primary'])

@php
$hyperscript = $href ? 'a' : 'button';

switch ($color) {
    case 'transparent':
        $colorClasses = 'border-transparent text-gray-700 bg-transparent hover:bg-gray-200';
        $shadow = false;
        break;
    case 'white':
        $colorClasses = 'border-gray-300 text-gray-700 bg-white hover:bg-gray-200';
        $shadow = true;
        break;
    case 'secondary':
        $colorClasses = 'border-gray-300 text-gray-700 bg-gray-100 hover:bg-gray-200';
        $shadow = true;
        break;
    case 'primary':
    default:
        $colorClasses = 'border-transparent text-white bg-primary-600 hover:bg-primary-700';
        $shadow = true;
        break;
}
@endphp

<span class="inline-flex rounded {{ $shadow ? 'shadow-sm' : null}}">
    <{{ $hyperscript }} {{ $attributes->merge(['type' => $href ? null : 'submit', 'href' => $href, 'class' => "inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 $colorClasses"]) }}>
        {{ $slot }}
    </{{ $hyperscript }}>
</span>

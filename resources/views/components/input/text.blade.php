@props([
    'sharedBorder' => false,
    'leadingAddOn' => false,
])

@if ($sharedBorder)
    <input {!! $attributes->merge(['class' => 'focus:ring-transparent focus:border-transparent relative block w-full rounded-none bg-transparent focus:z-10 px-0']) !!}>
@else
    <div class="flex rounded">
        @if ($leadingAddOn)
            <span class="inline-flex items-center px-3 rounded-l border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm leading-4">
                {{ $leadingAddOn }}
            </span>
        @endif

        <input {{ $attributes->merge(['class' => 'flex-1 focus:ring-primary-500 focus:border-primary-500 text-sm py-1.5 border-gray-300 rounded' . ($leadingAddOn ? ' rounded-l-none' : '')]) }}">
    </div>
@endif

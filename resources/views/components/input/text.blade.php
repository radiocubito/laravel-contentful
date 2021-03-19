@props([
    'sharedBorder' => false,
    'leadingAddOn' => false,
])

@if ($sharedBorder)
    <input {!! $attributes->merge(['class' => 'focus:ring-transparent focus:border-transparent relative block w-full rounded-none bg-transparent focus:z-10 px-0']) !!}>
@else
    <div class="flex rounded">
        @if ($leadingAddOn)
            <span class="inline-flex items-center px-3 rounded-l border border-r-0 border-gray-300 bg-gray-100 text-gray-500 sm:text-sm">
                {{ $leadingAddOn }}
            </span>
        @endif

        <input {{ $attributes->merge(['class' => 'flex-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm border-gray-300 rounded' . ($leadingAddOn ? ' rounded-l-none' : '')]) }}">
    </div>
@endif

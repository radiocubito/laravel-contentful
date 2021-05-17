@props([
    'placeholder' => null,
    'leadingIcon' => null,
])

@if ($leadingIcon)
    <div class="relative rounded">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            {{ $leadingIcon }}
        </div>

        <select {{ $attributes->merge(['class' => 'focus:ring-primary-500 focus:border-primary-500 pl-10 text-sm leading-4 border-gray-300 rounded']) }}>
            @if ($placeholder)
                <option disabled value="">{{ $placeholder }}</option>
            @endif

            {{ $slot }}
        </select>
    </div>

@else
    <select {{ $attributes->merge(['class' => 'focus:ring-primary-500 focus:border-primary-500 text-sm leading-4 border-gray-300 rounded']) }}>
        @if ($placeholder)
            <option disabled value="">{{ $placeholder }}</option>
        @endif

        {{ $slot }}
    </select>
@endif

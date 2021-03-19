@props([
    'sharedBorder' => false
])

@if ($sharedBorder)
    <input {!! $attributes->merge(['class' => 'focus:ring-transparent focus:border-transparent relative block w-full rounded-none bg-transparent focus:z-10 px-0']) !!}>
@else
    <input {!! $attributes->merge(['class' => 'focus:ring-blue-500 focus:border-blue-500 relative block w-full rounded-none bg-transparent focus:z-10']) !!}>
@endif

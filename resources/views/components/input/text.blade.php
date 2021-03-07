@props([
    'sharedBorder' => false
])

@if ($sharedBorder)
    <input {!! $attributes->merge(['class' => 'focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-none bg-transparent focus:z-10']) !!}>
@else
    <input {!! $attributes->merge(['class' => 'focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-none bg-transparent focus:z-10']) !!}>
@endif

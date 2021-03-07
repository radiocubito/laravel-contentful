@props([
    'sharedBorder' => false
])

@if ($sharedBorder)
    <textarea
        x-data="{ resize: () => { $el.style.height = '52px'; $el.style.height = $el.scrollHeight + 'px' } }"
        x-init="resize()"
        @input="resize()"
        {!! $attributes->merge(['class' => 'focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-none bg-transparent focus:z-10']) !!}
    ></textarea>
@else
    <textarea {!! $attributes->merge(['class' => 'focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-none bg-transparent focus:z-10']) !!}></textarea>
@endif

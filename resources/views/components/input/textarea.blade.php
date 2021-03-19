@props([
    'sharedBorder' => false
])

@if ($sharedBorder)
    <textarea
        x-data="{ resize: () => { $el.style.height = '56px'; $el.style.height = $el.scrollHeight + 'px' } }"
        x-init="resize()"
        @input="resize()"
        {!! $attributes->merge(['class' => 'focus:ring-transparent focus:border-transparent relative block w-full rounded-none bg-transparent focus:z-10 px-0']) !!}
    ></textarea>
@else
    <textarea {!! $attributes->merge(['class' => 'focus:ring-blue-500 focus:border-blue-500 relative block w-full rounded-none bg-transparent focus:z-10']) !!}></textarea>
@endif

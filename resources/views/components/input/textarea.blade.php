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
    <textarea {!! $attributes->merge(['class' => 'focus:ring-primary-500 focus:border-primary-500 text-sm leading-4 border-gray-300 rounded-md']) !!}></textarea>
@endif

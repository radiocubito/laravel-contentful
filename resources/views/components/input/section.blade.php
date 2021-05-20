@props(['expandable' => false, 'clickExpression' => 'on = !on; $refs.switch.focus()'])

<div
    @if ($expandable)
        x-data="{ on: @entangle($attributes->wire('model')) }"
    @endif
    {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'space-y-6 sm:space-y-4']) }}
>
    @if (isset($heading))
        <div class="flex items-center justify-between">
            {{ $heading }}

            @if ($expandable)
                {{ $switch }}
            @endif
        </div>
    @endif

    <div
        @if ($expandable)
            x-show="on"
        @endif
        class="space-y-5 p-5 bg-gray-50 rounded border-gray-100 border"
    >
        {{ $content ?? $slot }}
    </div>
</div>

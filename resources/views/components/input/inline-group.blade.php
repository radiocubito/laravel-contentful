<div {{ $attributes->merge(['class' => 'sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start']) }}>
    <div class="sm:mt-px sm:pt-2">
        {{ $label }}
    </div>
    <div class="mt-1 sm:mt-0 sm:col-span-2">
        {{ $input ?? $slot }}
    </div>
</div>

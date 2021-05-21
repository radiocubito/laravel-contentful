<button
    {!! $attributes !!}
    type="button"
    class="bg-gray-200 relative inline-flex flex-shrink-0 h-5 w-8 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
    aria-pressed="false"
    x-state:on="Enabled"
    x-state:off="Not Enabled"
    :class="{ 'bg-primary-600': on, 'bg-gray-200': !(on) }"
    :aria-pressed="on.toString()"
>
    <span class="sr-only">{{ $slot }}</span>
    <span
        aria-hidden="true"
        class="translate-x-0 pointer-events-none inline-block h-4 w-4 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"
        x-state:on="Enabled"
        x-state:off="Not Enabled"
        :class="{ 'translate-x-3': on, 'translate-x-0': !(on) }"
    ></span>
</button>

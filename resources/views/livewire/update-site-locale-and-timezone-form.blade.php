<form wire:submit.prevent="save">
    <x-wordful::input.section>
        <x-slot name="heading">
            <div>
                <h2 class="text-sm font-medium text-gray-900">
                    {{ __('Time zone & language') }}
                </h2>
                <p class="text-sm leading-normal text-gray-500">{{ __('Set the timezone and locale/language of your site.') }}</p>
            </div>
        </x-slot>

        <x-wordful::input.inline-group>
            <x-slot name="label">
                <x-wordful::input.label for="name" value="{{ __('Locale') }}" />
            </x-slot>
            <x-wordful::input.text id="locale" type="text" class="block w-full max-w-lg sm:max-w-xs" wire:model.defer="state.locale" />
            <x-wordful::input.error for="state.locale" class="mt-2"/>
        </x-wordful::input.inline-group>

        <x-wordful::input.inline-group>
            <x-slot name="label">
                <x-wordful::input.label for="timezone" value="{{ __('Timezone') }}" />
            </x-slot>

            <x-wordful::input.select id="timezone" wire:model="timezone" class="max-w-xs block w-full">
                @foreach($timeZones as $optionValue => $label)
                    <option value="{{ $optionValue }}">
                        {{ $label }}
                    </option>
                @endforeach
            </x-wordful::input.select>
            <x-wordful::input.error for="state.timezone" class="mt-2"/>
        </x-wordful::input.inline-group>

        <x-wordful::input.section-actions>
            <x-wordful::button color="primary">
                {{ __('Save settings') }}
            </x-wordful::button>
        </x-wordful::input.section-actions>
    </x-wordful::input.section>
</form>

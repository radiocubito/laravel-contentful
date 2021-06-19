<form wire:submit.prevent="save">
    <x-wordful::input.section>
        <x-slot name="heading">
            <div>
                <h2 class="text-sm font-medium text-gray-900">
                    {{ __('Title & description') }}
                </h2>
                <p class="text-sm leading-normal text-gray-500">{{ __('The details used to identify your site around the web.') }}</p>
            </div>
        </x-slot>

        <x-wordful::input.inline-group>
            <x-slot name="label">
                <x-wordful::input.label for="name" value="{{ __('Site name') }}" />
            </x-slot>
            <x-wordful::input.text id="name" type="text" class="block w-full max-w-lg sm:max-w-xs" wire:model.defer="state.name" />
            <x-wordful::input.error for="state.name" class="mt-2"/>
        </x-wordful::input.inline-group>

        <x-wordful::input.inline-group>
            <x-slot name="label">
                <x-wordful::input.label for="description" value="{{ __('Site description') }}" />
            </x-slot>
            <x-wordful::input.textarea id="description" class="block w-full max-w-lg" wire:model.defer="state.description" rows="4" />
            <x-wordful::input.error for="description" class="mt-2"/>
        </x-wordful::input.inline-group>

        <x-wordful::input.section-actions>
            <x-wordful::button color="primary">
                {{ __('Save settings') }}
            </x-wordful::button>
        </x-wordful::input.section-actions>
    </x-wordful::input.section>
</form>

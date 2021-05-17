<div class="py-10">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <form wire:submit.prevent="save">
            <div class="pb-5 border-b border-gray-200">
                <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    {{ __('General') }}
                </h1>
                <p class="mt-2 max-w-4xl text-sm font-medium text-gray-500">{{ __('Manage your general settings') }}</p>
            </div>
            <div class="py-6">
                <div>
                    <div class="p-4 border border-gray-200 rounded-md bg-gray-50">
                        <div class="divide-y divide-gray-200 -my-4 sm:-my-5">
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <x-wordful::input.label for="name" value="{{ __('Site name') }}" class="sm:mt-px sm:pt-2"/>

                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <x-wordful::input.text id="name" type="text" class="block w-full" wire:model.defer="name" />
                                    <x-wordful::input.error for="name" class="mt-2"/>
                                </div>
                            </div>

                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <x-wordful::input.label for="description" value="{{ __('Site description') }}" class="sm:mt-px sm:pt-2"/>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <x-wordful::input.textarea id="description" class="block w-full" wire:model.defer="description" rows="5" />
                                    <x-wordful::input.error for="description" class="mt-2"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <div class="flex space-x-3">
                        <x-wordful::button.primary>
                            {{ __('Save changes') }}
                        </x-wordful::button.primary>
                    </div>
                    <div class="mt-2">
                        {{ __('Or,') }} <x-wordful::link href="{{ route('wordful.tags.index') }}">{{ __('discard my changes') }}</x-wordful::link>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

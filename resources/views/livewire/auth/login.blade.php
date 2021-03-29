<div>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="py-8 px-4 sm:px-10">
                <form wire:submit.prevent="login" class="space-y-4">
                    <div>
                        <x-wordful::input.label class="sr-only" for="email" value="{{ __('Email address') }}" />

                        <x-wordful::input.text id="email" type="email" class="block w-full" wire:model.defer="email" placeholder="{{ __('Email address') }}" required autofocus />
                        <x-wordful::input.error for="email" class="mt-2"/>
                    </div>

                    <div>
                        <x-wordful::input.label class="sr-only" for="password" value="{{ __('Password') }}" />

                        <x-wordful::input.text id="password" type="password" class="block w-full" wire:model.lazy="password" placeholder="{{ __('Password') }}" required />
                        <x-wordful::input.error for="password" class="mt-2"/>
                    </div>
                    <div>
                        <x-wordful::button.primary class="w-full flex justify-center">
                            {{ __('Sign in') }}
                        </x-wordful::button.primary>
                    </div>
                </form>

                <div class="text-sm mt-8 hidden">
                    <x-wordful::link href="#">Forgot your password?</x-wordful::link>
                </div>
            </div>
        </div>
    </div>
</div>

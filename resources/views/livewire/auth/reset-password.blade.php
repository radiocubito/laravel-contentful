<div>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h1 class="text-center text-3xl font-extrabold text-gray-900">
                {{ __('Choose your new password') }} 🔓
            </h1>
        </div>
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="py-8 px-4 sm:px-10">
                <form wire:submit.prevent="resetPassword" class="space-y-6">
                    <div>
                        <x-wordful::input.label for="email" value="{{ __('Email address') }}" />

                        <div class="mt-1">
                            <x-wordful::input.text id="email" type="email" class="block w-full" wire:model.defer="email" required autofocus />
                            <x-wordful::input.error for="email" class="mt-2"/>
                        </div>
                    </div>

                    <div>
                        <x-wordful::input.label for="password" value="{{ __('Password') }}" />

                        <div class="mt-1">
                            <x-wordful::input.text id="password" type="password" class="block w-full" wire:model.lazy="password" required />
                            <x-wordful::input.error for="password" class="mt-2"/>
                        </div>
                    </div>

                    <div>
                        <x-wordful::input.label for="password_confirmation" value="{{ __('Confirm password') }}" />

                        <div class="mt-1">
                            <x-wordful::input.text id="password_confirmation" type="password" class="block w-full" wire:model.lazy="password_confirmation" required />
                        </div>
                    </div>

                    <div>
                        <x-wordful::button color="primary">
                            {{ __('Reset password') }}
                        </x-wordful::button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

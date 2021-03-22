<div class="py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div>
            <x-wordful::input.errors class="mb-4" :errors="$errors" />

            <div>
                <form class="space-y-6" wire:submit.prevent="publish">
                    <div>
                        <label for="title" class="sr-only">{{ __('Title') }}</label>
                        <x-wordful::input.textarea wire:model.defer="post.title" sharedBorder placeholder="{{ __('Post title') }}" rows="1" class="border-transparent rounded-md font-bold text-4xl leading-none resize-none" />
                    </div>
                    <div>
                        <label for="html" class="sr-only">{{ __('HTML') }}</label>
                        <x-wordful::input.rich-text wire:model.defer="post.html" id="html" />
                    </div>
                    <div class="pt-5">
                        <div class="flex space-x-3">
                            <x-wordful::button.primary>
                                {{ __('Publish post') }}
                            </x-wordful::button.primary>
                            <x-wordful::button.secondary type="button" wire:click="save">
                                {{ __('Save draft') }}
                            </x-wordful::button.secondary>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

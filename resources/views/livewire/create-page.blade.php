<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg">
            <x-wordful::input.errors class="mb-4" :errors="$errors" />

            <div class="border-gray-200 px-4 py-5 sm:px-6">
                <form class="space-y-6" wire:submit.prevent="publish">
                    <div>
                        <label for="title" class="sr-only">{{ __('Title') }}</label>
                        <x-wordful::input.textarea wire:model.defer="post.title" sharedBorder placeholder="{{ __('Page title…') }}" rows="1" class="border-transparent rounded-md font-bold text-4xl leading-none resize-none" />
                    </div>
                    <div>
                        <label for="slug" class="sr-only">{{ __('Slug') }}</label>
                        <x-wordful::input.text type="text" wire:model.defer="post.slug" sharedBorder placeholder="{{ __('Page slug…') }}" class="border-transparent rounded-md leading-none" />
                    </div>
                    <div>
                        <label for="html" class="sr-only">{{ __('HTML') }}</label>
                        <x-wordful::input.rich-text wire:model.defer="post.html" id="html" />
                    </div>
                    <div>
                        <label for="tags" class="sr-only">{{ __('Tags') }}</label>
                        <x-wordful::input.tag wire:model.defer="incomingTags" id="tags" />
                    </div>
                    <div class="pt-5">
                        <div class="flex space-x-3">
                            <x-wordful::button.primary>
                                {{ __('Publish page') }}
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

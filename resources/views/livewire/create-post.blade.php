<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <x-contentful::input.errors class="mb-4" :errors="$errors" />

        <form class="space-y-6" wire:submit.prevent="publish">
            <div>
                <label for="title" class="sr-only">{{ __('Title') }}</label>
                <x-contentful::input.textarea wire:model.defer="post.title" sharedBorder placeholder="{{ __('Type a title…') }}" rows="1" class="border-0 font-bold text-4xl leading-none resize-none" />
            </div>

            <div>
                <label for="slug" class="sr-only">{{ __('Slug') }}</label>
                <x-contentful::input.text type="text" wire:model.defer="post.slug" sharedBorder placeholder="{{ __('Slug') }}" class="border-0 leading-none" />
            </div>

            <div>
                <label for="html" class="sr-only">{{ __('HTML') }}</label>

                <x-contentful::input.rich-text wire:model.defer="post.html" id="html" />
            </div>

            <div class="pt-5">
                <div class="flex space-x-3">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Publish post') }}
                    </button>

                    <button type="button" wire:click="save" class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Save draft') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

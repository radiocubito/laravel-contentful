<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form class="space-y-6" wire:submit.prevent="publish">
            <div>
                <label for="title">{{ __('Title') }}</label>

                <input wire:model="post.title" type="text" id="title" placeholder="{{ __('Title') }}" class="block w-full">
            </div>

            <div>
                <label for="slug">{{ __('Slug') }}</label>

                <input wire:model="post.slug" type="text" id="slug" placeholder="{{ __('Slug') }}" class="block w-full">
            </div>

            <div>
                <label for="html">{{ __('HTML') }}</label>

                <x-contentful::input.rich-text wire:model.defer="post.html" id="html" />
            </div>

            <div class="pt-5">
                <div class="flex space-x-3">
                    <button type="submit">
                        {{ __('Publish') }}
                    </button>

                    <button type="button" wire:click="save">
                        {{ __('Save draft') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

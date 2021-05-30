<form wire:submit.prevent="save">
    <x-wordful::input.section>
        <x-slot name="heading">
            <div>
                <h2 class="text-sm font-medium text-gray-900">
                    {{ __('Publication identity') }}
                </h2>
            </div>
        </x-slot>

        <x-wordful::input.inline-group>
            <x-slot name="label">
                <x-wordful::input.label for="icon" value="{{ __('Icon') }}" />
            </x-slot>

            <!-- Site Icon -->
            <div class="flex items-center space-x-2" x-data="{logoName: null, iconPreview: null}">
                <div>
                    <!-- Profile Icon File Input -->
                    <input type="file"
                                wire:model="icon"
                                x-ref="icon"
                                x-on:change="
                                        iconName = $refs.icon.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            iconPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.icon.files[0]);
                                "
                                id="icon"
                                class="hidden" />

                    <!-- Current Profile Icon -->
                    <div x-show="! iconPreview">
                        @if (config('site.icon_path'))
                            <img src="{{ config('site.icon_url') }}" class="rounded-full h-12 w-12 object-cover">
                        @else
                            <div class="h-12 w-12 rounded-full overflow-hidden border-2 border-gray-300 border-dashed"></div>
                        @endif
                    </div>

                    <!-- New Profile Icon Preview -->
                    <div x-show="iconPreview">
                        <span class="block rounded-full w-12 h-12"
                              x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + iconPreview + '\');'">
                        </span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    @if (config('site.icon_path'))
                        <x-wordful::button color="transparent" type="button" wire:click="deleteSiteIcon">
                            {{ __('Remove icon') }}
                        </x-wordful::button>
                    @endif

                    <x-wordful::button color="secondary" type="button" x-on:click.prevent="$refs.icon.click()">
                        {{ __('Upload icon') }}
                    </x-wordful::button>
                </div>
            </div>
            <x-wordful::input.error for="icon" class="mt-2"/>
            <p class="mt-2 text-sm text-gray-500">{{ __('A square, social icon used in the UI of your site, at least 60x60px.') }}</p>
        </x-wordful::input.inline-group>

        <x-wordful::input.inline-group>
            <x-slot name="label">
                <x-wordful::input.label for="logo" value="{{ __('Logo') }}" />
            </x-slot>

            <!-- Site Logo -->
            <div x-data="{logoName: null, logoPreview: null}">
                <div>
                    <!-- Profile Logo File Input -->
                    <input type="file"
                                wire:model="logo"
                                x-ref="logo"
                                x-on:change="
                                        logoName = $refs.logo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            logoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.logo.files[0]);
                                "
                                id="logo"
                                class="hidden" />

                    <!-- Current Profile Logo -->
                    <div x-show="! logoPreview">
                        @if (config('site.logo_path'))
                            <img src="{{ config('site.logo_url') }}" class="rounded h-20 w-full max-w-lg object-cover">
                        @else
                            <div class="h-20 w-full max-w-lg rounded overflow-hidden border-2 border-gray-300 border-dashed"></div>
                        @endif
                    </div>

                    <!-- New Profile Logo Preview -->
                    <div x-show="logoPreview">
                        <span class="block rounded h-20 w-full max-w-lg"
                              x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + logoPreview + '\');'">
                        </span>
                    </div>
                </div>

                <div class="flex space-x-2 mt-2">
                    @if (config('site.logo_path'))
                        <x-wordful::button color="transparent" type="button" wire:click="deleteSiteLogo">
                            {{ __('Remove logo') }}
                        </x-wordful::button>
                    @endif

                    <x-wordful::button color="secondary" type="button" x-on:click.prevent="$refs.logo.click()">
                        {{ __('Upload logo') }}
                    </x-wordful::button>
                </div>
            </div>
            <x-wordful::input.error for="logo" class="mt-2"/>
            <p class="mt-2 text-sm text-gray-500 max-w-2xl">{{ __('The primary logo for your brand displayed across your site, should be transparent and at least 600px x 72px.') }}</p>
        </x-wordful::input.inline-group>

        <x-wordful::input.section-actions>
            <x-wordful::button color="primary">
                {{ __('Save settings') }}
            </x-wordful::button>
        </x-wordful::input.section-actions>
    </x-wordful::input.section>
</form>

<div>
    @if ($post->isPublished() AND is_null($post->emailed_at) AND $subscribersCount > 0)
        <div class="pb-6">
            <div class="bg-gray-50 border border-gray-200 sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <p class="text-center">{{ __('If you'd also like to email this post to your subscribers, click the button below.') }}</p>

                    <div class="flex justify-center space-x-2 mt-5">
                        <x-wordful::button.primary wire:click="emailPost">
                            @if ($subscribersCount === 1)
                                {{ __('Email it to :subscribersCount subscriber', ['subscribersCount', $subscribersCount]) }}
                            @elseif ($subscribersCount > 1)
                                {{ __('Email it to :subscribersCount subscribers', ['subscribersCount', $subscribersCount]) }}
                            @endif
                        </x-wordful::button.primary>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

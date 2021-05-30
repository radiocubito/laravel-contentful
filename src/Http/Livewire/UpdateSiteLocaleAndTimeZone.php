<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Radiocubito\Wordful\Support\ConfigCache;
use Radiocubito\Wordful\Support\SiteConfiguration;
use Radiocubito\Wordful\Support\TimeZone;

class UpdateSiteLocaleAndTimeZone extends Component
{
    public array $state = [];
    public array $timeZones = [];

    protected function rules()
    {
        return [
            'icon' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'logo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];
    }

    protected function validationAttributes()
    {
         return [
            'icon' => __('icon'),
            'logo' => __('logo'),
        ];
    }

    public function save(SiteConfiguration $generalConfiguration)
    {
        $this->validate();

        $generalConfiguration->put($this->state);

        ConfigCache::clear();
    }

    public function mount(SiteConfiguration $siteConfiguration)
    {
        $this->state = [
            'locale' => $siteConfiguration->locale ?? config('app.locale'),
            'timezone' => $siteConfiguration->timezone ?? '',
        ];

        $this->timeZones = TimeZone::all();
    }

    public function render()
    {
        return view('wordful::livewire.update-site-locale-and-timezone-form');
    }
}

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
            'state.locale' => ['required'],
            'state.timezone' => ['required', Rule::in($this->timeZones)],
        ];
    }

    protected function validationAttributes()
    {
         return [
            'state.locale' => __('locale'),
            'state.timezone' => __('timezone'),
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

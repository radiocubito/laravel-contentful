<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Radiocubito\Wordful\Support\TimeZone;
use Radiocubito\Wordful\Support\ConfigCache;
use Radiocubito\Wordful\Support\SiteConfiguration;

class ManageGeneralSettings extends Component
{
    public string $name = '';
    public string $description = '';
    public string $locale = '';
    public string $timezone = '';
    public array $timeZones;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:300'],
            'locale' => ['required'],
            'timezone' => ['required', Rule::in(TimeZone::all())],
        ];
    }

    public function save(SiteConfiguration $generalConfiguration)
    {
        $validatedData = $this->validate();

        $generalConfiguration->put($validatedData);

        ConfigCache::clear();
    }

    public function mount(SiteConfiguration $siteConfiguration)
    {
        $this->name = $siteConfiguration->name ?? config('app.name');
        $this->description = $siteConfiguration->description ?? '';
        $this->locale = $siteConfiguration->locale ?? config('app.locale');
        $this->timezone = $siteConfiguration->timezone ?? config('app.timezone');
        $this->timeZones = TimeZone::all();
    }

    public function render()
    {
        return view('wordful::livewire.manage-general-settings')->layout('wordful::layouts.html');
    }
}

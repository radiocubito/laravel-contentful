<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Radiocubito\Wordful\Support\ConfigCache;
use Radiocubito\Wordful\Support\SiteConfiguration;
use Radiocubito\Wordful\Support\TimeZone;

class ManageGeneralSettings extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $description = '';
    public string $locale = '';
    public string $timezone = '';
    public array $timeZones;
    public $logo;
    public $icon;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:300'],
            'locale' => ['required'],
            'timezone' => ['required', Rule::in(TimeZone::all())],
            'icon' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'logo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];
    }

    public function save(SiteConfiguration $generalConfiguration)
    {
        $validatedData = $this->validate();

        $generalConfiguration->put($validatedData);

        if (isset($validatedData['icon'])) {
            $generalConfiguration->updateIcon($validatedData['icon']);
        }

        if (isset($validatedData['logo'])) {
            $generalConfiguration->updateLogo($validatedData['logo']);
        }

        ConfigCache::clear();
    }

    public function deleteSiteIcon(SiteConfiguration $generalConfiguration)
    {
        $generalConfiguration->deleteIcon();
    }

    public function deleteSiteLogo(SiteConfiguration $generalConfiguration)
    {
        $generalConfiguration->deleteLogo();
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

<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Radiocubito\Wordful\Support\ConfigCache;
use Radiocubito\Wordful\Support\SiteConfiguration;

class UpdateSiteIdentityForm extends Component
{
    use WithFileUploads;

    public $logo;
    public $icon;

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
            'state.locale' => __('locale'),
            'state.timezone' => __('timezone'),
        ];
    }

    public function save(SiteConfiguration $generalConfiguration)
    {
        $validatedData = $this->validate();

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

    public function render()
    {
        return view('wordful::livewire.update-site-identity-form');
    }
}

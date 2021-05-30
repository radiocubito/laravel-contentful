<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Support\ConfigCache;
use Radiocubito\Wordful\Support\SiteConfiguration;

class UpdateSiteTitleAndDescriptionForm extends Component
{
    public array $state = [];

    protected function rules()
    {
        return [
            'state.name' => ['required', 'string', 'max:255'],
            'state.description' => ['nullable', 'string', 'max:300'],
        ];
    }

    protected function validationAttributes()
    {
         return [
            'state.name' => __('name'),
            'state.description' => __('description'),
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
            'name' => $siteConfiguration->name ?? config('app.name'),
            'description' => $siteConfiguration->description ?? '',
        ];
    }

    public function render()
    {
        return view('wordful::livewire.update-site-title-and-description-form');
    }
}

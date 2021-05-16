<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Support\ConfigCache;
use Radiocubito\Wordful\Support\SiteConfiguration;

class ManageGeneralSettings extends Component
{
    public string $name = '';
    public string $description = '';

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:300'],
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
    }

    public function render()
    {
        return view('wordful::livewire.manage-general-settings')->layout('wordful::layouts.wordful');
    }
}

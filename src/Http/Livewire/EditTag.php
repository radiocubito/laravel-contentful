<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Models\Tag;

class EditTag extends Component
{
    public Tag $tag;

    public $customMetaDataEnabled = false;

    protected function rules()
    {
        return [
            'tag.name' => ['required', 'string', 'max:255'],
            'tag.slug' => ['required', 'string', 'max:255', 'unique:tags,slug,'.$this->tag->id],
            'tag.description' => ['nullable', 'string', 'max:300'],
            'tag.meta.meta_title' => ['nullable', 'string', 'max:300'],
            'tag.meta.meta_description' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function save()
    {
        $this->validate();

        if (! $this->customMetaDataEnabled) {
            $this->tag->fill(['meta' => [
                'meta_title' => null,
                'meta_description' => null,
            ]]);
        }

        $this->tag->save();

        redirect()->to(route('wordful.tags.index'));
    }

    public function delete()
    {
        $this->tag->delete();

        redirect()->to(route('wordful.tags.index'));
    }

    public function mount()
    {
        $this->customMetaDataEnabled = $this->tag->customMetaDataEnabled();
    }

    public function render()
    {
        return view('wordful::livewire.edit-tag')->layout('wordful::layouts.html');
    }
}

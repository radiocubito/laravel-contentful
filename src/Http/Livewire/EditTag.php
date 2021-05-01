<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Models\Tag;

class EditTag extends Component
{
    public Tag $tag;

    protected function rules()
    {
        return [
            'tag.name' => ['required', 'string', 'max:255'],
            'tag.slug' => ['required', 'string', 'max:255', 'unique:tags,slug,'.$this->tag->id],
            'tag.description' => ['nullable', 'string', 'max:300'],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->tag->save();

        redirect()->to(route('wordful.tags.index'));
    }

    public function delete()
    {
        $this->tag->delete();

        redirect()->to(route('wordful.tags.index'));
    }

    public function render()
    {
        return view('wordful::livewire.edit-tag')->layout('wordful::layouts.wordful');
    }
}

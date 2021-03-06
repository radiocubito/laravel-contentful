<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Radiocubito\Wordful\Models\Tag;

class ShowTags extends Component
{
    public $showCreateTagForm = false;

    public Tag $newTag;

    public Collection $tags;

    protected $rules = [
        'newTag.name' => ['required', 'string', 'max:255'],
    ];

    public function saveNewTag()
    {
        $this->validate();

        $this->newTag->save();

        $this->newTag = new Tag;

        $this->tags = Tag::orderBy('slug')->get();

        $this->showCreateTagForm = false;
    }

    public function deleteTag(Tag $tag)
    {
        $tag->delete();

        $this->tags = Tag::orderBy('slug')->get();
    }

    public function mount()
    {
        $this->tags = Tag::orderBy('slug')->get();
        $this->newTag = new Tag;
    }

    public function render()
    {
        return view('wordful::livewire.show-tags')->layout('wordful::layouts.html');
    }
}

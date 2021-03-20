<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Radiocubito\Wordful\Models\Tag;

trait WithTags
{
    public Collection $selectableTags;

    public Collection $selectedTags;

    public $incomingTag = '';

    public $deletingTag = '';

    public $showCreateTagForm = false;

    public $newTagName = '';

    public function updatedIncomingTag()
    {
        $this->validateOnly('incomingTag', ['incomingTag' => ['exists:tags,id']]);

        $incomingTag = Tag::find($this->incomingTag);

        $this->selectedTags = $this->selectedTags->push($incomingTag);

        $this->selectableTags = $this->selectableTags->diff($this->selectedTags);

        $this->incomingTag = '';
    }

    public function removeTag($incomingTagId)
    {
        $this->incomingTag = $incomingTagId;

        $this->validateOnly('incomingTag', ['incomingTag' => ['exists:tags,id']]);

        $incomingTag = Tag::find($this->incomingTag);

        $this->selectableTags = $this->selectableTags->push($incomingTag);

        $this->selectedTags = $this->selectedTags->diff($this->selectableTags);

        $this->incomingTag = '';
    }

    public function saveTag()
    {
        $this->validateOnly('newTagName', ['newTagName' => ['required', 'string', 'max:255']]);

        $tag = Tag::create(['name' => $this->newTagName]);

        $this->selectedTags = $this->selectedTags->push($tag);

        $this->selectableTags = $this->selectableTags->diff($this->selectedTags);

        $this->newTagName = '';

        $this->showCreateTagForm = false;
    }
}

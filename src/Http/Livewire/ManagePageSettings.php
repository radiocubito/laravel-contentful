<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Models\Tag;

class ManagePageSettings extends Component
{
    use WithTags;

    public Post $page;

    public ?string $publishDate;

    public $customExcerptEnabled = false;

    public $customMetaDataEnabled = false;

    protected function rules()
    {
        return [
            'page.status' => ['required', 'in:published,draft'],
            'page.slug' => ['required', 'string', 'max:255', 'unique:posts,slug,'.$this->page['id']],
            'page.custom_excerpt' => ['nullable', 'string', 'max:300'],
            'publishDate' => ['nullable', 'required_if:page.status,published', 'date_format:Y-m-d H:i:s'],
            'page.meta.meta_title' => ['nullable', 'string', 'max:300'],
            'page.meta.meta_description' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->page->fill([
            'published_at' => $this->publishDate ?? null,
            'custom_excerpt' => $this->customExcerptEnabled ? $this->page->custom_excerpt : null,
        ]);

        if (! $this->customMetaDataEnabled) {
            $this->page->fill(['meta' => [
                'meta_title' => null,
                'meta_description' => null,
            ]]);
        }

        $this->page->save();

        $this->page->tags()->sync(
            $this->selectedTags->pluck('id')
        );

        redirect()->to(route('wordful.pages.show', $this->page));
    }

    public function mount()
    {
        $this->publishDate = optional($this->page->published_at)->format('Y-m-d H:i:s');
        $this->selectedTags = $this->page->tags;
        $this->selectableTags = Tag::whereNotIn('id', $this->page->tags->pluck('id'))->orderBy('slug')->get();
        $this->customExcerptEnabled = $this->page->customExcerptEnabled();
        $this->customMetaDataEnabled = $this->page->customMetaDataEnabled();
    }

    public function render()
    {
        return view('wordful::livewire.manage-page-settings')->layout('wordful::layouts.html');
    }
}

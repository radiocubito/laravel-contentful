<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Models\Tag;

class ManagePostSettings extends Component
{
    use WithTags;

    public Post $post;

    public ?string $publishDate;

    protected function rules()
    {
        return [
            'post.status' => ['required', 'in:published,draft'],
            'post.slug' => ['required', 'string', 'max:255', 'unique:posts,slug,'.$this->post['id']],
            'publishDate' => ['nullable', 'required_if:post.status,published', 'date_format:Y-m-d H:i:s'],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->post->fill([
            'published_at' => $this->publishDate ?? null,
        ])->save();

        $this->post->tags()->sync(
            $this->selectedTags->pluck('id')
        );

        redirect()->to(route('wordful.posts.show', $this->post));
    }

    public function mount()
    {
        $this->publishDate = optional($this->post->published_at)->format('Y-m-d H:i:s');
        $this->selectedTags = $this->post->tags;
        $this->selectableTags = Tag::whereNotIn('id', $this->post->tags->pluck('id'))->get();
    }

    public function render()
    {
        return view('wordful::livewire.manage-post-settings')->layout('wordful::layouts.wordful');
    }
}

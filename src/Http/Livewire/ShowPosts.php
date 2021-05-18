<?php

namespace Radiocubito\Wordful\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Radiocubito\Wordful\Models\Post;

class ShowPosts extends Component
{
    public function render()
    {
        $groupedPosts = [
            [
                'status' => 'draft',
                'sectionTitle' => __('Draft'),
                'posts' => Post::draft()->ofType('post')->orderBy('created_at', 'desc')->get(),
            ],
            [
                'status' => 'published',
                'sectionTitle' => __('Published'),
                'posts' => Post::published()->ofType('post')->orderBy('created_at', 'desc')->get(),
            ],
        ];

        return view('wordful::livewire.show-posts', [
            'groupedPosts' => $groupedPosts,
        ])->layout('wordful::layouts.html-wordful');
    }
}

<?php

use Radiocubito\Wordful\Http\Livewire\CreatePost;
use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Tests\Fixtures\User;

it('can see livewire create post component on create post page', function () {
    $user = User::factory()->create();

    test()->actingAs($user)
        ->get('/wordful/posts/create')
        ->assertSuccessful()
        ->assertSeeLivewire('wordful::posts.create-post');
});

it('can create a post', function () {
    $user = User::factory()->create();

    test()->actingAs($user)
        ->livewire(CreatePost::class)
        ->set('post.title', '::title::')
        ->set('post.html', '::html::')
        ->call('save');

    $post = Post::first();

    $this->assertEquals('::title::', $post->title);
    $this->assertEquals('::html::', $post->html);
});

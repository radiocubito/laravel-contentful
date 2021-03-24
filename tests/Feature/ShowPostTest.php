<?php

use Radiocubito\Wordful\Http\Livewire\ShowPost;
use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Tests\Fixtures\User;
use Radiocubito\Wordful\Wordful;

it('can see livewire show post component on show post page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $post = Post::factory()->create([
        'author_id' => $user->id,
        'type' => 'post',
    ]);

    test()->actingAs($user)->withoutExceptionHandling()
        ->get("/wordful/posts/{$post->id}")
        ->assertSuccessful()
        ->assertSeeLivewire('wordful::posts.show-post');
});

it('can publish post', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $post = Post::factory()->create([
        'author_id' => $user->id,
        'type' => 'post',
        'status' => 'draft',
    ]);

    test()->actingAs($user)
        ->livewire(ShowPost::class, ['post' => $post])
        ->call('publish');

    $post->refresh();

    expect($post->status)->toBe('published');
    expect($post->published_at)->not()->toBeNull();
});

it('can delete post', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $post = Post::factory()->create([
        'author_id' => $user->id,
        'type' => 'post',
    ]);

    test()->actingAs($user)
        ->livewire(ShowPost::class, ['post' => $post])
        ->call('delete');

    $this->assertDeleted($post);
});

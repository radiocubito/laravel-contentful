<?php

use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Tests\Fixtures\User;
use Radiocubito\Wordful\Wordful;

it('can see livewire show post drafts component on show post drafts page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    Post::factory()->page()->count(3)->create([
        'author_id' => $user->id,
        'status' => 'draft',
    ]);
    $publishedPost = Post::factory()
        ->published()
        ->create([
            'author_id' => $user->id,
        ]);

    test()->actingAs($user)->withoutExceptionHandling()
        ->get('/wordful/posts/drafts')
        ->assertSuccessful()
        ->assertSeeLivewire('wordful::posts.show-post-drafts')
        ->assertDontSee($publishedPost->title);
});

<?php

use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Tests\Fixtures\User;
use Radiocubito\Wordful\Wordful;

it('can see livewire show page drafts component on show page drafts page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    Post::factory()->page()->count(3)->create([
        'author_id' => $user->id,
        'type' => 'page',
        'status' => 'draft',
    ]);
    $publishedPage = Post::factory()
        ->page()
        ->published()
        ->create([
            'author_id' => $user->id,
        ]);

    test()->actingAs($user)->withoutExceptionHandling()
        ->get('/wordful/pages/drafts')
        ->assertSuccessful()
        ->assertSeeLivewire('wordful::pages.show-page-drafts')
        ->assertDontSee($publishedPage->title);
});

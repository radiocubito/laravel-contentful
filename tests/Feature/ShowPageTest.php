<?php

use Radiocubito\Wordful\Http\Livewire\ShowPage;
use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Tests\Fixtures\User;
use Radiocubito\Wordful\Wordful;

it('can see livewire show page component on show page page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $page = Post::factory()->create([
        'author_id' => $user->id,
        'type' => 'page',
    ]);

    test()->actingAs($user)->withoutExceptionHandling()
        ->get("/wordful/pages/{$page->id}")
        ->assertSuccessful()
        ->assertSeeLivewire('wordful::pages.show-page');
});

it('can publish page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $page = Post::factory()->create([
        'author_id' => $user->id,
        'type' => 'page',
        'status' => 'draft',
    ]);

    test()->actingAs($user)
        ->livewire(ShowPage::class, ['post' => $page])
        ->call('publish');

    $page->refresh();

    expect($page->status)->toBe('published');
    expect($page->published_at)->not()->toBeNull();
});

it('can delete page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $page = Post::factory()->create([
        'author_id' => $user->id,
        'type' => 'page',
    ]);

    test()->actingAs($user)
        ->livewire(ShowPage::class, ['post' => $page])
        ->call('delete');

    $this->assertDeleted($page);
});

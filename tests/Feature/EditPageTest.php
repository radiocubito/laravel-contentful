<?php

use Radiocubito\Wordful\Http\Livewire\EditPage;
use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Tests\Fixtures\User;
use Radiocubito\Wordful\Wordful;

it('can see livewire create post component on edit page page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $page = Post::factory()->create([
        'author_id' => $user->id,
        'type' => 'page',
    ]);

    test()->actingAs($user)->withoutExceptionHandling()
        ->get("/wordful/pages/{$page->id}/edit")
        ->assertSuccessful()
        ->assertSeeLivewire('wordful::pages.edit-page');
});

it('can save page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $page = Post::factory()->create([
        'author_id' => $user->id,
        'type' => 'page',
    ]);

    test()->actingAs($user)
        ->livewire(EditPage::class, ['page' => $page])
        ->set('page.title', '::title::')
        ->set('page.html', '::html::')
        ->call('save');

    $this->assertDatabaseHas('posts', [
        'title' => '::title::',
        'html' => '::html::',
    ]);
});

it('can save and publish page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $page = Post::factory()->create([
        'author_id' => $user->id,
        'type' => 'page',
    ]);

    test()->actingAs($user)
        ->livewire(EditPage::class, ['page' => $page])
        ->set('page.title', '::title::')
        ->set('page.html', '::html::')
        ->call('saveAndPublish');

    $this->assertDatabaseHas('posts', [
        'title' => '::title::',
        'html' => '::html::',
        'status' => 'published',
    ]);
});

test('validation tests', function (array $payload, string $key, string $rule) {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $page = Post::factory()->create([
        'author_id' => $user->id,
        'type' => 'page',
    ]);

    test()->actingAs($user)
        ->livewire(EditPage::class, ['page' => $page])
        ->fill($payload)
        ->call('save')
        ->assertHasErrors([$key => $rule]);
})->with(function () {
    $defaultPayload = [
        'page.title' => '::title::',
        'page.html' => '::html::',
    ];

    yield from [
        'missing title' => [
            'payload' => array_merge($defaultPayload, [
                'page.title' => '',
            ]),
            'key' => 'page.title',
            'rule' => 'required',
        ],
        'missing html' => [
            'payload' => array_merge($defaultPayload, [
                'page.html' => '',
            ]),
            'key' => 'page.html',
            'rule' => 'required',
        ],
    ];
});

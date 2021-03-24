<?php

use Illuminate\Support\Arr;
use Radiocubito\Wordful\Http\Livewire\CreatePage;
use Radiocubito\Wordful\Tests\Fixtures\User;

it('can see livewire create page component on create page page', function () {
    $user = User::factory()->create();

    test()->actingAs($user)
        ->get('/wordful/pages/create')
        ->assertSuccessful()
        ->assertSeeLivewire('wordful::pages.create-page');
});

it('can create a draft page', function () {
    $user = User::factory()->create();

    test()->actingAs($user)
        ->livewire(CreatePage::class)
        ->set('post.title', '::title::')
        ->set('post.html', '::html::')
        ->call('save');

    $this->assertDatabaseHas('posts', [
        'author_id' => $user->id,
        'title' => '::title::',
        'html' => '::html::',
        'status' => 'draft',
        'type' => 'page',
        'published_at' => null,
    ]);
});

it('can create a published page', function () {
    $user = User::factory()->create();

    test()->actingAs($user)
        ->livewire(CreatePage::class)
        ->set('post.title', '::title::')
        ->set('post.html', '::html::')
        ->call('publish');

    $this->assertDatabaseHas('posts', [
        'author_id' => $user->id,
        'title' => '::title::',
        'html' => '::html::',
        'status' => 'published',
        'type' => 'page',
    ]);
});

test('validation tests', function (array $payload, string $key, string $rule) {
    $user = User::factory()->create();

    test()->actingAs($user)
        ->livewire(CreatePage::class)
        ->fill($payload)
        ->call('save')
        ->assertHasErrors([$key => $rule]);
})->with(function () {
    $defaultPayload = [
        'post.title' => '::title::',
        'post.html' => '::html::',
    ];

    yield from [
        'missing title' => [
            'payload' => Arr::except($defaultPayload, 'post.title'),
            'key' => 'post.title',
            'rule' => 'required',
        ],
        'missing html' => [
            'payload' => Arr::except($defaultPayload, 'post.html'),
            'key' => 'post.html',
            'rule' => 'required',
        ],
    ];
});

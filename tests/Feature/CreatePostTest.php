<?php

use Illuminate\Support\Arr;
use Radiocubito\Wordful\Http\Livewire\CreatePost;
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

    $this->assertDatabaseHas('posts', [
        'author_id' => $user->id,
        'title' => '::title::',
        'html' => '::html::',
        'status' => 'draft',
        'type' => 'post',
        'published_at' => null,
    ]);
});

test('validation tests', function (array $payload, string $key, string $rule) {
    $user = User::factory()->create();

    test()->actingAs($user)
        ->livewire(CreatePost::class)
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

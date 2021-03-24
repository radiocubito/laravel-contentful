<?php

use Radiocubito\Wordful\Http\Livewire\ManagePostSettings;
use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Tests\Fixtures\User;
use Radiocubito\Wordful\Wordful;

it('can see livewire manage post settings component on post settings page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $post = Post::factory()->create([
        'author_id' => $user->id,
    ]);

    test()->actingAs($user)->withoutExceptionHandling()
        ->get("/wordful/posts/{$post->id}/settings")
        ->assertSuccessful()
        ->assertSeeLivewire('wordful::posts.manage-post-settings');
});

it('can save post settings', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $post = Post::factory()->create([
        'author_id' => $user->id,
    ]);

    test()->actingAs($user)
        ->livewire(ManagePostSettings::class, ['post' => $post])
        ->set('post.status', 'draft')
        ->set('post.slug', '::slug::')
        ->call('save');

    $post->refresh();

    expect($post->isDraft())->toBeTrue();
    expect($post->slug)->toBe('::slug::');
});

test('validation tests', function (array $payload, string $key, string $rule, callable $setup = null) {
    Wordful::useUserModel(User::class);

    if ($setup !== null) {
        $setup();
    };

    $user = User::factory()->create();
    $post = Post::factory()->create([
        'author_id' => $user->id,
    ]);

    test()->actingAs($user)
        ->livewire(ManagePostSettings::class, ['post' => $post])
        ->fill($payload)
        ->call('save')
        ->assertHasErrors([$key => $rule]);
})->with(function () {
    $defaultPayload = [
        'post.status' => 'draft',
        'post.slug' => '::slug::',
    ];

    yield from [
        'missing status' => [
            'payload' => array_merge($defaultPayload, [
                'post.status' => '',
            ]),
            'key' => 'post.status',
            'rule' => 'required',
        ],
        'invalid status' => [
            'payload' => array_merge($defaultPayload, [
                'post.status' => '::invalid-status::',
            ]),
            'key' => 'post.status',
            'rule' => 'in',
        ],
        'missing slug' => [
            'payload' => array_merge($defaultPayload, [
                'post.slug' => '',
            ]),
            'key' => 'post.slug',
            'rule' => 'required',
        ],
        'slug already exists' => [
            'payload' => $defaultPayload,
            'key' => 'post.slug',
            'rule' => 'unique',
            'setup' => function () use ($defaultPayload) {
                Post::factory()->create()->fill([
                    'slug' => $defaultPayload['post.slug'],
                ])->save();
            },
        ],
    ];
});

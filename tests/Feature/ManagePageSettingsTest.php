<?php

use Radiocubito\Wordful\Http\Livewire\ManagePageSettings;
use Radiocubito\Wordful\Models\Post;
use Radiocubito\Wordful\Tests\Fixtures\User;
use Radiocubito\Wordful\Wordful;

it('can see livewire manage page settings component on page settings page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $page = Post::factory()->page()->create([
        'author_id' => $user->id,
    ]);

    test()->actingAs($user)->withoutExceptionHandling()
        ->get("/wordful/pages/{$page->id}/settings")
        ->assertSuccessful()
        ->assertSeeLivewire('wordful::pages.manage-page-settings');
});

it('can save page settings', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();
    $page = Post::factory()->page()->create([
        'author_id' => $user->id,
    ]);

    test()->actingAs($user)
        ->livewire(ManagePageSettings::class, ['post' => $page])
        ->set('post.status', 'draft')
        ->set('post.slug', '::slug::')
        ->call('save');

    $page->refresh();

    expect($page->isDraft())->toBeTrue();
    expect($page->slug)->toBe('::slug::');
});

test('validation tests', function (array $payload, string $key, string $rule, callable $setup = null) {
    Wordful::useUserModel(User::class);

    if ($setup !== null) {
        $setup();
    };

    $user = User::factory()->create();
    $page = Post::factory()->page()->create([
        'author_id' => $user->id,
    ]);

    test()->actingAs($user)
        ->livewire(ManagePageSettings::class, ['post' => $page])
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
                Post::factory()->page()->create()->fill([
                    'slug' => $defaultPayload['post.slug'],
                ])->save();
            },
        ],
    ];
});

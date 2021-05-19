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
        ->livewire(ManagePageSettings::class, ['page' => $page])
        ->set('page.status', 'draft')
        ->set('page.slug', '::slug::')
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
        ->livewire(ManagePageSettings::class, ['page' => $page])
        ->fill($payload)
        ->call('save')
        ->assertHasErrors([$key => $rule]);
})->with(function () {
    $defaultPayload = [
        'page.status' => 'draft',
        'page.slug' => '::slug::',
    ];

    yield from [
        'missing status' => [
            'payload' => array_merge($defaultPayload, [
                'page.status' => '',
            ]),
            'key' => 'page.status',
            'rule' => 'required',
        ],
        'invalid status' => [
            'payload' => array_merge($defaultPayload, [
                'page.status' => '::invalid-status::',
            ]),
            'key' => 'page.status',
            'rule' => 'in',
        ],
        'missing slug' => [
            'payload' => array_merge($defaultPayload, [
                'page.slug' => '',
            ]),
            'key' => 'page.slug',
            'rule' => 'required',
        ],
        'slug already exists' => [
            'payload' => $defaultPayload,
            'key' => 'page.slug',
            'rule' => 'unique',
            'setup' => function () use ($defaultPayload) {
                Post::factory()->page()->create()->fill([
                    'slug' => $defaultPayload['page.slug'],
                ])->save();
            },
        ],
    ];
});

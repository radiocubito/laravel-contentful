<?php

use Radiocubito\Wordful\Http\Livewire\UpdateSiteTitleAndDescriptionForm;
use Radiocubito\Wordful\Support\SiteConfiguration;
use Radiocubito\Wordful\Tests\Fixtures\User;
use Radiocubito\Wordful\Tests\SettingsFeatureEnabled;
use Radiocubito\Wordful\Wordful;

uses(SettingsFeatureEnabled::class);

beforeEach(function () {
    if (! is_dir(base_path('config-wordful-app'))) {
        mkdir(base_path('config-wordful-app'));
    }

    if (file_exists($storageFile = base_path('config-wordful-app/site.json'))) {
        unlink($storageFile);
    }
});

it('can see livewire update site title and description form component on general settings page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();

    test()->actingAs($user)->withoutExceptionHandling()
        ->get('wordful/settings/general')
        ->assertSuccessful()
        ->assertSeeLivewire('wordful::settings.update-site-title-and-description-form');
});

it('can save title and description site settings', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();

    test()->actingAs($user)
        ->livewire(UpdateSiteTitleAndDescriptionForm::class)
        ->set('state.name', '::name::')
        ->set('state.description', '::description::')
        ->call('save');

    app(SiteConfiguration::class)->registerConfigValues();

    expect(config('app.name'))->toBe('::name::');
    expect(config('site.description'))->toBe('::description::');
});

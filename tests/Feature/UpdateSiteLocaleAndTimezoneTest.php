<?php

use Radiocubito\Wordful\Http\Livewire\UpdateSiteLocaleAndTimeZone;
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

it('can see livewire update site locale and timezone form component on general settings page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();

    test()->actingAs($user)->withoutExceptionHandling()
        ->get('wordful/settings/general')
        ->assertSuccessful()
        ->assertSeeLivewire('wordful::settings.update-site-locale-and-timezone-form');
});

it('can save locale and timezone site settings', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();

    test()->actingAs($user)
        ->livewire(UpdateSiteLocaleAndTimeZone::class)
        ->set('state.locale', 'es')
        ->set('state.timezone', 'America/Mexico_City')
        ->call('save');

    app(SiteConfiguration::class)->registerConfigValues();

    expect(config('app.locale'))->toBe('es');
    expect(config('app.timezone'))->toBe('America/Mexico_City');
});

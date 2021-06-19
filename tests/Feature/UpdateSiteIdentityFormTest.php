<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Radiocubito\Wordful\Http\Livewire\UpdateSiteIdentityForm;
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

it('can see livewire update site identity form component on general settings page', function () {
    Wordful::useUserModel(User::class);

    $user = User::factory()->create();

    test()->actingAs($user)->withoutExceptionHandling()
        ->get('wordful/settings/general')
        ->assertSuccessful()
        ->assertSeeLivewire('wordful::settings.update-site-identity-form');
});

it('can save identity site settings', function () {
    Storage::fake('public');

    Wordful::useUserModel(User::class);

    $user = User::factory()->create();

    test()->actingAs($user)
        ->livewire(UpdateSiteIdentityForm::class)
        ->set('logo', UploadedFile::fake()->image('logo.png'))
        ->set('icon', UploadedFile::fake()->image('icon.png'))
        ->call('save');

    app(SiteConfiguration::class)->registerConfigValues();

    expect(config('site.icon_path'))->not()->toBeNull();
    expect(config('site.logo_path'))->not()->toBeNull();

    Storage::disk('public')->assertExists([config('site.logo_path'), config('site.icon_path')]);
});

it('can delete icon', function () {
    Storage::fake('public');

    Wordful::useUserModel(User::class);

    $user = User::factory()->create();

    test()->actingAs($user)
        ->livewire(UpdateSiteIdentityForm::class)
        ->set('icon', UploadedFile::fake()->image('icon.png'))
        ->call('save');

    app(SiteConfiguration::class)->registerConfigValues();

    expect(config('site.icon_path'))->not()->toBeNull();

    test()->actingAs($user)
        ->livewire(UpdateSiteIdentityForm::class)
        ->call('deleteSiteIcon');

    app(SiteConfiguration::class)->registerConfigValues();

    expect(config('site.icon_path'))->toBeNull();
});

it('can delete logo', function () {
    Storage::fake('public');

    Wordful::useUserModel(User::class);

    $user = User::factory()->create();

    test()->actingAs($user)
        ->livewire(UpdateSiteIdentityForm::class)
        ->set('logo', UploadedFile::fake()->image('logo.png'))
        ->call('save');

    app(SiteConfiguration::class)->registerConfigValues();

    expect(config('site.logo_path'))->not()->toBeNull();

    test()->actingAs($user)
        ->livewire(UpdateSiteIdentityForm::class)
        ->call('deleteSiteLogo');

    app(SiteConfiguration::class)->registerConfigValues();

    expect(config('site.logo_path'))->toBeNull();
});

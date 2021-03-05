<?php

namespace Radiocubito\Contentful;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Radiocubito\Contentful\Commands\ContentfulCommand;

class ContentfulServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-contentful')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_contentful_table')
            ->hasCommand(ContentfulCommand::class);
    }
}

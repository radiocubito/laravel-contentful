<?php

namespace Radiocubito\Contentful;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use Radiocubito\Contentful\Http\Livewire\CreatePost;
use Radiocubito\Contentful\Http\Livewire\EditPost;
use Radiocubito\Contentful\Http\Livewire\ShowPost;
use Radiocubito\Contentful\Http\Livewire\ShowPosts;
use Radiocubito\Contentful\View\Components\ContentfulLayout;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasAssets()
            ->hasRoute('web')
            ->hasMigration('create_contentful_tables');
    }

    public function packageRegistered()
    {
        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('contentful::posts.show-posts', ShowPosts::class);
            Livewire::component('contentful::posts.show-post', ShowPost::class);
            Livewire::component('contentful::posts.create-post', CreatePost::class);
            Livewire::component('contentful::posts.edit-post', EditPost::class);
        });
    }

    public function packageBooted()
    {
        $this->configureComponents();
    }

    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('input.rich-text');
            $this->registerComponent('input.errors');

            $this->registerComponent('application-logo');

            $this->registerComponent('dropdown');
            $this->registerComponent('dropdown.link');

            $this->registerComponent('nav.link');
            $this->registerComponent('nav.responsive-link');

            Blade::component(ContentfulLayout::class, 'contentful-layout');
        });
    }

    protected function registerComponent(string $component)
    {
        Blade::component('contentful::components.'.$component, 'contentful::'.$component);
    }
}

<?php

namespace Radiocubito\Wordful;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use Radiocubito\Wordful\Http\Livewire\CreatePage;
use Radiocubito\Wordful\Http\Livewire\CreatePost;
use Radiocubito\Wordful\Http\Livewire\EditPage;
use Radiocubito\Wordful\Http\Livewire\EditPost;
use Radiocubito\Wordful\Http\Livewire\ShowPage;
use Radiocubito\Wordful\Http\Livewire\ShowPages;
use Radiocubito\Wordful\Http\Livewire\ShowPost;
use Radiocubito\Wordful\Http\Livewire\ShowPosts;
use Radiocubito\Wordful\View\Components\WordfulLayout;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WordfulServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-wordful')
            ->hasConfigFile()
            ->hasViews()
            ->hasAssets()
            ->hasRoute('web')
            ->hasMigration('create_wordful_tables');
    }

    public function packageRegistered()
    {
        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('wordful::posts.show-posts', ShowPosts::class);
            Livewire::component('wordful::posts.show-post', ShowPost::class);
            Livewire::component('wordful::posts.create-post', CreatePost::class);
            Livewire::component('wordful::posts.edit-post', EditPost::class);

            Livewire::component('wordful::posts.show-pages', ShowPages::class);
            Livewire::component('wordful::posts.show-page', ShowPage::class);
            Livewire::component('wordful::posts.create-page', CreatePage::class);
            Livewire::component('wordful::posts.edit-page', EditPage::class);
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
            $this->registerComponent('input.textarea');
            $this->registerComponent('input.text');
            $this->registerComponent('input.tag');

            $this->registerComponent('application-logo');

            $this->registerComponent('dropdown');
            $this->registerComponent('dropdown.link');

            $this->registerComponent('button.primary');
            $this->registerComponent('button.secondary');

            $this->registerComponent('nav.link');
            $this->registerComponent('nav.responsive-link');

            Blade::component(WordfulLayout::class, 'wordful-layout');
        });
    }

    protected function registerComponent(string $component)
    {
        Blade::component('wordful::components.'.$component, 'wordful::'.$component);
    }
}

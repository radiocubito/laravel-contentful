<?php

namespace Radiocubito\Wordful;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use Radiocubito\Wordful\Console\InstallCommand;
use Radiocubito\Wordful\Console\MakeUser;
use Radiocubito\Wordful\Console\PublishCommand;
use Radiocubito\Wordful\Http\Livewire\Auth\ForgotPassword;
use Radiocubito\Wordful\Http\Livewire\Auth\Login;
use Radiocubito\Wordful\Http\Livewire\Auth\LogoutLink;
use Radiocubito\Wordful\Http\Livewire\Auth\ResetPassword;
use Radiocubito\Wordful\Http\Livewire\Auth\ResponsiveLogoutLink;
use Radiocubito\Wordful\Http\Livewire\CreatePage;
use Radiocubito\Wordful\Http\Livewire\CreatePost;
use Radiocubito\Wordful\Http\Livewire\EditPage;
use Radiocubito\Wordful\Http\Livewire\EditPost;
use Radiocubito\Wordful\Http\Livewire\EditTag;
use Radiocubito\Wordful\Http\Livewire\EmailPostToSubscribers;
use Radiocubito\Wordful\Http\Livewire\ManageGeneralSettings;
use Radiocubito\Wordful\Http\Livewire\ManagePageSettings;
use Radiocubito\Wordful\Http\Livewire\ManagePostSettings;
use Radiocubito\Wordful\Http\Livewire\ShowPage;
use Radiocubito\Wordful\Http\Livewire\ShowPages;
use Radiocubito\Wordful\Http\Livewire\ShowPost;
use Radiocubito\Wordful\Http\Livewire\ShowPosts;
use Radiocubito\Wordful\Http\Livewire\ShowTags;
use Radiocubito\Wordful\Http\Livewire\UpdateSiteIdentityForm;
use Radiocubito\Wordful\Http\Livewire\UpdateSiteLocaleAndTimeZone;
use Radiocubito\Wordful\Http\Livewire\UpdateSiteTitleAndDescriptionForm;
use Radiocubito\Wordful\Support\SiteConfiguration;
use Radiocubito\Wordful\View\Components\AuthLayout;
use Radiocubito\Wordful\View\Components\DashboardLayout;
use Radiocubito\Wordful\View\Components\HtmlLayout;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\Valuestore\Valuestore;

class WordfulServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('wordful')
            ->hasConfigFile()
            ->hasViews()
            ->hasAssets()
            ->hasRoute('web')
            ->hasMigration('create_wordful_tables')
            ->hasCommands([
                InstallCommand::class,
                PublishCommand::class,
                MakeUser::class,
            ]);
    }

    public function packageRegistered()
    {
        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('wordful::posts.show-posts', ShowPosts::class);
            Livewire::component('wordful::posts.show-post', ShowPost::class);
            Livewire::component('wordful::posts.create-post', CreatePost::class);
            Livewire::component('wordful::posts.edit-post', EditPost::class);
            Livewire::component('wordful::posts.manage-post-settings', ManagePostSettings::class);

            Livewire::component('wordful::pages.show-pages', ShowPages::class);
            Livewire::component('wordful::pages.show-page', ShowPage::class);
            Livewire::component('wordful::pages.create-page', CreatePage::class);
            Livewire::component('wordful::pages.edit-page', EditPage::class);
            Livewire::component('wordful::pages.manage-page-settings', ManagePageSettings::class);

            Livewire::component('wordful::pages.show-tags', ShowTags::class);
            Livewire::component('wordful::pages.edit-tag', EditTag::class);

            Livewire::component('wordful::email-post-to-subscribers', EmailPostToSubscribers::class);

            Livewire::component('wordful::auth.login', Login::class);
            Livewire::component('wordful::auth.forgot-password', ForgotPassword::class);
            Livewire::component('wordful::auth.reset-password', ResetPassword::class);

            Livewire::component('wordful::auth.logout-link', LogoutLink::class);
            Livewire::component('wordful::auth.responsive-logout-link', ResponsiveLogoutLink::class);

            Livewire::component('wordful::settings.manage-general-settings', ManageGeneralSettings::class);
            Livewire::component('wordful::settings.update-site-title-and-description-form', UpdateSiteTitleAndDescriptionForm::class);
            Livewire::component('wordful::settings.update-site-locale-and-timezone-form', UpdateSiteLocaleAndTimeZone::class);
            Livewire::component('wordful::settings.update-site-identity-form', UpdateSiteIdentityForm::class);
        });

        $this->registerGeneralConfiguration();
    }

    public function bootingPackage()
    {
        Route::middlewareGroup('wordful', config('wordful.middleware', []));

        Route::middlewareGroup('subscribers', config('wordful.subscribers-middleware', []));
    }

    public function packageBooted()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../stubs/WordfulServiceProvider.stub' => app_path('Providers/WordfulServiceProvider.php'),
            ], 'wordful-provider');
        }

        $this->configureComponents();

        $this->bootTranslations();
    }

    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('input.errors');
            $this->registerComponent('input.textarea');
            $this->registerComponent('input.text');
            $this->registerComponent('input.label');
            $this->registerComponent('input.error');
            $this->registerComponent('input.select');
            $this->registerComponent('input.section');
            $this->registerComponent('input.section-actions');
            $this->registerComponent('input.inline-group');
            $this->registerComponent('input.editor');

            $this->registerComponent('application-logo');

            $this->registerComponent('dropdown');
            $this->registerComponent('dropdown.link');

            $this->registerComponent('button.primary');
            $this->registerComponent('button.secondary');

            $this->registerComponent('status.auth-session');

            $this->registerComponent('subscribers-layout');

            $this->registerComponent('navbar');
            $this->registerComponent('mobile-menu');
            $this->registerComponent('page-heading');
            $this->registerComponent('sidebar-navigation');

            $this->registerComponent('button');
            $this->registerComponent('button.back');
            $this->registerComponent('button.edit');
            $this->registerComponent('button.options');
            $this->registerComponent('button.settings');
            $this->registerComponent('button.switch');

            $this->registerComponent('icon.back');
            $this->registerComponent('icon.edit');
            $this->registerComponent('icon.new-post');
            $this->registerComponent('icon.new');
            $this->registerComponent('icon.options');
            $this->registerComponent('icon.page');
            $this->registerComponent('icon.post');
            $this->registerComponent('icon.settings');
            $this->registerComponent('icon.tag');

            $this->registerComponent('icon.bold');
            $this->registerComponent('icon.code');
            $this->registerComponent('icon.figure');
            $this->registerComponent('icon.h1');
            $this->registerComponent('icon.h2');
            $this->registerComponent('icon.hr');
            $this->registerComponent('icon.image');
            $this->registerComponent('icon.italic');
            $this->registerComponent('icon.link');
            $this->registerComponent('icon.ol');
            $this->registerComponent('icon.paragraph');
            $this->registerComponent('icon.pre');
            $this->registerComponent('icon.quote');
            $this->registerComponent('icon.redo');
            $this->registerComponent('icon.strike');
            $this->registerComponent('icon.ul');
            $this->registerComponent('icon.undo');
            $this->registerComponent('icon.unlink');

            $this->registerComponent('posts-lists');
            $this->registerComponent('mobile-posts-lists');
            $this->registerComponent('pages-lists');
            $this->registerComponent('mobile-pages-lists');

            Blade::component(HtmlLayout::class, 'wf-html');
            Blade::component(DashboardLayout::class, 'wf-dashboard');
            Blade::component(AuthLayout::class, 'auth-layout');
        });
    }

    protected function registerComponent(string $component)
    {
        Blade::component('wordful::components.'.$component, 'wordful::'.$component);
    }

    protected function bootTranslations()
    {
        $this->loadJSONTranslationsFrom(__DIR__ . '/../resources/lang/');
    }

    protected function registerGeneralConfiguration()
    {
        $this->app->bind(SiteConfiguration::class, function () {
            $valueStore = Valuestore::make(base_path('config-wordful-app/site.json'));

            return new SiteConfiguration(
                $valueStore,
                app()->get('config'),
            );
        });

        app(SiteConfiguration::class)->registerConfigValues();
    }
}

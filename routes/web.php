<?php

use Radiocubito\Wordful\Wordful;
use Radiocubito\Wordful\Models\Post;
use Illuminate\Support\Facades\Route;
use Radiocubito\Wordful\Http\Livewire\EditTag;
use Radiocubito\Wordful\Http\Livewire\EditPage;
use Radiocubito\Wordful\Http\Livewire\EditPost;
use Radiocubito\Wordful\Http\Livewire\ShowPage;
use Radiocubito\Wordful\Http\Livewire\ShowPost;
use Radiocubito\Wordful\Http\Livewire\ShowTags;
use Radiocubito\Wordful\Http\Livewire\ShowPages;
use Radiocubito\Wordful\Http\Livewire\ShowPosts;
use Radiocubito\Wordful\Http\Livewire\Auth\Login;
use Radiocubito\Wordful\Http\Livewire\CreatePage;
use Radiocubito\Wordful\Http\Livewire\CreatePost;
use Radiocubito\Wordful\Http\Livewire\ShowPageDrafts;
use Radiocubito\Wordful\Http\Livewire\ShowPostDrafts;
use Radiocubito\Wordful\Http\Livewire\Auth\ResetPassword;
use Radiocubito\Wordful\Http\Livewire\ManagePageSettings;
use Radiocubito\Wordful\Http\Livewire\ManagePostSettings;
use Radiocubito\Wordful\Http\Livewire\Auth\ForgotPassword;
use Radiocubito\Wordful\Http\Livewire\ManageGeneralSettings;
use Radiocubito\Wordful\Http\Controllers\SubscribersController;
use Radiocubito\Wordful\Http\Controllers\ConfirmedSubscriberController;
use Radiocubito\Wordful\Http\Controllers\UnsubscribeSubscriberController;

Route::prefix('wordful')
    ->middleware('wordful')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->to(route('wordful.posts.index'));
        });

        Route::get('/posts', ShowPosts::class)->name('wordful.posts.index');
        Route::get('/posts/drafts', ShowPostDrafts::class)->name('wordful.posts.drafts.index');
        Route::get('/posts/create', CreatePost::class)->name('wordful.posts.create');
        Route::get('/posts/{post}', ShowPost::class)->name('wordful.posts.show');
        Route::get('/posts/{post}/edit', EditPost::class)->name('wordful.posts.edit');
        Route::get('/posts/{post}/settings', ManagePostSettings::class)->name('wordful.posts.settings');

        Route::get('/pages', ShowPages::class)->name('wordful.pages.index');
        Route::get('/pages/drafts', ShowPageDrafts::class)->name('wordful.pages.drafts.index');
        Route::get('/pages/create', CreatePage::class)->name('wordful.pages.create');
        Route::get('/pages/{page}', ShowPage::class)->name('wordful.pages.show');
        Route::get('/pages/{page}/edit', EditPage::class)->name('wordful.pages.edit');
        Route::get('/pages/{page}/settings', ManagePageSettings::class)->name('wordful.pages.settings');

        Route::get('/tags', ShowTags::class)->name('wordful.tags.index');
        Route::get('/tags/{tag}/edit', EditTag::class)->name('wordful.tags.edit');

        if (Wordful::managesSettings()) {
            Route::get('/settings/general', ManageGeneralSettings::class)->name('wordful.settings.general');
        }
    });

Route::prefix('/')
    ->middleware('subscribers')
    ->group(function () {
        Route::get('/subscribers/create', [SubscribersController::class, 'create'])->withoutMiddleware('signed')->name('wordful.subscribers.create');
        Route::post('/subscribers', [SubscribersController::class, 'store'])->withoutMiddleware('signed')->name('wordful.subscribers.store');

        Route::view('/subscribers/unsubscribed', 'wordful::subscribers.unsubscribed')->withoutMiddleware('signed')->name('wordful.subscribers.unsubscribed.index');

        Route::get('/subscribers/{subscriber}', [SubscribersController::class, 'show'])->name('wordful.subscribers.show');

        Route::get('/subscribers/{subscriber}/confirmed', [ConfirmedSubscriberController::class, 'index'])->name('wordful.subscribers.confirmed.index');
        Route::post('/subscribers/{subscriber}/confirmed', [ConfirmedSubscriberController::class, 'store'])->name('wordful.subscribers.confirmed.store');

        Route::get('/subscribers/{subscriber}/unsubscribe', [UnsubscribeSubscriberController::class, 'index'])->name('wordful.subscribers.unsubscribe.index');
        Route::post('/subscribers/{subscriber}/unsubscribe', [UnsubscribeSubscriberController::class, 'store'])->name('wordful.subscribers.unsubscribe.store');
    });

if (Wordful::hasAuthenticationFeature()) {
    Route::get('/wordful/login', Login::class)->middleware(['web', 'guest'])->name('wordful.auth.login');
    Route::get('/wordful/forgot-password', ForgotPassword::class)->middleware(['web', 'guest'])->name('wordful.password.request');
    Route::get('/wordful/reset-password/{token}', ResetPassword::class)->middleware(['web', 'guest'])->name('wordful.password.reset');
}

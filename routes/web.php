<?php

use Illuminate\Support\Facades\Route;
use Radiocubito\Wordful\Http\Livewire\CreatePage;
use Radiocubito\Wordful\Http\Livewire\CreatePost;
use Radiocubito\Wordful\Http\Livewire\EditPage;
use Radiocubito\Wordful\Http\Livewire\EditPost;
use Radiocubito\Wordful\Http\Livewire\EditTag;
use Radiocubito\Wordful\Http\Livewire\ManagePageSettings;
use Radiocubito\Wordful\Http\Livewire\ManagePostSettings;
use Radiocubito\Wordful\Http\Livewire\ShowPage;
use Radiocubito\Wordful\Http\Livewire\ShowPageDrafts;
use Radiocubito\Wordful\Http\Livewire\ShowPages;
use Radiocubito\Wordful\Http\Livewire\ShowPost;
use Radiocubito\Wordful\Http\Livewire\ShowPostDrafts;
use Radiocubito\Wordful\Http\Livewire\ShowPosts;
use Radiocubito\Wordful\Http\Livewire\ShowTags;

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
        Route::get('/pages/{post}', ShowPage::class)->name('wordful.pages.show');
        Route::get('/pages/{post}/edit', EditPage::class)->name('wordful.pages.edit');
        Route::get('/pages/{post}/settings', ManagePageSettings::class)->name('wordful.pages.settings');

        Route::get('/tags', ShowTags::class)->name('wordful.tags.index');
        Route::get('/tags/{tag}/edit', EditTag::class)->name('wordful.tags.edit');
    });

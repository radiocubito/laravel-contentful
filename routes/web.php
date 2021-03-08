<?php

use Illuminate\Support\Facades\Route;
use Radiocubito\Contentful\Http\Livewire\CreatePage;
use Radiocubito\Contentful\Http\Livewire\CreatePost;
use Radiocubito\Contentful\Http\Livewire\EditPage;
use Radiocubito\Contentful\Http\Livewire\EditPost;
use Radiocubito\Contentful\Http\Livewire\ShowPage;
use Radiocubito\Contentful\Http\Livewire\ShowPageDrafts;
use Radiocubito\Contentful\Http\Livewire\ShowPages;
use Radiocubito\Contentful\Http\Livewire\ShowPost;
use Radiocubito\Contentful\Http\Livewire\ShowPostDrafts;
use Radiocubito\Contentful\Http\Livewire\ShowPosts;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/contentful', function () {
        return redirect()->to(route('contentful.posts.index'));
    });

    Route::get('/contentful/posts', ShowPosts::class)->name('contentful.posts.index');
    Route::get('/contentful/posts/drafts', ShowPostDrafts::class)->name('contentful.posts.drafts.index');
    Route::get('/contentful/posts/create', CreatePost::class)->name('contentful.posts.create');
    Route::get('/contentful/posts/{post}', ShowPost::class)->name('contentful.posts.show');
    Route::get('/contentful/posts/{post}/edit', EditPost::class)->name('contentful.posts.edit');

    Route::get('/contentful/pages', ShowPages::class)->name('contentful.pages.index');
    Route::get('/contentful/pages/drafts', ShowPageDrafts::class)->name('contentful.pages.drafts.index');
    Route::get('/contentful/pages/create', CreatePage::class)->name('contentful.pages.create');
    Route::get('/contentful/pages/{post}', ShowPage::class)->name('contentful.pages.show');
    Route::get('/contentful/pages/{post}/edit', EditPage::class)->name('contentful.pages.edit');
});

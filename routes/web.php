<?php

use Illuminate\Support\Facades\Route;
use Radiocubito\Contentful\Http\Livewire\CreatePost;
use Radiocubito\Contentful\Http\Livewire\EditPost;
use Radiocubito\Contentful\Http\Livewire\ShowPost;
use Radiocubito\Contentful\Http\Livewire\ShowPosts;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/contentful/posts/', ShowPosts::class)->name('contentful.posts.index');
    Route::get('/contentful/posts/create', CreatePost::class)->name('contentful.posts.create');
    Route::get('/contentful/posts/{post}', ShowPost::class)->name('contentful.posts.show');
    Route::get('/contentful/posts/{post}/edit', EditPost::class)->name('contentful.posts.edit');
});

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('admin.index'))->name('admin.index');

Route::get('/login', fn () => view('admin.login'))->name('admin.login');

Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
    Route::get('/', fn () => view('admin.posts.index'))->name('index');
    Route::get('/create', fn () => view('admin.posts.create'))->name('create');
});

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('/', fn () => view('admin.users.index'))->name('index');
    Route::get('/create', fn () => view('admin.users.create'))->name('create');
});
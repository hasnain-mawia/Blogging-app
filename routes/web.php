<?php

use App\Http\Controllers\Auth\CategoryController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\TagsController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', function () {
    auth()->logout();
    // return view('welcome');
});

Auth::routes([
    'register' => false
]);

Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::resource('auth/posts', PostController::class);
Route::get('auth/categories', [CategoryController::class, 'openCategoriesPage'])->name('auth.categories');
Route::get('auth/tags', [TagsController::class, 'openTagsPage'])->name('auth.tags');

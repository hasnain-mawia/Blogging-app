<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', function () {
    auth()->logout();
    // return view('welcome');
});
// Route::view('/dashboard', 'auth.dashboard');

Auth::routes([
    'register' => false
]);

Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

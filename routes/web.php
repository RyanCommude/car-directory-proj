<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', App\Livewire\Home::class)->name('home');

Route::middleware('auth')->get('/dashboard', App\Livewire\Dashboard::class)->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', App\Livewire\Dashboard::class)->name('dashboard');
    Route::get('/user-creation', App\Livewire\UserCreation::class)->name('user-creation');
});

Route::prefix('user')->group(function () {
    Route::get('/login', App\Livewire\User\Auth\Login::class)->name('user.login');
});

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user-list', App\Livewire\UserList::class)->name('user-list');
    Route::get('/user-creation', App\Livewire\UserCreation::class)->name('user-creation');
    Route::get('/car-list', App\Livewire\CarList::class)->name('car-list');
});

Route::prefix('user')->group(function () {
    Route::get('/login', App\Livewire\User\Auth\Login::class)->name('user.login');
});

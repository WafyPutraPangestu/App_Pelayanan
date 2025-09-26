<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest/welcome');
})->name('guest.welcome');

// ROUTE LOGIN REGISTER DAN REQUEST POST LOGIN DAN REGISTER
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('auth.register');
    Route::post('register', 'registerStore')->name('auth.registerStore');
    Route::get('login', 'login')->name('auth.login');
    Route::post('login', 'loginStore')->name('auth.store');
});
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

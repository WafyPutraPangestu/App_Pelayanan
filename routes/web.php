<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DomisiliController;
use App\Http\Controllers\KeteranganLahirController;
use App\Http\Controllers\KeteranganMenikahController;
use App\Http\Controllers\pengaduanController;
use App\Http\Controllers\SkmController;
use App\Http\Controllers\SktmController;
use App\Http\Controllers\SkuController;
use App\Http\Controllers\suratController;
use App\Http\Controllers\SuratPengantarController;
use App\Http\Controllers\trackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest/welcome');
})->name('guest.welcome');

// ROUTE LOGIN REGISTER DAN REQUEST POST LOGIN DAN REGISTER
Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('register', 'register')->name('auth.register');
        Route::post('register', 'registerStore')->name('auth.registerStore');
        Route::get('login', 'login')->name('auth.login');
        Route::post('login', 'loginStore')->name('auth.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});


Route::middleware(['auth', 'user'])->group(function () {
    Route::resource('domisili', DomisiliController::class);
    Route::resource('sku', SkuController::class);
    Route::resource('sktm', SktmController::class);
    Route::resource('skm', SkmController::class);
    Route::resource('surat_pengantar', SuratPengantarController::class);
    Route::resource('keterangan_lahir', KeteranganLahirController::class);
    Route::resource('keterangan_menikah', KeteranganMenikahController::class);
    Route::get('surat',[suratController::class, 'index'])->name('surat.index');
    // Pastikan nama method di route sama dengan nama method di controller ('index')
Route::get('tracking', [TrackingController::class, 'index'])->name('surat.tracking');
Route::get('pengaduan.index',[pengaduanController::class, 'index'])->name('pengaduan.index');
Route::get('pengaduan.create', [pengaduanController::class, 'create'])->name('pengaduan.create');
Route::post('pengaduan.create', [pengaduanController::class, 'store'])->name('pengaduan.store');

});
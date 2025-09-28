<?php

use App\Http\Controllers\admin\BeritaController;
use App\Http\Controllers\admin\DataDashboardController;
use App\Http\Controllers\admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\admin\PengajuanSuratController;
use App\Http\Controllers\admin\SuratMasukController;
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
        Route::get('login', 'login')->name('login');
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

});

// Ganti semua route pengaduan Anda dengan ini:
Route::resource('pengaduan', pengaduanController::class)->middleware(['auth', 'user']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('dataDashboard', DataDashboardController::class);
    Route::resource('berita', BeritaController::class)->parameters([
        'berita' => 'berita'
    ]);
    Route::resource('pengaduanAdmin', AdminPengaduanController::class)->parameters([
        'pengaduanAdmin' => 'pengaduan'
    ]);

    // Route::resource('pengajuanSurat', PengajuanSuratController::class);
    Route::get('pengajuanSurat', [PengajuanSuratController::class, 'index'])->name('pengajuanSurat.index');
    Route::get('pengajuanSurat/{jenis}/{id}', [PengajuanSuratController::class, 'show'])->name('pengajuanSurat.show');
    Route::put('pengajuanSurat/{jenis}/{id}', [PengajuanSuratController::class, 'update'])->name('pengajuanSurat.update');
    Route::post('pengajuanSurat/batch-update', [PengajuanSuratController::class, 'batchUpdate'])->name('pengajuanSurat.batchUpdate');
    
    // Fitur yang akan diimplementasi nanti:
    Route::get('pengajuanSurat/{jenis}/{id}/download', [PengajuanSuratController::class, 'download'])->name('pengajuanSurat.download');
    // Route::post('pengajuanSurat/{jenis}/{id}/upload-signed', [PengajuanSuratController::class, 'uploadSigned'])->name('pengajuanSurat.uploadSigned');
    Route::get('suratMasuk/{suratMasuk}/download', [SuratMasukController::class, 'download'])
    ->name('suratMasuk.download');

// ✅ Route untuk batch update / delete
Route::post('suratMasuk/batch-update', [SuratMasukController::class, 'batchUpdate'])
    ->name('suratMasuk.batchUpdate');

// ✅ Route untuk laporan
Route::get('suratMasuk-report', [SuratMasukController::class, 'report'])
    ->name('suratMasuk.report');

    Route::resource('suratMasuk', SuratMasukController::class);
    
});
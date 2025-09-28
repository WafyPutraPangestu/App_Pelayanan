<?php

use App\Http\Controllers\admin\AdminProfileController;
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
use App\Http\Controllers\user\beritaController as UserBeritaController;
use App\Http\Controllers\user\SuratMasukController as UserSuratMasukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\DahboardController as UserDashboardController;
use App\Http\Controllers\admin\DahboardController as AdminDashboardController;
use App\Http\Controllers\user\UserProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});


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
    Route::resource('UserProfile', UserProfileController::class);
    
    Route::resource('domisili', DomisiliController::class);
    Route::resource('sku', SkuController::class);
    Route::resource('sktm', SktmController::class);
    Route::resource('skm', SkmController::class);
    Route::resource('surat_pengantar', SuratPengantarController::class);
    Route::resource('keterangan_lahir', KeteranganLahirController::class);
    Route::resource('keterangan_menikah', KeteranganMenikahController::class);
    Route::get('surat',[suratController::class, 'index'])->name('surat.index');
    Route::get('UserBerita',[UserBeritaController::class, 'index'])->name('user.berita.index');
    Route::get('UserBerita/{berita}',[UserBeritaController::class, 'show'])->name('user.berita.show');
    Route::get('UserSuratMasuk/{suratMasuk}/download', [UserSuratMasukController::class, 'download'])->name('UserSuratMasuk.download');
    Route::get('UserSuratMasuk', [UserSuratMasukController::class, 'index'])->name('UserSuratMasuk.index');

    Route::get('UserDashboard', [UserDashboardController::class, 'index'])->name('UserDashboard.index');
    
Route::get('tracking', [TrackingController::class, 'index'])->name('surat.tracking');

});


Route::resource('pengaduan', pengaduanController::class)->middleware(['auth', 'user']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('AdminProfiles', AdminProfileController::class);
    Route::resource('dataDashboard', DataDashboardController::class);
    Route::resource('berita', BeritaController::class)->parameters([
        'berita' => 'berita'
    ]);
    Route::resource('pengaduanAdmin', AdminPengaduanController::class)->parameters([
        'pengaduanAdmin' => 'pengaduan'
    ]);

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('pengajuanSurat', [PengajuanSuratController::class, 'index'])->name('pengajuanSurat.index');
    Route::get('pengajuanSurat/{jenis}/{id}', [PengajuanSuratController::class, 'show'])->name('pengajuanSurat.show');
    Route::put('pengajuanSurat/{jenis}/{id}', [PengajuanSuratController::class, 'update'])->name('pengajuanSurat.update');
    Route::post('pengajuanSurat/batch-update', [PengajuanSuratController::class, 'batchUpdate'])->name('pengajuanSurat.batchUpdate');
    
    
    Route::get('pengajuanSurat/{jenis}/{id}/download', [PengajuanSuratController::class, 'download'])->name('pengajuanSurat.download');
    
    Route::get('suratMasuk/{suratMasuk}/download', [SuratMasukController::class, 'download'])
    ->name('suratMasuk.download');


Route::post('suratMasuk/batch-update', [SuratMasukController::class, 'batchUpdate'])
    ->name('suratMasuk.batchUpdate');


Route::get('suratMasuk-report', [SuratMasukController::class, 'report'])
    ->name('suratMasuk.report');

    Route::resource('suratMasuk', SuratMasukController::class);
    
});
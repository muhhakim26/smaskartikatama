<?php

use App\Http\Controllers\Area\AreaIndonesiaController;
use App\Http\Controllers\Auth\AutentikasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Menu\AdminController;
use App\Http\Controllers\Menu\BeritaController;
use App\Http\Controllers\Menu\DataGuruController;
use App\Http\Controllers\Menu\EkstrakurikulerController;
use App\Http\Controllers\Menu\GaleriFotoController;
use App\Http\Controllers\Menu\GaleriVideoController;
use App\Http\Controllers\Menu\KontakController;
use App\Http\Controllers\Menu\OsisController;
use App\Http\Controllers\Menu\PpdbController;
use App\Http\Controllers\Menu\SambutanKepsekController;
use App\Http\Controllers\Menu\SejarahController;
use App\Http\Controllers\Menu\StrukturOrganisasiController;
use App\Http\Controllers\Menu\VisiMisiController;
use App\Http\Controllers\Respon\ResponBerkasController;
use Illuminate\Support\Facades\Route;

/*
|------------------------------------------------------------------------------------------------------------------
| User Routes
|------------------------------------------------------------------------------------------------------------------
 */
Route::controller(HomeController::class)->group(function () {
    // Menu Home
    Route::get('/', 'index')->name('home');
    // Menu Tentang Kami
    Route::get('sambutan-kepala-sekolah', 'sambutan')->name('sambutan');
    Route::get('visi-dan-misi', 'visiMisi')->name('visi-misi');
    Route::get('sejarah', 'sejarah')->name('sejarah');
    Route::get('struktur-organisasi', 'strukturOrganisasi')->name('struktur-organisasi');
    Route::get('guru', 'guru')->name('guru');
    // Menu Berita
    Route::get('berita', 'berita')->name('berita');
    // Menu Galeri
    Route::get('foto', 'foto')->name('foto');
    Route::get('video', 'video')->name('video');
    // Menu PPDB
    Route::get('ppdb', 'ppdb')->name('ppdb');
    // Menu OSIS
    Route::get('osis', 'osis')->name('osis');
    // Menu Kontak
    Route::get('kontak', 'kontak')->name('kontak');
});

/*
|------------------------------------------------------------------------------------------------------------------
| Admin Routes
|------------------------------------------------------------------------------------------------------------------
 */
Route::controller(AutentikasiController::class)->group(function () {
    Route::middleware('guest:admin')->name('admin.')->group(function () {
        Route::get('admin/login', 'loginFormPage')->name('login');
        Route::post('admin/login', 'loginForm');
    });
    Route::middleware('auth:admin')->name('admin.')->group(function () {
        Route::get('admin/ubah-sandi', 'changePasswordPage')->name('ubah-sandi');
        Route::put('admin/ubah-sandi/{id}', 'changePassword');
    });
    Route::middleware('auth:admin')->post('admin/logout', 'logout')->name('logout');
});

Route::middleware('auth:admin')->prefix('dashboard')->group(function () {
    Route::get('/', function () {return view('menu.dashboard');})->name('dashboard');
    Route::resource('admin', AdminController::class);
    Route::get('uploads/s/{path}', [ResponBerkasController::class, 'berkas'])->where('path', '.*')->name('berkas');

    $uri = [
        'kelola-sambutan-kepsek' => SambutanKepsekController::class,
        'kelola-ekstrakurikuler' => EkstrakurikulerController::class,
        'kelola-struktur-organisasi' => StrukturOrganisasiController::class,
        'kelola-visi-misi' => VisiMisiController::class,
        'kelola-sejarah' => SejarahController::class,
        'kelola-data-guru' => DataGuruController::class,
        'kelola-berita' => BeritaController::class,
        'kelola-galeri-foto' => GaleriFotoController::class,
        'kelola-galeri-video' => GaleriVideoController::class,
        'kelola-kontak' => KontakController::class,
        'kelola-osis' => OsisController::class,
        'kelola-ppdb' => PpdbController::class,
    ];
    Route::resources($uri);

});

/*
|------------------------------------------------------------------------------------------------------------------
| Area Routes
|------------------------------------------------------------------------------------------------------------------
 */
Route::middleware('csrf_get')->prefix('data')->controller(AreaIndonesiaController::class)->group(function () {
    Route::get('provinces', 'provinces')->name('provinces');
    Route::get('regencies', 'regencies')->name('regencies');
    Route::get('districts', 'districts')->name('districts');
    Route::get('villages', 'villages')->name('villages');
});

Route::fallback(function () {
    // Logika untuk menangani NotFoundHttpException
    abort(404); // Not Found
});

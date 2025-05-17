<?php

use App\Http\Controllers\Area\AreaIndonesiaController;
use App\Http\Controllers\Auth\AutentikasiController;
use App\Http\Controllers\Auth\RegistrasiSiswaController;
use App\Http\Controllers\Menu\AdminController;
use App\Http\Controllers\Menu\BeritaController;
use App\Http\Controllers\Menu\DashboardController;
use App\Http\Controllers\Menu\DataGuruController;
use App\Http\Controllers\Menu\EkstrakurikulerController;
use App\Http\Controllers\Menu\GaleriFotoController;
use App\Http\Controllers\Menu\GaleriVideoController;
use App\Http\Controllers\Menu\GelombangPendaftaranController;
use App\Http\Controllers\Menu\InfoPpdbController;
use App\Http\Controllers\Menu\KontakController;
use App\Http\Controllers\Menu\OsisController;
use App\Http\Controllers\Menu\PpdbController;
use App\Http\Controllers\Menu\SambutanKepsekController;
use App\Http\Controllers\Menu\SejarahController;
use App\Http\Controllers\Menu\StrukturOrganisasiController;
use App\Http\Controllers\Menu\VisiMisiController;
use App\Http\Controllers\Respon\ResponBerkasController;
use App\Http\Controllers\Siswa\SiswaController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

/*
 * |------------------------------------------------------------------------------------------------------------------
 * | User Routes
 * |------------------------------------------------------------------------------------------------------------------
 */

Route::controller(GuestController::class)->group(function () {
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
    Route::get('info-berita/{id}', 'infoberita')->name('infoberita');
    // Menu Galeri
    Route::get('foto', 'foto')->name('foto');
    Route::get('video', 'video')->name('video');
    // Menu Info PPDB
    Route::get('info-ppdb', 'infoPpdb')->name('info-ppdb');
    // Menu PPDB
    Route::name('ppdb.')->group(function () {
        Route::get('ppdb/{ppdb}', 'ppdb')->name('index');
        Route::post('ppdb/{ppdb}', 'ppdb')->name('store');
    });
    // Menu OSIS
    Route::get('osis', 'osis')->name('osis');
    // Menu Ekstrakurikuler
    Route::get('ekstrakurikuler', 'ekstrakurikuler')->name('ekstrakurikuler');
    Route::get('info-ekstrakurikuler/{id}', 'infoekstrakurikuler')->name('infoekstrakurikuler');
    // Menu Kontak
    Route::get('kontak', 'kontak')->name('kontak');
});

/*
 * |------------------------------------------------------------------------------------------------------------------
 * | Admin Routes
 * |------------------------------------------------------------------------------------------------------------------
 */
Route::controller(AutentikasiController::class)->group(function () {
    Route::middleware('guest:admin,siswa')->name('admin.')->group(function () {
        Route::get('login', 'loginFormPage')->name('login');
        Route::post('login', 'loginForm');
    });
    Route::middleware('auth:admin')->name('admin.')->group(function () {
        Route::get('admin/ubah-sandi', 'changePasswordPage')->name('ubah-sandi');
        Route::put('admin/ubah-sandi/{id}', 'changePassword')->name('ubah-sandi.update');
    });
    Route::middleware('auth:admin,siswa')->post('logout', 'logout')->name('logout');
});

Route::middleware('auth:admin')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profil', [AdminController::class, 'profil'])->name('profil');
    Route::put('{profil}', [AdminController::class, 'update'])->name('profil.update');
    Route::resource('kelola-admin', AdminController::class)->middleware('can:isSuperAdmin');
    Route::prefix('kelola-berita')->controller(BeritaController::class)->group(function () {
        Route::get('/', 'index')->name('kelola-berita.index');
        Route::get('create', 'create')->name('kelola-berita.create');
        Route::post('/', 'store')->name('kelola-berita.store');
        Route::get('{kelola_berita}', 'show')->name('kelola-berita.show');
        Route::get('{kelola_berita}/edit', 'edit')->name('kelola-berita.edit');
        Route::put('{kelola_berita}', 'update')->name('kelola-berita.update');
        Route::delete('{kelola_berita}', 'destroy')->name('kelola-berita.destroy');
    });
    Route::resource('kelola-data-guru', DataGuruController::class);
    Route::resource('kelola-ekstrakurikuler', EkstrakurikulerController::class);
    Route::resource('kelola-galeri-foto', GaleriFotoController::class);
    Route::resource('kelola-galeri-video', GaleriVideoController::class);
    Route::post('kelola-gelombang-pendaftaran/aksi/{aksi}', [GelombangPendaftaranController::class, 'aksi'])->name('kelola-gelombang-pendaftaran.status');
    Route::resource('kelola-gelombang-pendaftaran', GelombangPendaftaranController::class)->except(['create', 'show', 'destroy', 'store']);
    Route::resource('kelola-info-ppdb', InfoPpdbController::class)->except(['create', 'show', 'edit', 'update', 'destroy']);
    Route::resource('kelola-kontak', KontakController::class)->except(['create', 'show', 'edit', 'update', 'destroy']);
    Route::prefix('kelola-osis')->controller(OsisController::class)->group(function () {
        Route::get('/', 'index')->name('kelola-osis.index');
        // Route::get('create', 'create')->name('kelola-osis.create');
        Route::post('/', 'store')->name('kelola-osis.store');
        // Route::get('{kelola_osis}', 'show')->name('kelola-osis.show');
        // Route::get('{kelola_osis}/edit', 'edit')->name('kelola-osis.edit');
        // Route::put('{kelola_osis}', 'update')->name('kelola-osis.update');
        Route::delete('{kelola_osis}', 'destroy')->name('kelola-osis.destroy');
    });
    Route::put('kelola-ppdb/terima/{id}', [PpdbController::class, 'terimaSiswa'])->name('kelola-ppdb.terima-siswa');
    Route::put('kelola-ppdb/approve_berkas/{nama_berkas}/{id}', [PpdbController::class, 'terimaBerkas'])->name('kelola-ppdb.terima-berkas');
    Route::put('kelola-ppdb/tolak_berkas/{nama_berkas}/{id}', [PpdbController::class, 'tolakBerkas'])->name('kelola-ppdb.tolak-berkas');
    Route::get('kelola-ppdb/excel', [PpdbController::class, 'excel'])->name('kelola-ppdb.excel');
    Route::resource('kelola-ppdb', PpdbController::class)->except(['create', 'destroy']);
    Route::resource('kelola-sambutan-kepsek', SambutanKepsekController::class)->except(['create', 'show', 'edit', 'update', 'destroy']);;
    Route::resource('kelola-sejarah', SejarahController::class)->except(['create', 'show', 'edit', 'update', 'destroy']);;
    Route::resource('kelola-struktur-organisasi', StrukturOrganisasiController::class)->except(['create', 'show', 'edit', 'update']);
    Route::resource('kelola-visi-misi', VisiMisiController::class)->except(['create', 'show', 'edit', 'update', 'destroy']);;

    Route::get('uploads/s/{path}', [ResponBerkasController::class, 'berkas'])->where('path', '.*')->name('berkas');
});

/*
 * |------------------------------------------------------------------------------------------------------------------
 * | Area Routes
 * |------------------------------------------------------------------------------------------------------------------
 */
Route::middleware('csrf_get')->prefix('data')->controller(AreaIndonesiaController::class)->group(function () {
    Route::get('provinces', 'provinces')->name('provinces');
    Route::get('regencies', 'regencies')->name('regencies');
    Route::get('districts', 'districts')->name('districts');
    Route::get('villages', 'villages')->name('villages');
});

/*
 * |------------------------------------------------------------------------------------------------------------------
 * | Siswa Routes
 * |------------------------------------------------------------------------------------------------------------------
 */
Route::middleware('auth:siswa,admin')->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('dashboard', [SiswaController::class, 'index'])->name('dashboard');
    Route::get('{siswa}/edit', [SiswaController::class, 'edit'])->name('edit');
    Route::put('{siswa}', [SiswaController::class, 'update'])->name('update');
    Route::get('uploads/s/{path}', [ResponBerkasController::class, 'berkas'])->where('path', '.*')->name('berkas');
});

Route::fallback(function () {
    // Logika untuk menangani NotFoundHttpException
    abort(404);  // Not Found
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilFakultasController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\KategoriGaleriController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\InformasiPmbController;
use App\Http\Controllers\Admin\JadwalPmbController;
use App\Http\Controllers\Admin\BiayaController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Frontend\PageController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Statis / Placeholder Frontend (Phase 6)
Route::get('/profil', [PageController::class, 'profil'])->name('profil');
Route::get('/program-studi', [PageController::class, 'programStudi'])->name('program-studi');
Route::get('/program-studi/{slug}', [PageController::class, 'programStudiShow'])->name('program-studi.show');
Route::get('/fasilitas', [PageController::class, 'fasilitas'])->name('fasilitas');
Route::get('/prestasi', [PageController::class, 'prestasi'])->name('prestasi');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/pmb', [PageController::class, 'pmb'])->name('pmb');
Route::get('/jadwal-pmb', [PageController::class, 'jadwalPmb'])->name('jadwal-pmb');
Route::get('/biaya', [PageController::class, 'biaya'])->name('biaya');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::get('/search', [PageController::class, 'search'])->name('frontend.search');
Route::get('/sitemap.xml', [\App\Http\Controllers\Frontend\SitemapController::class, 'index'])->name('sitemap');

// Daftar PMB — redirect ke website PMB resmi universitas
Route::get('/daftar-pmb', function () {
    return redirect()->away('https://pmb.unsur.ac.id');
})->name('daftar-pmb');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/admin/login', [LoginController::class, 'login'])->name('login.post');
});

Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    
    // Auth Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profil Fakultas
    Route::get('profil-fakultas', [ProfilFakultasController::class, 'edit'])->name('profil-fakultas.edit');
    Route::put('profil-fakultas', [ProfilFakultasController::class, 'update'])->name('profil-fakultas.update');

    // Program Studi
    Route::get('program-studi/trash', [ProgramStudiController::class, 'trash'])->name('program-studi.trash');
    Route::put('program-studi/{id}/restore', [ProgramStudiController::class, 'restore'])->name('program-studi.restore');
    Route::delete('program-studi/{id}/force-delete', [ProgramStudiController::class, 'forceDelete'])->name('program-studi.force-delete');
    Route::resource('program-studi', ProgramStudiController::class);

    // Fasilitas
    Route::get('fasilitas/trash', [FasilitasController::class, 'trash'])->name('fasilitas.trash');
    Route::put('fasilitas/{id}/restore', [FasilitasController::class, 'restore'])->name('fasilitas.restore');
    Route::delete('fasilitas/{id}/force-delete', [FasilitasController::class, 'forceDelete'])->name('fasilitas.force-delete');
    Route::resource('fasilitas', FasilitasController::class);

    // Prestasi
    Route::get('prestasi/trash', [PrestasiController::class, 'trash'])->name('prestasi.trash');
    Route::put('prestasi/{id}/restore', [PrestasiController::class, 'restore'])->name('prestasi.restore');
    Route::delete('prestasi/{id}/force-delete', [PrestasiController::class, 'forceDelete'])->name('prestasi.force-delete');
    Route::resource('prestasi', PrestasiController::class);

    // Kategori Galeri
    Route::get('kategori-galeri/trash', [KategoriGaleriController::class, 'trash'])->name('kategori-galeri.trash');
    Route::put('kategori-galeri/{id}/restore', [KategoriGaleriController::class, 'restore'])->name('kategori-galeri.restore');
    Route::delete('kategori-galeri/{id}/force-delete', [KategoriGaleriController::class, 'forceDelete'])->name('kategori-galeri.force-delete');
    Route::resource('kategori-galeri', KategoriGaleriController::class);

    // Galeri
    Route::get('galeri/trash', [GaleriController::class, 'trash'])->name('galeri.trash');
    Route::put('galeri/{id}/restore', [GaleriController::class, 'restore'])->name('galeri.restore');
    Route::delete('galeri/{id}/force-delete', [GaleriController::class, 'forceDelete'])->name('galeri.force-delete');
    Route::resource('galeri', GaleriController::class);

    // Informasi PMB
    Route::get('informasi-pmb/trash', [InformasiPmbController::class, 'trash'])->name('informasi-pmb.trash');
    Route::put('informasi-pmb/{id}/restore', [InformasiPmbController::class, 'restore'])->name('informasi-pmb.restore');
    Route::delete('informasi-pmb/{id}/force-delete', [InformasiPmbController::class, 'forceDelete'])->name('informasi-pmb.force-delete');
    Route::resource('informasi-pmb', InformasiPmbController::class);

    // Jadwal PMB
    Route::get('jadwal-pmb/trash', [JadwalPmbController::class, 'trash'])->name('jadwal-pmb.trash');
    Route::put('jadwal-pmb/{id}/restore', [JadwalPmbController::class, 'restore'])->name('jadwal-pmb.restore');
    Route::delete('jadwal-pmb/{id}/force-delete', [JadwalPmbController::class, 'forceDelete'])->name('jadwal-pmb.force-delete');
    Route::resource('jadwal-pmb', JadwalPmbController::class);

    // Biaya Pendidikan
    Route::get('biaya-pendidikan/trash', [BiayaController::class, 'trash'])->name('biaya.trash');
    Route::put('biaya-pendidikan/{id}/restore', [BiayaController::class, 'restore'])->name('biaya.restore');
    Route::delete('biaya-pendidikan/{id}/force-delete', [BiayaController::class, 'forceDelete'])->name('biaya.force-delete');
    Route::resource('biaya-pendidikan', BiayaController::class)->names('biaya')->parameters(['biaya-pendidikan' => 'biaya']);

    // Kontak
    Route::get('kontak/trash', [KontakController::class, 'trash'])->name('kontak.trash');
    Route::put('kontak/{id}/restore', [KontakController::class, 'restore'])->name('kontak.restore');
    Route::delete('kontak/{id}/force-delete', [KontakController::class, 'forceDelete'])->name('kontak.force-delete');
    Route::resource('kontak', KontakController::class);

    // Media Manager
    Route::get('media/trash', [MediaController::class, 'trash'])->name('media.trash');
    Route::put('media/{id}/restore', [MediaController::class, 'restore'])->name('media.restore');
    Route::delete('media/{id}/force-delete', [MediaController::class, 'forceDelete'])->name('media.force-delete');
    Route::resource('media', MediaController::class);

    // Settings Website
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    
    // Menus & Banners (Phase 5)
    Route::resource('menus', MenuController::class);
    Route::resource('banners', BannerController::class);
    
    // Profile (Phase 5)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    
    // System & Tools (Phase 5)
    Route::get('/system', [SystemController::class, 'index'])->name('system.index');
    Route::post('/system/cache/clear', [SystemController::class, 'clearCache'])->name('system.clear-cache');
    Route::post('/system/backup/create', [SystemController::class, 'createBackup'])->name('system.backup');
    Route::get('/system/backup/{id}/download', [SystemController::class, 'downloadBackup'])->name('system.download-backup');
    Route::delete('/system/backup/{id}', [SystemController::class, 'deleteBackup'])->name('system.delete-backup');
    
    // Activity Logs & Search (Phase 5)
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::get('/search', [SearchController::class, 'global'])->name('search');
    
    // Notifications (Phase 5)
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markRead');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
});

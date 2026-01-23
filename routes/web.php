<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController as FrontendProfileController;
use App\Http\Controllers\Frontend\NewsController as FrontendNewsController;
use App\Http\Controllers\Frontend\ResearchProductController as FrontendResearchProductController;
use App\Http\Controllers\Frontend\AnnouncementController as FrontendAnnouncementController;
use App\Http\Controllers\Frontend\DownloadController as FrontendDownloadController;
use App\Http\Controllers\Frontend\PengukuranTktController as FrontendPengukuranTktController;
use App\Http\Controllers\Frontend\ChartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ResearchProductController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\DownloadCategoryController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\PengukuranTktController;
use App\Http\Controllers\Admin\ResearchStatisticController;
use App\Http\Controllers\Admin\ServiceStatisticController;
use App\Http\Controllers\Admin\PublicationStatisticController;
use App\Http\Controllers\Admin\ProsedingStatisticController;
use App\Http\Controllers\Admin\BookStatisticController;
use App\Http\Controllers\Admin\HakCiptaStatisticController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes (Public)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// About/Profile
Route::get('/tentang-kami', [FrontendProfileController::class, 'index'])->name('about');

// News
Route::get('/berita', [FrontendNewsController::class, 'index'])->name('news.index');
Route::get('/berita/{news:slug}', [FrontendNewsController::class, 'show'])->name('news.show');
Route::get('/berita/kategori/{category:slug}', [FrontendNewsController::class, 'category'])->name('news.category');

// Research Products
Route::get('/produk-penelitian', [FrontendResearchProductController::class, 'index'])->name('research.index');
Route::get('/produk-penelitian/{researchProduct:slug}', [FrontendResearchProductController::class, 'show'])->name('research.show');

// Announcements
Route::get('/pengumuman', [FrontendAnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/pengumuman/{announcement}', [FrontendAnnouncementController::class, 'show'])->name('announcements.show');

// Downloads
Route::get('/download', [FrontendDownloadController::class, 'index'])->name('downloads.index');
Route::get('/download/{download}', [FrontendDownloadController::class, 'download'])->name('downloads.download');
Route::get('/download/kategori/{category:slug}', [FrontendDownloadController::class, 'category'])->name('downloads.category');

// Pengukuran TKT
Route::get('/pengukuran-tkt', [FrontendPengukuranTktController::class, 'index'])->name('pengukuran-tkt.index');
Route::get('/pengukuran-tkt/{pengukuranTkt:slug}', [FrontendPengukuranTktController::class, 'show'])->name('pengukuran-tkt.show');
Route::get('/pengukuran-tkt/{pengukuranTkt:slug}/download', [FrontendPengukuranTktController::class, 'download'])->name('pengukuran-tkt.download');

// Charts
Route::get('/grafik', [ChartController::class, 'index'])->name('charts.index');
Route::get('/api/chart/research', [ChartController::class, 'researchData'])->name('charts.research.data');
Route::get('/api/chart/service', [ChartController::class, 'serviceData'])->name('charts.service.data');
Route::get('/api/chart/publication', [ChartController::class, 'publicationData'])->name('charts.publication.data');
Route::get('/api/chart/proseding', [ChartController::class, 'prosedingData'])->name('charts.proseding.data');
Route::get('/api/chart/book', [ChartController::class, 'bookData'])->name('charts.book.data');
Route::get('/api/chart/hak-cipta', [ChartController::class, 'hakCiptaData'])->name('charts.hak-cipta.data');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin.or.operator'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Header Management
    Route::resource('headers', HeaderController::class);

    // News Categories
    Route::resource('news-categories', NewsCategoryController::class);

    // News
    Route::resource('news', NewsController::class);

    // Research Products
    Route::resource('research-products', ResearchProductController::class);

    // Announcements
    Route::resource('announcements', AnnouncementController::class);

    // Download Categories
    Route::resource('download-categories', DownloadCategoryController::class);

    // Downloads
    Route::resource('downloads', DownloadController::class);

    // Pengukuran TKT
    Route::resource('pengukuran-tkt', PengukuranTktController::class);

    // Statistics
    Route::resource('research-statistics', ResearchStatisticController::class);
    Route::resource('service-statistics', ServiceStatisticController::class);
    Route::resource('publication-statistics', PublicationStatisticController::class);
    Route::resource('proseding-statistics', ProsedingStatisticController::class);
    Route::resource('book-statistics', BookStatisticController::class);
    Route::resource('hak-cipta-statistics', HakCiptaStatisticController::class);

    // User Management (Admin Only)
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

// Redirect /dashboard to admin dashboard for backward compatibility
Route::middleware('auth')->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ProjectImageController;
use App\Http\Controllers\Admin\SiteProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/skills', [PageController::class, 'skills'])->name('skills');
Route::get('/services', [PageController::class, 'services'])->name('services');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::redirect('/dashboard', '/admin')
    ->middleware(['auth', 'admin'])
    ->name('dashboard');

Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    });

    Route::middleware(['auth', 'admin'])->name('admin.')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::resource('projects', AdminProjectController::class);
        Route::resource('categories', AdminCategoryController::class)->except(['show']);
        Route::post('projects/{project}/images', [ProjectImageController::class, 'store'])
            ->name('projects.images.store');
        Route::delete('projects/{project}/images/{image}', [ProjectImageController::class, 'destroy'])
            ->name('projects.images.destroy');

        Route::get('messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
        Route::patch('messages/{message}', [AdminContactMessageController::class, 'update'])->name('messages.update');
        Route::delete('messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('profile', [SiteProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [SiteProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile/cv', [SiteProfileController::class, 'destroyCv'])->name('profile.cv.destroy');
        Route::delete('profile/logo', [SiteProfileController::class, 'destroyLogo'])->name('profile.logo.destroy');
        Route::delete('profile/photo', [SiteProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');

        Route::patch('account', [ProfileController::class, 'update'])->name('account.update');
        Route::put('account/password', [PasswordController::class, 'update'])->name('account.password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Settings\SiteSettingsController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin');

    Route::get('/admin/posts', [PostController::class, 'index'])->name('admin.posts');
    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/admin/posts/create', [PostController::class, 'store'])->name('admin.posts.create');
    Route::get('/admin/posts/{post}', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('admin.posts.delete');

    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.posts.categories');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.posts.categories');


    Route::get('/admin/settings', [SiteSettingsController::class, 'index'])->name('admin.settings');
    Route::put('/admin/settings/site_settings/general', [SiteSettingsController::class, 'updateGeneralSiteSettings'])->name('admin.settings.site_settings.general');
    Route::put('/admin/settings/site_settings/logo', [SiteSettingsController::class, 'updateLogoSiteSettings'])->name('admin.settings.site_settings.logo');
});
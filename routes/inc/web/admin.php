<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Settings\SiteSettingsController;

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');

    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('admin.posts');
        Route::get('/create', [PostController::class, 'create'])->name('admin.posts.create');
        Route::post('/create', [PostController::class, 'store']);

        Route::get('/categories', [CategoryController::class, 'PostCategoryIndex'])->name('admin.posts.categories');
        Route::post('/categories', [CategoryController::class, 'store']);


        Route::get('/{post}', [PostController::class, 'edit'])->name('admin.posts.edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('admin.posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('admin.posts.delete');
    });



    Route::get('/settings', [SiteSettingsController::class, 'index'])->name('admin.settings');
    Route::put('/settings/site_settings/general', [SiteSettingsController::class, 'updateGeneralSiteSettings'])->name('admin.settings.site_settings.general');
    Route::put('/settings/site_settings/logo', [SiteSettingsController::class, 'updateLogoSiteSettings'])->name('admin.settings.site_settings.logo');



    Route::prefix('products')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('admin.products');
        Route::get('/create', [PostController::class, 'create'])->name('admin.products.create');
        Route::post('/create', [PostController::class, 'store']);

        Route::get('/categories', [CategoryController::class, 'productCategoryIndex'])->name('admin.products.categories');
        Route::post('/categories', [CategoryController::class, 'store']);
    });
});

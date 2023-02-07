<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

use App\Http\Controllers\Admin\Post\PostImageUploader;

Route::middleware('auth')->group(function () {
    Route::post('/upload', [UploadController::class, 'store']);
    Route::delete('/upload', [UploadController::class, 'destroy']);
});

Route::middleware('admin')->group(function () {
    Route::post('/posts/images/upload', [PostImageUploader::class, 'store'])->name('posts.image.upload');
});
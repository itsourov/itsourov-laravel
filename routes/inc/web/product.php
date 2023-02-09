<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;




Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('/{product:slug}', [ProductController::class, 'show'])->name('products.details');
});

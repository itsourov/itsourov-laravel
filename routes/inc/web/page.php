<?php

use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;


Route::get('/contact', [StaticPageController::class, 'contact'])->name('page.contact');

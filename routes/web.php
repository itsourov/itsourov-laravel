<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserFileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return redirect(route('posts'));
// })->name('home');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/{media}/{file}', [UserFileController::class, 'index'])->name('file');
    Route::get('/user/{media}/conversions/{file}', [UserFileController::class, 'getConversions'])->name('conversions');
});



require __DIR__ . '/inc/web/auth.php';
require __DIR__ . '/inc/web/admin.php';
require __DIR__ . '/inc/web/upload.php';
require __DIR__ . '/inc/web/post.php';
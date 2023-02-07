<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;


Route::get('/posts', function () {
    return redirect(route('home'));
})->name('posts');

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.details');

Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('categories.details');

Route::group(['middleware' => ['auth']], function () {


    Route::post('/posts/{post:slug}/comments', [CommentController::class, 'store'])->name('posts.comments');

    Route::delete('/posts/{post:slug}/comments/{comment}', [CommentController::class, 'destroy'])->name('posts.comments.delete');
});
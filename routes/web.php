<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\app\Http\Controllers\Admin\PostController;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('post', PostController::class)->except(['index'])->names('post');
        Route::get('posts', [PostController::class, 'index'])->name('post.index');
        Route::get('post', fn () => redirect(route('admin.post.index')));
    });
});

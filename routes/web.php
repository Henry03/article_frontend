<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'index')->name('home');
});

Route::controller(ArticleController::class)->group(function() {
    Route::get('/article/{id}', 'detailArticle')->name('article.detail');
});

Route::group(['middleware' => ['isSessionValid']], function(){
    Route::controller(HomeController::class)->group(function() {
        Route::get('/myarticle', 'indexById')->name('myarticle');
    });

    Route::controller(ArticleController::class)->group(function() {
        Route::get('/article', 'store')->name('article.store');
        Route::post('/article', 'submitArticle')->name('article.store.submit');
        Route::get('/article/edit/{id}', 'update')->name('article.update');
        Route::post('/article/edit/{id}', 'submitUpdate')->name('article.update.submit');
        Route::get('/article/delete/{id}', 'submitDelete')->name('article.delete');
    });

    Route::controller(CommentController::class)->group(function() {
        Route::post('/comment', 'store')->name('comment.store');
    });

    Route::controller(LikeController::class)->group(function() {
        Route::get('/like/{id}', 'submitStore')->name('like.store');
    });
    Route::controller(AuthController::class)->group(function() {
        Route::get('/logout', 'logout')->name('logout');
    });
});

Route::group(['middleware' => ['guest']], function(){
    Route::controller(AuthController::class)->group(function() {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'submitLogin')->name('login.submit');
    });
});


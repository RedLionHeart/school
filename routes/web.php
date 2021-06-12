<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'News'], function () {
    Route::get('/news', 'IndexController')->name('news.index');
    Route::get('/news/create', 'CreateController')->name('news.create');
    Route::post('/news', 'StoreController')->name('news.store');
    Route::get('/news/{news}', 'ShowController')->name('news.show');
    Route::get('/news/{news}/edit', 'EditController')->name('news.edit');
    Route::patch('/news/{news}', 'UpdateController')->name('news.update');
    Route::delete('/news/{news}', 'DestroyController')->name('news.destroy');
});
Route::group(['namespace' => 'Article'], function () {
    Route::get('/blog', 'IndexController')->name('article.index');
    Route::get('/article/create', 'CreateController')->name('article.create');
    Route::post('/article', 'StoreController')->name('article.store');
    Route::get('/blog/{article}', 'ShowController')->name('article.show');
    Route::get('/article/{article}/edit', 'EditController')->name('article.edit');
    Route::patch('/article/{article}', 'UpdateController')->name('article.update');
    Route::delete('/article/{article}', 'DestroyController')->name('article.destroy');
});
Route::group(['namespace' => 'CategoryArticle'], function () {
    Route::get('/category-articles/create', 'CreateController')->name('category_articles.create');
    Route::post('/category-articles', 'StoreController')->name('category_articles.store');
    Route::get('/category-articles/{category}/edit', 'EditController')->name('category_articles.edit');
    Route::patch('/category-articles/{category}', 'UpdateController')->name('category_articles.update');
    Route::delete('/category-articles/{category}', 'DestroyController')->name('category_articles.destroy');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'IndexController')->name('admin.index');
    Route::group(['namespace' => 'News'], function () {
        Route::get('/news', 'IndexController')->name('admin.news.index');
    });
    Route::group(['namespace' => 'User'], function () {
        Route::get('/user', 'IndexController')->name('admin.user.index');
    });
    Route::group(['namespace' => 'Article'], function () {
        Route::get('/articles', 'IndexController')->name('admin.article.index');
    });
    Route::group(['namespace' => 'CategoryArticle'], function () {
        Route::get('/category-articles', 'IndexController')->name('admin.category_articles.index');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

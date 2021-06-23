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
    Route::get('/news/create', 'CreateController')->name('news.create')->middleware(['auth', 'can:manager']);
    Route::post('/news', 'StoreController')->name('news.store')->middleware(['auth', 'can:manager']);
    Route::get('/news/{news}', 'ShowController')->name('news.show');
    Route::get('/news/{news}/edit', 'EditController')->name('news.edit')->middleware(['auth', 'can:manager']);
    Route::patch('/news/{news}', 'UpdateController')->name('news.update')->middleware(['auth', 'can:manager']);
    Route::delete('/news/{news}', 'DestroyController')->name('news.destroy')->middleware(['auth', 'can:manager']);
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

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'can:manager']], function () {
    Route::get('/', 'IndexController')->name('admin.index');
    Route::group(['namespace' => 'News'], function () {
        Route::get('/news', 'IndexController')->name('admin.news.index');
    });
    Route::group(['namespace' => 'Article'], function () {
        Route::get('/articles', 'IndexController')->name('admin.article.index');
    });
    Route::group(['namespace' => 'CategoryArticle'], function () {
        Route::get('/category-articles', 'IndexController')->name('admin.category_articles.index');
    });

    Route::get('/archive-photo', 'ArchivePhotoController@index')->name('admin.archive_photo.index');
    Route::get('/archive-video', 'ArchiveVideoController@index')->name('admin.archive_video.index');
    Route::get('/videos', 'VideosAlbumController@index')->name('admin.videos.index');
    Route::get('/album', 'AlbumController@index')->name('admin.album.index');
    Route::get('/category-life', 'CategoryLifeController@index')->name('admin.category_life.index');

});

/** Pages */
Route::get('/our-life', 'PagesController@aboutUs')->name('our_life.index'); // заменить на index

/** Archive-photo*/
//Route::get('/our-life/{archive_photo}', 'OurLifeController@show')->name('archive_photo.show');
Route::get('/our-life/video/{archive_video}', 'ArchiveVideoController@show')->name('archive_video.show');
Route::get('/our-life/{archive_photo}', 'OurLifeController@show')->name('archive_photo.show');
Route::get('/our-life/{archive}/{album}', 'AlbumController@show')->name('album.show');


Route::middleware(['auth', 'can:manager']) -> group(function () {
    /** Archive-video*/
    Route::get('/archive-video/create', 'ArchiveVideoController@create')->name('archive_video.create');
    Route::post('/archive-video', 'ArchiveVideoController@store')->name('archive_video.store');
    Route::get('/archive-video/{archive}/edit', 'ArchiveVideoController@edit')->name('archive_video.edit');
    Route::patch('/archive-video/{archive}', 'ArchiveVideoController@update')->name('archive_video.update');
    Route::delete('/archive-video/{archive}', 'ArchiveVideoController@destroy')->name('archive_video.destroy');

    /** Videos album*/
    Route::get('/videos/create', 'VideosAlbumController@create')->name('video.create');
    Route::post('/videos', 'VideosAlbumController@store')->name('video.store');
    Route::get('/videos/{video}/edit', 'VideosAlbumController@edit')->name('video.edit');
    Route::patch('/videos/{video}', 'VideosAlbumController@update')->name('video.update');
    Route::delete('/videos/{video}', 'VideosAlbumController@destroy')->name('video.destroy');

    /** Archive-photo*/
    Route::get('/archive-photo/create', 'ArchivePhotoController@create')->name('archive_photo.create');
    Route::post('/archive-photo', 'ArchivePhotoController@store')->name('archive_photo.store');
    Route::get('/archive-photo/{archive}/edit', 'ArchivePhotoController@edit')->name('archive_photo.edit');
    Route::patch('/archive-photo/{archive}', 'ArchivePhotoController@update')->name('archive_photo.update');
    Route::delete('/archive-photo/{archive}', 'ArchivePhotoController@destroy')->name('archive_photo.destroy');

    /** Albums*/
    Route::get('/album/create', 'AlbumController@create')->name('album.create');
    Route::post('/album', 'AlbumController@store')->name('album.store');
    Route::post('/album_image', 'AlbumController@storeImage')->name('album_image.store');
    Route::get('/album_image/fetch/{id}', 'AlbumController@fetchImage')->name('album_image.fetch');
    Route::delete('/album_image/{image}', 'PhotosAlbumController@destroy')->name('album_image.destroy');
    Route::get('/album/{album}/edit', 'AlbumController@edit')->name('album.edit');
    Route::patch('/album/{album}', 'AlbumController@update')->name('album.update');
    Route::delete('/album/{album}', 'AlbumController@destroy')->name('album.destroy');

    /** Categories life*/
    Route::get('/category-life/create', 'CategoryLifeController@create')->name('category_life.create');
    Route::post('/category-life', 'CategoryLifeController@store')->name('category_life.store');
    Route::get('/category-life/{category}/edit', 'CategoryLifeController@edit')->name('category_life.edit');
    Route::patch('/category-life/{category}', 'CategoryLifeController@update')->name('category_life.update');
    Route::delete('/category-life/{category}', 'CategoryLifeController@destroy')->name('category_life.destroy');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'can:admin']], function () {
    Route::group(['namespace' => 'User'], function () {
        Route::get('/user', 'IndexController')->name('admin.user.index');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

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
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'can:view,post'], function() {
        Route::get('/posts/{post}/edit', 'PostController@showEditForm')->name('posts.edit');
        Route::post('/posts/{post}/edit', 'PostController@edit');
    });
    Route::get('/posts/index', 'PostController@index')->name('posts.index');
    Route::get('/posts/create', 'PostController@showCreateForm')->name('posts.create');
    Route::post('/posts/create', 'PostController@create');

    Route::get('/categories/index', 'CategoryController@index')->name('categories.index');
    Route::get('/categories/create', 'CategoryController@showCreateForm')->name('categories.create');
    Route::post('/categories/create', 'CategoryController@create');
});

Auth::routes();

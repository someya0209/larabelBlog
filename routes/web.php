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

Route::get('/posts/index', 'PostController@index')->name('posts.index');

Route::get('/categories/index', 'CategoryController@index')->name('categories.index');
Route::get('/categories/create', 'CategoryController@showCreateForm')->name('categories.create');
Route::post('/categories/create', 'CategoryController@create');

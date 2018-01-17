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

Route::get('/', 'PageController@welcomePage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/articles', 'ArticleController');

Route::resource('/comments', 'CommentController');

Route::resource('/like', 'LikeController');

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/admin/users', 'AdminController@users')->name('admin.users');

Route::get('/admin/articles', 'AdminController@articles')->name('admin.articles');

Route::resource('/users', 'UserController');


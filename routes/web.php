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

Route::group(['middleware' => 'Language'], function() {
    Route::get('changeLanguage/{language}', 'LanguageController@changeLanguage')->name('language.change');
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/post', 'PostController@index')->name('home.post.index');
    Route::get('/post/detail', 'PostController@detail')->name('home.post.detail');
    Route::get('/user', 'UserController@index')->name('home.user.index');
    Route::get('/user/detail', 'UserController@detail')->name('home.user.detail');
    Route::get('/tag', 'TagController@index')->name('home.tag.index');
    Route::get('/tag/detail', 'TagController@detail')->name('home.tag.detail');
    Route::any('/signup', 'LoginController@signup')->name('home.signup');
    Route::any('/login', 'LoginController@login')->name('home.login');
    Route::get('/logout', 'LoginController@logout')->name('home.logout');
});

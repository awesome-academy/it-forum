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
    // User
    Route::group(['prefix' => 'user'], function() {
        Route::get('/', 'UserController@index')->name('home.user.index');
        Route::get('/{id}', 'UserController@detail')->name('home.user.detail')->where(['id' => '[0-9]+']);
        Route::get('/{id}/activity', 'UserController@activity')->name('home.user.activity')->where(['id' => '[0-9]+']);

        Route::group(['middleware' => 'CheckLogin'], function() {
            Route::post('/editImage', 'UserController@editImage')->name('home.user.editImage');
        });
    });
    Route::get('/tag', 'TagController@index')->name('home.tag.index');
    Route::get('/tag/detail', 'TagController@detail')->name('home.tag.detail');
    Route::any('/signup', 'LoginController@signup')->name('home.signup');
    Route::any('/postSignup', 'LoginController@postSignup')->name('home.postSignup');
    Route::get('/login', 'LoginController@login')->name('home.login');
    Route::post('/postLogin', 'LoginController@postLogin')->name('home.postLogin');
    Route::get('/logout', 'LoginController@logout')->name('home.logout');
});

/*
admin route
*/

Route::group(['middleware' => 'Language', 'prefix' => 'admin'], function() {
    Route::get('/', 'admin\UserController@index')->name('admin.index');
    Route::group(['prefix' => 'user'], function() {
        Route::get('/', 'admin\UserController@index')->name('admin.user.index');
        Route::get('/search', 'admin\UserController@search')->name('admin.user.search');
        Route::get('/create', 'admin\UserController@create')->name('admin.user.create');
        Route::get('/add', 'admin\UserController@add')->name('admin.user.add');
    });
});

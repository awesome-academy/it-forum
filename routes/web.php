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
        Route::post('/postIndex', 'UserController@postIndex')->name('home.user.postIndex');
        Route::get('/{id?}', 'UserController@detail')->name('home.user.detail')->where(['id' => '[0-9]+']);
        Route::get('/{id}/activity', 'UserController@activity')->name('home.user.activity')->where(['id' => '[0-9]+']);

        Route::group(['middleware' => 'CheckLogin'], function() {
            Route::get('/setting', 'UserController@setting')->name('home.user.setting');
            Route::post('/editProfile', 'UserController@editProfile')->name('home.user.editProfile');
            Route::post('/editImage', 'UserController@editImage')->name('home.user.editImage');
            Route::get('/password', 'UserController@password')->name('home.user.password');
            Route::post('/editPassword', 'UserController@editPassword')->name('home.user.editPassword');
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

Route::group(['middleware' => 'Language', 'prefix' => 'admin'], function() {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/', 'AdminController@listUser')->name('admin.user.index');
});

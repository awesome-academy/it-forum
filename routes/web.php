
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
    // Tag
    Route::group(['prefix' => 'tag'], function() {
        Route::get('/', 'TagController@index')->name('home.tag.index');
        Route::post('/postIndex', 'TagController@postIndex')->name('home.tag.postIndex');
        Route::get('/{tagName?}', 'TagController@detail')->name('home.tag.detail')->where(['tagName' => '[-0-9.a-z]+']);
        Route::get('/i/{tagName}', 'TagController@info')->name('home.tag.info')->where(['tagName' => '[-0-9.a-z]+']);
    });
    Route::any('/signup', 'LoginController@signup')->name('home.signup');
    Route::any('/postSignup', 'LoginController@postSignup')->name('home.postSignup');
    Route::get('/login', 'LoginController@login')->name('home.login');
    Route::post('/postLogin', 'LoginController@postLogin')->name('home.postLogin');
    Route::get('/logout', 'LoginController@logout')->name('home.logout');
});

/*
admin route
*/

Route::group(['middleware' => ['Language', 'admin'], 'prefix' => 'admin'], function() {
    Route::get('/', 'Admin\UserController@index')->name('admin.index');
    Route::get('/logout', 'Admin\UserController@logout')->name('admin.logout');
    Route::group(['prefix' => 'user'], function() {
        Route::get('/', 'Admin\UserController@index')->name('admin.user.index');
        Route::get('/search', 'Admin\UserController@search')->name('admin.user.search');
        Route::get('/create', 'Admin\UserController@create')->name('admin.user.create');
        Route::post('/add', 'Admin\UserController@add')->name('admin.user.add');
        Route::get('/delete/{id}', 'Admin\UserController@delete')->name('admin.user.delete');
        Route::get('/edit/{id}', 'Admin\UserController@edit')->name('admin.user.edit');
        Route::post('/update', 'Admin\UserController@update')->name('admin.user.update');
    });
    Route::group(['prefix' => 'post'], function() {
        Route::get('/', 'Admin\PostController@index')->name('admin.post.index');
        Route::get('/search', 'Admin\PostController@search')->name('admin.post.search');
        Route::post('/add', 'Admin\PostController@add')->name('admin.post.add');
        Route::get('/delete/{id}', 'Admin\PostController@delete')->name('admin.post.delete');
        Route::get('/edit/{id}', 'Admin\PostController@edit')->name('admin.post.edit');
        Route::post('/update', 'Admin\PostController@update')->name('admin.post.update');
    });
    Route::group(['prefix' => 'tag'], function() {
        Route::get('/', 'Admin\TagController@index')->name('admin.tag.index');
        Route::get('/search', 'Admin\TagController@search')->name('admin.tag.search');
        Route::get('/create', 'Admin\TagController@create')->name('admin.tag.create');
        Route::post('/add', 'Admin\TagController@add')->name('admin.tag.add');
        Route::get('/delete/{id}', 'Admin\TagController@delete')->name('admin.tag.delete');
        Route::get('/edit/{id}', 'Admin\TagController@edit')->name('admin.tag.edit');
        Route::post('/update', 'Admin\TagController@update')->name('admin.tag.update');
    });
});

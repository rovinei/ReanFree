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

Auth::routes();

// Admin Authentication Route Group
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
    ], function(){

    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\AdminLoginController@login')->name('admin.submit.login');
    Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

});

// Admin CMS Route
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'auth:admin'
    ], function(){

    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard.alias');

    // Post Content CRUD Operation
    Route::get('posts', 'PostController@index')->name('admin.posts');
    Route::get('post/add', 'PostController@create')->name('admin.post.create');
    Route::post('post/add', 'PostController@store')->name('admin.post.store');
    Route::get('post/{post_id}/edit', 'PostController@edit')->name('admin.post.edit');
    Route::post('post/{post_id}/edit', 'PostController@update')->name('admin.post.update');
    Route::delete('post/remove', 'PostController@destroy')->name('admin.post.destroy');

    // Media Advertisement CRUD Operation


    // Slider CRUD Operation
    Route::get('slider', 'SliderController@index')->name('admin.slider');
    Route::get('slider/add', 'SliderController@create')->name('admin.slider.create');
    Route::post('slider/add', 'SliderController@store')->name('admin.slider.store');
    Route::get('slider/{slider_id}/edit', 'SliderController@edit')->name('admin.slider.edit');
    Route::post('slider/{slider_id}/edit', 'SliderController@update')->name('admin.slider.update');
    Route::post('slider/{slider_id}/remove', 'SliderController@destroy')->name('admin.slider.destroy');

    // Category CRUD Operation
    Route::get('category', 'CategoryController@index')->name('admin.categories');
    Route::get('category/add', 'CategoryController@create')->name('admin.category.create');
    Route::post('category/add', 'CategoryController@store')->name('admin.category.store');
    Route::get('category/{category_id}/edit', 'CategoryController@edit')->name('admin.category.edit');
    Route::post('category/{category_id}/edit', 'CategoryController@update')->name('admin.category.update');
    Route::delete('category/remove', 'CategoryController@destroy')->name('admin.category.destroy');

    // Media Type CRUD Operation
    Route::get('media_type', 'MediaTypeController@index')->name('admin.media_types');
    Route::get('media_type/add', 'MediaTypeController@create')->name('admin.media_type.create');
    Route::post('media_type/add', 'MediaTypeController@store')->name('admin.media_type.store');
    Route::get('media_type/{media_type_id}/edit', 'MediaTypeController@edit')->name('admin.media_type.edit');
    Route::post('media_type/{media_type_id}/edit', 'MediaTypeController@update')->name('admin.media_type.update');
    Route::delete('category/remove', 'MediaTypeController@destroy')->name('admin.media_type.destroy');

    // File Entry CRUD Operation
    Route::get('files', 'FileController@index')->name('admin.files');
    Route::get('file/add', 'FileController@create')->name('admin.file.create');
    Route::post('file/{disk}/add', 'FileController@store')->name('admin.file.store');
    Route::get('file/{file_id}/edit', 'FileController@edit')->name('admin.file.edit');
    Route::post('file/{file_id}/edit', 'FileController@update')->name('admin.file.update');
    Route::delete('file/remove', 'FileController@destroy')->name('admin.file.destroy');

    // Sound Post
    Route::get('sound/{id}/preview', 'FileController@previewSound')->name('admin.sound.preview');

    // User CRUD Operation
    Route::get('users', 'UserController@index')->name('admin.users');
    Route::get('users/add', 'UserController@create')->name('admin.users.create');
    Route::post('users/add', 'UserController@store')->name('admin.users.store');
    Route::get('users/{user_id}/edit', 'UserController@edit')->name('admin.users.edit');
    Route::post('users/{user_id}/edit', 'UserController@update')->name('admin.users.update');
    Route::post('users/{user_id}/remove', 'UserController@destroy')->name('admin.users.destroy');

    // Admin CRUD Operation
    Route::get('admins', 'AdminUserController@index')->name('admin.admins');
    Route::get('admins/add', 'AdminUserController@create')->name('admin.admins.create');
    Route::post('admins/add', 'AdminUserController@store')->name('admin.admins.store');
    Route::get('admins/{admin_id}/edit', 'AdminUserController@edit')->name('admin.admins.edit');
    Route::post('admins/{admin_id}/edit', 'AdminUserController@update')->name('admin.admins.update');
    Route::post('admins/{admin_id}/remove', 'AdminUserController@destroy')->name('admin.admins.destroy');

    // Setting CRUD Operation
    Route::get('setting', 'SettingController@index')->name('admin.setting');
    Route::get('setting/add', 'SettingController@create')->name('admin.setting.create');
    Route::post('setting/add', 'SettingController@store')->name('admin.setting.store');
    Route::get('setting/{setting_id}/edit', 'SettingController@edit')->name('admin.setting.edit');
    Route::post('setting/{setting_id}/edit', 'SettingController@update')->name('admin.setting.update');
    Route::post('setting/{setting_id}/remove', 'SettingController@destroy')->name('admin.setting.destroy');

    // Store images
    Route::post('images', 'ImageController@store');

});

Route::group([
    'middleware' => 'web'
    ], function(){

    Route::get('/', 'PageController@homePage')->name('visitor.index.page');

    // Video route
    Route::get('/page/videos', 'PageController@videoPage')->name('visitor.video.page');
    Route::get('/page/video/category/{category_id}', 'PageController@videoCategory')->name('visitor.video.category');
    Route::get('/page/video/watch/{video_id}', 'PageController@videoDetail')->name('visitor.video.detail');

    // Article route
    Route::get('/page/articles', 'PageController@articlePage')->name('visitor.article.page');
    Route::get('/page/article/category/{category_id}', 'PageController@articleCategory')->name('visitor.article.category');
    Route::get('/page/article/read/{article_id}', 'PageController@articleDetail')->name('visitor.article.detail');

    // Audio route
    Route::get('/page/audios', 'PageController@audioPage')->name('visitor.audio.page');
    Route::get('/page/audio/category/{audio_id}', 'PageController@audioCategory')->name('visitor.audio.category');
    Route::get('/page/audio/listen/{audio_id}', 'PageController@audioDetail')->name('visitor.audio.detail');

    // Search
    Route::get('/search', 'PageController@search')->name('visitor.search');
});

// Admin AJAX API Route
Route::group([
    'prefix' => 'admin/ajax',
    'namespace' => 'Admin',
    'middleware' => 'auth:admin'
    ], function(){

    Route::post('type_categories', 'AdminAjaxController@getTypeCategories')->name('admin.ajax.typeCategories');
    Route::post('add_serie', 'AdminAjaxController@addSerie')->name('admin.ajax.add_serie');

    Route::post('posts/{post_id?}', 'AdminAjaxController@getPosts')->name('admin.ajax.posts');
    Route::delete('posts/remove', 'AdminAjaxController@removePost')->name('admin.ajax.delete_post');
    Route::post('users/{user_id?}', 'AdminAjaxController@getUsers')->name('admin.ajax.users');
    Route::post('admins/{admin_id?}', 'AdminAjaxController@getAdmins')->name('admin.ajax.admins');
    Route::post('upload_image', 'ImageController@store')->name('admin.ajax.upload_image');
    Route::post('category/{category_id?}', 'AdminAjaxController@getCategories')->name('admin.ajax.categories');

});


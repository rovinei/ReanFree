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


// Admin Authentication Route Group
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
    ], function(){

    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\AdminLoginController@login')->name('admin.submit.login');
    Route::get('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'Auth\AdminResetPasswordController@reset');

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
    Route::get('post/articles', 'PostController@articlePost')->name('admin.post.articles');
    Route::get('post/videos', 'PostController@videoPost')->name('admin.post.videos');
    Route::get('post/audio', 'PostController@audioPost')->name('admin.post.audios');
    Route::get('post/add', 'PostController@create')->name('admin.post.create');
    Route::post('post/add', 'PostController@store')->name('admin.post.store');
    Route::get('post/{post_id}/edit', 'PostController@edit')->name('admin.post.edit');
    Route::post('post/{post_id}/edit', 'PostController@update')->name('admin.post.update');
    Route::delete('post/remove', 'PostController@destroy')->name('admin.post.destroy');

    // Media Advertisement CRUD Operation


    // Partner CRUD Operation
    Route::get('partners', 'PartnerController@index')->name('admin.partners');
    Route::get('partner/add', 'PartnerController@create')->name('admin.partner.create');
    Route::post('partner/add', 'PartnerController@store')->name('admin.partner.store');
    Route::get('partner/{partner_id}/edit', 'PartnerController@edit')->name('admin.partner.edit');
    Route::post('partner/{partner_id}/edit', 'PartnerController@update')->name('admin.partner.update');
    Route::post('partner/{partner_id}/remove', 'PartnerController@destroy')->name('admin.partner.destroy');

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

    // Tag CRUD Operation
    Route::get('tags', 'TagController@index')->name('admin.tags');
    Route::get('tag/attach', 'TagController@getAttachForm')->name('admin.tag.attach_form');
    Route::post('tag/attach', 'TagController@attach')->name('admin.tag.attach');
    Route::delete('tag/remove', 'TagController@destroy')->name('admin.tag.destroy');

    // Serie CRUD Operation
    Route::get('series', 'SerieController@index')->name('admin.series');
    Route::get('article_series', 'SerieController@articleSerie')->name('admin.article_series');
    Route::get('video_playlists', 'SerieController@videoPlaylist')->name('admin.video_playlists');
    Route::get('audio_albums', 'SerieController@audioAlbum')->name('admin.audio_albums');
    Route::get('serie/create', 'SerieController@create')->name('admin.serie.create');
    Route::post('serie/create', 'SerieController@store')->name('admin.serie.store');
    Route::get('serie/{serie_id}/edit', 'SerieController@edit')->name('admin.serie.edit');
    Route::post('serie/{serie_id}/update', 'SerieController@update')->name('admin.serie.update');

    // File Entry CRUD Operation
    // Route::get('files', 'FileController@index')->name('admin.files');
    // Route::get('file/add', 'FileController@create')->name('admin.file.create');
    // Route::post('file/{disk}/add', 'FileController@store')->name('admin.file.store');
    // Route::get('file/{file_id}/edit', 'FileController@edit')->name('admin.file.edit');
    // Route::post('file/{file_id}/edit', 'FileController@update')->name('admin.file.update');
    // Route::delete('file/remove', 'FileController@destroy')->name('admin.file.destroy');

    // Sound Post
    Route::get('sound/{id}/preview', 'FileController@previewSound')->name('admin.sound.preview');

    // User CRUD Operation
    // Route::get('users', 'UserController@index')->name('admin.users');
    // Route::get('users/add', 'UserController@create')->name('admin.users.create');
    // Route::post('users/add', 'UserController@store')->name('admin.users.store');
    // Route::get('users/{user_id}/edit', 'UserController@edit')->name('admin.users.edit');
    // Route::post('users/{user_id}/edit', 'UserController@update')->name('admin.users.update');
    // Route::post('users/{user_id}/remove', 'UserController@destroy')->name('admin.users.destroy');

    // Author CRUD Operation
    Route::get('authors', 'AdminController@index')->name('admin.author');
    Route::get('author/add', 'AdminController@create')->name('admin.author.create');
    Route::post('author/add', 'AdminController@store')->name('admin.author.store');
    Route::post('author/manage', 'AdminController@manageAuthor')->name('admin.author.manage');
    Route::get('author/{author_id}/edit', 'AdminController@edit')->name('admin.author.edit');
    Route::post('author/{author_id}/edit', 'AdminController@update')->name('admin.author.update');
    Route::post('author/{author_id}/remove', 'AdminController@destroy')->name('admin.author.destroy');

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
    Route::get('/page/video/category/{slug}', 'PageController@videoCategory')->name('visitor.video.category');
    Route::get('/page/video/watch/{video_id}', 'PageController@videoDetail')->name('visitor.video.detail');

    // Article route
    Route::get('/page/articles', 'PageController@articlePage')->name('visitor.article.page');
    Route::get('/page/article/category/{slug}', 'PageController@articleCategory')->name('visitor.article.category');
    Route::get('/page/article/serie/{serie_id}', 'PageController@articleSerie')->name('visitor.article.serie');
    Route::get('/page/article/read/{article_id}', 'PageController@articleDetail')->name('visitor.article.detail');

    // Tag
    Route::get('/tag/search', 'PageController@findPostsByTag')->name('visitor.tag_posts');

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
    Route::delete('partner/remove', 'AdminAjaxController@removePartner')->name('admin.ajax.delete_partner');
    Route::delete('category/remove', 'AdminAjaxController@removeCategory')->name('admin.ajax.delete_category');
    Route::delete('tag/remove', 'AdminAjaxController@removeTag')->name('admin.ajax.remove_tag');
    Route::delete('serie/remove', 'AdminAjaxController@removeSerie')->name('admin.ajax.remove_serie');
    Route::post('loadPostsTitle', 'AdminAjaxController@loadPostsTitle')->name('admin.ajax.loadPostTitle');
    Route::post('users/{user_id?}', 'AdminAjaxController@getUsers')->name('admin.ajax.users');
    Route::post('admins/{admin_id?}', 'AdminAjaxController@getAdmins')->name('admin.ajax.admins');
    Route::post('upload_image', 'ImageController@store')->name('admin.ajax.upload_image');
    Route::post('category/{category_id?}', 'AdminAjaxController@getCategories')->name('admin.ajax.categories');

});




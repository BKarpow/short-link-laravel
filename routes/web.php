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

Route::get('/test', 'SendEmailController@send');

Route::get('/', 'HomeController@index')->name('home-main');
Route::get('/about', 'HomeController@about')->name('about');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home-test');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/add/short', 'ShortsController@add_new_short')->name('add-short');
Route::post('/ajax/add/new', 'ShortsController@ajax_add_new')->name('ajax-add-new');
Route::get('/log/{short_id}', 'ShortLogController@show');

Route::get('/media/all', 'MediaController@ajax_get_all')
    ->name('ajax-media-all');
Route::post('/media/upload/image', 'MediaController@ajax_upload_image')
    ->name('media-upload-image');

/* Post system */
Route::get('/posts/all', 'PostController@show_all')
    ->name('post-all');
Route::get('/post/{id_alias}', 'PostController@show')
    ->name('post');
Route::get('/posts/tag/{tag_name}', 'PostController@show_from_tag')
    ->name('post.show.tag');


/* Page */
Route::get('/page/{alias}', 'PagesController@show')
    ->name('page');
/* End Page */

/* Feedback routes */
Route::get('/feedback', 'FeedbackController@index')
    ->name('feedback.index');
Route::post('/feedback/send', 'FeedbackController@send')
    ->name('feedback.action');
/* End Feedback routes */





/* Admin panel */
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'can:admin-panel'],
], function(){
    Route::get('/', 'AdminHomeController@index')->name('home-admin-panel');
    Route::get('/token/create/new', 'AdminApiTokenController@create_token')->name('create-token');
    Route::get('/token/list', 'AdminApiTokenController@show')->name('show-tokens');
    Route::get('/token/delete/{token}', 'AdminApiTokenController@delete_token');
    Route::get('/token/toggle/{token}', 'AdminApiTokenController@toggle_token');

    Route::post('/upload/image', 'ImageUploadController@upload_image')
        ->name('upload-image');
    Route::post('/delete/image', 'ImageUploadController@delete_image')
        ->name('delete-image');
    Route::post('/upload/', 'ImageUploadController@upload')
        ->name('upload');

    Route::get('/category/create', 'CategoryPostController@create_category')
        ->name('create-category');
    Route::post('/category/create/action', 'CategoryPostController@create_category_action')
        ->name('create-category-action');
    Route::get('/category/list/all', 'CategoryPostController@show_category_list')
        ->name('list-all-category');
    Route::get('/category/update/{id}', 'CategoryPostController@update_category')
        ->name('update-category');
    Route::post('/category/update/action/{id}', 'CategoryPostController@update_category_action')
        ->name('update-category-action');
    Route::get('/category/delete/{id}', 'CategoryPostController@delete_category')
        ->name('delete-category');


    Route::get('/media/add', 'MediaController@add_new')
        ->name('media-add');
    Route::post('/media/add/action', 'MediaController@add_new_action')
        ->name('media-add-action');

/* Admin post route */
    Route::get('/post/add', 'PostController@create_add')
        ->name('create-post');
    Route::post('/post/add/action', 'PostController@create_add_action')
        ->name('create-post-action');
    Route::get('/post/all', 'PostController@show_list')
        ->name('list-all-post');
    //Control admin buttons
    Route::get('/post/trigger/public/{id}', 'PostController@trigger_public')
        ->name('trigger-public-post');
    Route::get('/post/delete/{id}', 'PostController@delete_post')
        ->name('delete-post');

/* Admin post route */

/* Page admin route */
    Route::get('/page/delete/{alias}', 'PagesController@delete_page')
        ->name('delete-page');
    Route::get('/page/all', 'PagesController@show_list')
        ->name('list-all-page');
    Route::get('/page/create', 'PagesController@create')
        ->name('create-page');
    Route::get('/page/update/{alias}', 'PagesController@update')
        ->name('update-page');
    Route::post('/page/update/action', 'PagesController@update_action')
        ->name('update-page-action');
    Route::post('/page/create/action', 'PagesController@create_action')
        ->name('create-page-action');
        //AJAX
        Route::post('/page/ajax/is/unique', 'PagesController@ajax_is_unique')
            ->name('page-ajax-is-unique');
    ;
/* End Page admin route */

/* Tags */
    Route::get('/tags/delete/{tag_id}', 'TagsController@delete_tag')
        ->name('tags.delete');
    Route::get('/tags/all', 'TagsController@show_all')
        ->name('tags.all');
    Route::get('/tags/ajax/all', 'TagsController@ajax_get_all')
        ->name('tags.ajax.all');
    Route::post('/tags/new', 'TagsController@ajax_new')
        ->name('tags.ajax.new');
/* END Tags */

});


Route::get('/{short_id}', 'ShortsController@redirect_to_short');

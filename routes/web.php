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

Route::get('/test', function(){
    $url = 'http://127.0.0.1/openserver/phpmyadmin/tbl_structure.php?server=1&db=service_laravel&table=shorts';
    echo preg_replace('#^(http|https)\:\/\/[^\/]+?\/(.*?)#si','\\2', $url);
    return '';
});

Route::get('/', 'HomeController@index')->name('home-main');
Route::get('/about', 'HomeController@about')->name('about');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home-test');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/add/short', 'ShortsController@add_new_short')->name('add-short');
Route::get('/log/{short_id}', 'ShortLogController@show');

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

    Route::get('/category/create', 'CategoryPostController@create_category')
        ->name('create-category');
    Route::post('/category/create/action', 'CategoryPostController@create_category_action')
        ->name('create-category-action');
});

Route::get('/{short_id}', 'ShortsController@redirect_to_short');

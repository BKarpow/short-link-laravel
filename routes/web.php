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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/add/short', 'ShortsController@add_new_short')->name('add-short');
Route::get('/log/{short_id}', 'ShortLogController@show');

/* Admin panel */
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'can:admin-panel'],
], function(){
    Route::get('/', function(){
        var_dump( auth()->user()->role);
        return 'asd';
    });
});

Route::get('/{short_id}', 'ShortsController@redirect_to_short');

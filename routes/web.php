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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/ipad', function ()
{
    return view('ipadmini');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/admin/{any}', 'SpaController@index')->where('any', '.*');
Route::group(['prefix' => 'admin'], function ()
{
    Route::get('', 'SpaController@index');
    Route::get('/{any}', 'SpaController@index')->where('any', '.*');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

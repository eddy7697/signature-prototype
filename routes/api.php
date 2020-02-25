<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:admin')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Auth
 */
Route::group(['prefix' => 'auth'], function ()
{
    Route::post('login', 'Auth\ApiAuthController@login');
    Route::post('logout', 'Auth\ApiAuthController@logout');
});

Route::group(['prefix' => 'admin'], function ()
{
    Route::post('get', 'Backend\AdminController@getAdmins');
});

Route::post('/sign/save', 'SignController@saveSign');

Route::middleware('jwt.auth')->get('admins', function () {
    return auth('admin')->user();
});
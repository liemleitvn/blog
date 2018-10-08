<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'Api'], function (){
    Route::group(['prefix'=>'auth'], function () {
        Route::post('register', 'UserController@register');
        Route::post('login', 'UserController@login');
    });
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('user-info', 'UserController@getUserInfo');
    });
});

Route::group(['prefix'=>'posts', 'middleware' => 'jwt.auth','namespace'=>'Api' ], function () {

    Route::get('',['uses'=>'PostController@index', 'name'=>'index']);
    Route::get('/{id}', ['uses'=>'PostController@show', 'name'=>'show']);
    Route::post('',['uses'=>'PostController@store', 'name'=>'store']);
    Route::put('/{id}', ['uses'=>'PostController@update', 'name'=>'update']);
    Route::patch('/{id}', ['uses'=>'PostController@edit', 'name'=>'edit']);
    Route::delete('{id}', ['uses'=>'PostController@delete', 'name'=>'delete']);
});

Route::group(['prefix'=>'categories', 'middleware' => 'md5.auth','namespace'=>'Api' ], function () {

    Route::get('',['uses'=>'CategoryController@index', 'name'=>'index']);
    Route::get('/{id}', ['uses'=>'CategoryController@show', 'name'=>'show']);
    Route::post('',['uses'=>'CategoryController@store', 'name'=>'store']);
    Route::put('/{id}', ['uses'=>'CategoryController@update', 'name'=>'update']);
    Route::patch('/{id}', ['uses'=>'CategoryController@edit', 'name'=>'edit']);
    Route::delete('{id}', ['uses'=>'CategoryController@delete', 'name'=>'delete']);
});
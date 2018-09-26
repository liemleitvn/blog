<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Middleware\Authorize;
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
//
//$test = app('test');
//dd($test);


//php information
Route::get('info', function() {
    phpinfo();
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home',['uses'=>'HomeController@index', 'as'=>'home']);

Route::get('logout', function() {
	return redirect('login')->with(Auth::logout());
});


Route::group(['prefix' => 'post', 'as' => 'post.', 'namespace' => 'Posts'], function(){

    Route::get('/', ['uses'=>'PostController@index', 'as'=>'index']);

	Route::get('insert', ['uses' => 'PostController@create', 'as' => 'create']);
	Route::post('insert',['uses'=>'PostController@store', 'as'=>'store']);

    Route::get('update/{id}',['uses'=>'PostController@edit', 'as'=>'edit']);
    Route::post('update/{id}',['uses'=>'PostController@update', 'as'=>'update']);

    Route::get('delete/{id}',['uses'=>'PostController@delete', 'as'=>'delete']);

});

Route::group(['prefix' => 'category', 'as' => 'category.', 'namespace' => 'Categories'], function(){

    Route::get('/', ['uses'=>'CategoryController@index', 'as'=>'index']);

	Route::get('insert', ['uses' => 'CategoryController@create', 'as' => 'create']);
    Route::post('insert',['uses'=>'CategoryController@store', 'as'=>'store']);

    Route::get('update/{id}',['uses'=>'CategoryController@edit', 'as'=>'edit']);
    Route::post('update/{id}',['uses'=>'CategoryController@update', 'as'=>'update']);

    Route::get('delete/{id}',['uses'=>'CategoryController@delete', 'as'=>'delete']);

    Route::get('detail/{id}', ['uses'=>'CategoryController@detail', 'as'=>'detail']);

});

Route::group(['prefix'=>'file', 'as'=>'file','namespace'=>'Upload'], function () {
	Route::get('/', ['uses'=>'ImageController@index']);
	Route::post('/', ['uses'=>'ImageController@store']);
});

Route::group(['prefix'=>'generator', 'as'=>'generator','namespace'=>'PdfGenerate'], function () {
	Route::get('/', ['uses'=>'PdfController@index']);
	Route::post('/', ['uses'=>'PdfController@store']);
});







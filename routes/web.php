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

    Route::get('/{id}', ['uses'=>'PostController@showById', 'as'=>'showById'])->where('id', '[0-9]+');

	Route::get('insert', ['uses' => 'PostController@create', 'as' => 'create']);
	Route::post('insert',['uses'=>'PostController@store', 'as'=>'store']);

    Route::get('update/{id}',['uses'=>'PostController@edit', 'as'=>'edit']);
    Route::post('update/{id}',['uses'=>'PostController@update', 'as'=>'update']);

    Route::get('delete/{id}',['uses'=>'PostController@delete', 'as'=>'delete']);

    Route::get('search', ['uses'=>'PostController@search', 'as'=>'searchTitle']);

});

Route::group(['prefix' => 'category', 'as' => 'category.', 'namespace' => 'Categories'], function(){

    Route::get('/', ['uses'=>'CategoryController@index', 'as'=>'index']);

	Route::get('insert', ['uses' => 'CategoryController@create', 'as' => 'create']);
    Route::post('insert',['uses'=>'CategoryController@store', 'as'=>'store']);

    Route::get('update/{id}',['uses'=>'CategoryController@edit', 'as'=>'edit']);
    Route::post('update/{id}',['uses'=>'CategoryController@update', 'as'=>'update']);

    Route::get('delete/{id}',['uses'=>'CategoryController@delete', 'as'=>'delete']);

    Route::get('detail/{id}', ['uses'=>'CategoryController@detail', 'as'=>'detail']);

    Route::get('test', 'CategoryController@test');

});

Route::group(['prefix'=>'file', 'as'=>'file','namespace'=>'Upload'], function () {
	Route::get('/', ['uses'=>'ImageController@index']);
	Route::post('/', ['uses'=>'ImageController@store']);
});

Route::group(['prefix'=>'generator', 'as'=>'generator','namespace'=>'PdfGenerate'], function () {
	Route::get('/', ['uses'=>'PdfController@index']);
	Route::post('/', ['uses'=>'PdfController@store']);
});

Route::group(['prefix'=>'admin', 'as'=>'admin.', 'namespace'=>'Admin'], function (){
    Route::group(['prefix'=>'roles', 'as'=>'roles.', 'namespace'=>'Role'], function (){
        Route::get('/', ['uses'=>'RoleManagerController@index', 'as'=>'index']);
        Route::post('/insert', ['uses'=>'RoleManagerController@store', 'as'=>'insert']);
        Route::get('/edit/{id}', ['uses'=>'RoleManagerController@edit', 'as'=>'edit']);
        Route::post('/update/{id}', ['uses'=>'RoleManagerController@update', 'as'=>'update']);
        Route::get('/delete/{id}', ['uses'=>'RoleManagerController@destroy', 'as'=>'delete']);
    });

    Route::group(['prefix'=>'users', 'as'=>'users', 'namespace'=>'User'], function () {
        Route::get('/', ['uses'=>'UserManagerController@index', 'as'=>'index']);
    });
});






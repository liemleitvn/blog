<?php
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'web'], function() {
	Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('/login', 'Auth\LoginController@login')->name('login.submit');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
	
	Route::group(['middleware' => 'admin'], function() {
		Route::get('', ['uses' => 'DashboardController@index'])->name('dashboard');
	});
});
?>
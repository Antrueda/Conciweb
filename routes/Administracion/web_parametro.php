<?php
Route::group(['prefix' => 'parametro'], function () {
	Route::get('', [
		'uses' => 'App\Http\Controllers\Administracion\ParametroController@index',
		'middleware' => ['permission:parametro-leer|parametro-crear|parametro-editar|parametro-borrar']
	])->name('parametro');
	Route::get('nuevo', [
		'uses' => 'App\Http\Controllers\Administracion\ParametroController@create',
		'middleware' => ['permission:parametro-crear']
	])->name('parametro.nuevo');
	Route::post('nuevo', [
		'uses' => 'App\Http\Controllers\Administracion\ParametroController@store',
		'middleware' => ['permission:parametro-crear']
	]);
	Route::get('editar/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\ParametroController@edit',
		'middleware' => ['permission:parametro-editar']
	])->name('parametro.editar');
	Route::put('editar/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\ParametroController@update',
		'middleware' => ['permission:parametro-editar']
	]);
	Route::get('ver/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\ParametroController@show',
		'middleware' => ['permission:parametro-leer']
	])->name('parametro.ver');
	Route::delete('ver/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\ParametroController@destroy',
		'middleware' => ['permission:parametro-borrar']
	]);
});
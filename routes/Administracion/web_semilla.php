<?php
Route::group(['prefix' => 'Semilla'], function () {
	Route::get('', [
		'uses' => 'App\Http\Controllers\Administracion\SemillaController@index',
	//	'middleware' => ['permission:salario-leer|salario-crear|salario-editar|salario-borrar']
	])->name('semilla');
	Route::get('nuevo', [
		'uses' => 'App\Http\Controllers\Administracion\SemillaController@create',
	//	'middleware' => ['permission:salario-crear']
	])->name('semilla.nuevo');
	Route::post('nuevo', [
		'uses' => 'App\Http\Controllers\Administracion\SemillaController@store',
	//	'middleware' => ['permission:salario-crear']
	]);
	Route::get('editar/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\SemillaController@edit',
	//	'middleware' => ['permission:salario-editar']
	])->name('semilla.editar');
	Route::put('editar/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\SemillaController@update',
	//	'middleware' => ['permission:salario-editar']
	]);
	Route::get('ver/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\SemillaController@show',
	///	'middleware' => ['permission:salario-leer']
	])->name('semilla.ver');
	Route::delete('ver/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\SemillaController@destroy',
		//'middleware' => ['permission:salario-borrar']
	]);
});
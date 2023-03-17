<?php
Route::group(['prefix' => 'Salario'], function () {
	Route::get('', [
		'uses' => 'App\Http\Controllers\Administracion\SalarioController@index',
		'middleware' => ['permission:salario-leer|salario-crear|salario-editar|salario-borrar']
	])->name('salario');
	Route::get('nuevo', [
		'uses' => 'App\Http\Controllers\Administracion\SalarioController@create',
		'middleware' => ['permission:salario-crear']
	])->name('salario.nuevo');
	Route::post('nuevo', [
		'uses' => 'App\Http\Controllers\Administracion\SalarioController@store',
		'middleware' => ['permission:salario-crear']
	]);
	Route::get('editar/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\SalarioController@edit',
		'middleware' => ['permission:salario-editar']
	])->name('salario.editar');
	Route::put('editar/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\SalarioController@update',
		'middleware' => ['permission:salario-editar']
	]);
	Route::get('ver/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\SalarioController@show',
		'middleware' => ['permission:salario-leer']
	])->name('salario.ver');
	Route::delete('ver/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\SalarioController@destroy',
		'middleware' => ['permission:salario-borrar']
	]);
});
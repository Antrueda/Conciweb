<?php
Route::group(['prefix' => 'DocumentoDescarga'], function () {
	Route::get('', [
		'uses' => 'App\Http\Controllers\Administracion\DocumentoDescargaController@index',
		//'middleware' => ['permission:salario-leer|salario-crear|salario-editar|salario-borrar']
	])->name('documentd');
	Route::get('nuevo', [
		'uses' => 'App\Http\Controllers\Administracion\DocumentoDescargaController@create',
		//'middleware' => ['permission:salario-crear']
	])->name('documentd.nuevo');
	Route::post('nuevo', [
		'uses' => 'App\Http\Controllers\Administracion\DocumentoDescargaController@store',
	//	'middleware' => ['permission:salario-crear']
	]);
	Route::get('editar/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\DocumentoDescargaController@edit',
		//'middleware' => ['permission:salario-editar']
	])->name('documentd.editar');
	Route::put('editar/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\DocumentoDescargaController@update',
		//'middleware' => ['permission:salario-editar']
	]);
	Route::get('ver/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\DocumentoDescargaController@show',
		//'middleware' => ['permission:salario-leer']
	])->name('documentd.ver');
	Route::delete('ver/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\DocumentoDescargaController@destroy',
		//'middleware' => ['permission:salario-borrar']
	]);
});
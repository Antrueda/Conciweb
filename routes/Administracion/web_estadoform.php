<?php
Route::group(['prefix' => 'EstadoFormulario'], function () {
	Route::get('', [
		'uses' => 'App\Http\Controllers\Administracion\EstadoFormController@index',
		//'middleware' => ['permission:salario-leer|salario-crear|salario-editar|salario-borrar']
	])->name('estadoform');
	Route::get('nuevo', [
		'uses' => 'App\Http\Controllers\Administracion\EstadoFormController@create',
		//'middleware' => ['permission:salario-crear']
	])->name('estadoform.nuevo');
	Route::post('nuevo', [
		'uses' => 'App\Http\Controllers\Administracion\EstadoFormController@store',
	//	'middleware' => ['permission:salario-crear']
	]);
	Route::get('editar/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\EstadoFormController@edit',
		//'middleware' => ['permission:salario-editar']
	])->name('estadoform.editar');
	Route::put('editar/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\EstadoFormController@update',
		//'middleware' => ['permission:salario-editar']
	]);

	Route::get('editacierrrer/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\EstadoFormController@editcierre',
		//'middleware' => ['permission:salario-editar']
	])->name('estadoform.editarcie');
	Route::put('editacierrrer/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\EstadoFormController@updatecierre',
		//'middleware' => ['permission:salario-editar']
	]);
	Route::get('ver/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\EstadoFormController@show',
		//'middleware' => ['permission:salario-leer']
	])->name('estadoform.ver');
	Route::delete('ver/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\EstadoFormController@destroy',
		//'middleware' => ['permission:salario-borrar']
	]);
});
<?php
Route::group(['prefix' => 'TiempoDesistimiento'], function () {
	Route::get('', [
		'uses' => 'App\Http\Controllers\Administracion\TiempoDesistimientoController@index',
	])->name('tiempod');
	Route::get('nuevo', [
		'uses' => 'App\Http\Controllers\Administracion\TiempoDesistimientoController@create',
	])->name('tiempod.nuevo');
	Route::post('nuevo', [
		'uses' => 'App\Http\Controllers\Administracion\TiempoDesistimientoController@store',
	]);
	Route::get('editar/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\TiempoDesistimientoController@edit',

	])->name('tiempod.editar');
	Route::put('editar/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\TiempoDesistimientoController@update',
		
	]);
	Route::get('ver/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\TiempoDesistimientoController@show',
	])->name('tiempod.ver');
	Route::delete('ver/{id}', [
		'uses' => 'App\Http\Controllers\Administracion\TiempoDesistimientoController@destroy',
	]);
});
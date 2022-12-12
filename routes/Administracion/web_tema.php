<?php
Route::group(['prefix' => 'tema'], function () {
    Route::get('', [
	    'uses' => 'App\Http\Controllers\Administracion\TemaController@index',
	    'middleware' => ['permission:tema-leer']
	])->name('tema');
	Route::get('nuevo', [
	    'uses' => 'App\Http\Controllers\Administracion\TemaController@create',
	    'middleware' => ['permission:tema-crear']
	])->name('tema.nuevo');
	Route::post('nuevo', [
	    'uses' => 'App\Http\Controllers\Administracion\TemaController@store',
	    'middleware' => ['permission:tema-crear']
	]);
	Route::get('editar/{id}', [
	    'uses' => 'App\Http\Controllers\Administracion\TemaController@edit',
	    'middleware' => ['permission:tema-editar']
	])->name('tema.editar');
	Route::put('editar/{id}', [
	    'uses' => 'App\Http\Controllers\Administracion\TemaController@update',
	    'middleware' => ['permission:tema-editar']
	]);
	Route::put('editar/{id}/{id0}', [
	    'uses' => 'App\Http\Controllers\Administracion\TemaController@updateParametro',
	    'middleware' => ['permission:tema-crear|tema-editar']
	])->name('tema.editarParametro');
	Route::get('ver/{id}', [
	    'uses' => 'App\Http\Controllers\Administracion\TemaController@show',
	    'middleware' => ['permission:tema-leer']
	])->name('tema.ver');
	Route::delete('ver/{id}', [
	    'uses' => 'App\Http\Controllers\Administracion\TemaController@destroy',
	    'middleware' => ['permission:tema-borrar']
	]);
	Route::delete('ver/{id}/{id0}', [
	    'uses' => 'App\Http\Controllers\Administracion\TemaController@destroyParametro',
	    'middleware' => ['permission:tema-borrar']
	])->name('tema.verParametro');
});
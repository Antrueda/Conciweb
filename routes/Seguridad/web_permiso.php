<?php
Route::group(['prefix' => 'permiso'], function () {
    Route::get('', [
	    'uses' => 'App\Http\Controllers\Seguridad\PermisoController@index',
	    'middleware' => ['permission:permiso-leer|permiso-crear|permiso-editar|permiso-borrar']
	])->name('permiso');
	Route::get('nuevo', [
	    'uses' => 'App\Http\Controllers\Seguridad\PermisoController@create',
	    'middleware' => ['permission:permiso-crear']
	])->name('permiso.nuevo');
	Route::post('crear', [
	    'uses' => 'App\Http\Controllers\Seguridad\PermisoController@store',
	    'middleware' => ['permission:permiso-crear']
	])->name('permiso.crear');
	Route::get('editar/{permiso}', [
	    'uses' => 'App\Http\Controllers\Seguridad\PermisoController@edit',
	    'middleware' => ['permission:permiso-editar']
	])->name('permiso.editar');
	Route::put('editar/{permiso}', [
	    'uses' => 'App\Http\Controllers\Seguridad\PermisoController@update',
	    'middleware' => ['permission:permiso-editar']
	])->name('permiso.editar');
	Route::get('ver/{permiso}', [
	    'uses' => 'App\Http\Controllers\Seguridad\PermisoController@show',
	    'middleware' => ['permission:permiso-leer']
	])->name('permiso.ver');
	Route::delete('borrar/{permiso}', [
	    'uses' => 'App\Http\Controllers\Seguridad\PermisoController@destroy',
	    'middleware' => ['permission:permiso-borrar']
	])->name('permiso.borrar');
});
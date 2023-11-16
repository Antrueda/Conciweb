<?php
$controll='App\Http\Controllers\ConsultaConci\ConsultaConci';

$routxxxx='consultac';
Route::group(['prefix' => 'ConsultaConci'], function () use($controll,$routxxxx){
	Route::get('', [
		'uses' => $controll.'Controller@index',
		'middleware' => ['permission:'.$routxxxx.'-leer|'.$routxxxx.'-crear|'.$routxxxx.'-editar|'.$routxxxx.'-borrar']
	])->name($routxxxx);

	Route::get('indexfin', [
		'uses' => $controll.'Controller@indexFin',
		'middleware' => ['permission:'.$routxxxx.'-leer|'.$routxxxx.'-crear|'.$routxxxx.'-editar|'.$routxxxx.'-borrar']
	])->name($routxxxx.'.indexFin');
	Route::get('indexdias', [
		'uses' => $controll.'Controller@Dias',
		'middleware' => ['permission:'.$routxxxx.'-leer|'.$routxxxx.'-crear|'.$routxxxx.'-editar|'.$routxxxx.'-borrar']
	])->name($routxxxx.'.indexdias');
    Route::get('listaxxx', [
		'uses' => $controll.'Controller@listaConciliacionesGeneral',
		'middleware' => ['permission:'.$routxxxx.'-leer']
    ])->name($routxxxx.'.listaxxx');
	Route::get('listadias', [
		'uses' => $controll.'Controller@listaConciliacionesDias',
		'middleware' => ['permission:'.$routxxxx.'-leer']
    ])->name($routxxxx.'.listadias');
	Route::get('listafin', [
		'uses' => $controll.'Controller@listaConciliacionesFinalizados',
		'middleware' => ['permission:'.$routxxxx.'-leer']
    ])->name($routxxxx.'.listafin');
	Route::get('nuevo', [
		'uses' => $controll.'Controller@create',
		'middleware' => ['permission:'.$routxxxx.'-crear']
	])->name($routxxxx.'.nuevo');

	Route::post('crear', [
		'uses' => $controll.'Controller@store',
		'middleware' => ['permission:'.$routxxxx.'-crear']
    ])->name($routxxxx.'.crear');

    Route::get('editar/{modeloxx}', [
		'uses' => $controll.'Controller@edit',
		'middleware' => ['permission:'.$routxxxx.'-editar']
	])->name($routxxxx.'.editar');

	Route::put('editar/{modeloxx}', [
		'uses' => $controll.'Controller@update',
		'middleware' => ['permission:'.$routxxxx.'-editar']
	])->name($routxxxx.'.editar');

	Route::get('ver/{modeloxx}', [
		'uses' => $controll.'Controller@show',
		'middleware' => ['permission:'.$routxxxx.'-leer']
	])->name($routxxxx.'.ver');

	Route::get('agregar/{modeloxx}', [
		'uses' => $controll.'Controller@agregar',
		'middleware' => ['permission:'.$routxxxx.'-leer']
	])->name($routxxxx.'.agregar');

	Route::get('archivo/{id}', [
		'uses' => $controll.'Controller@archivo',
		'middleware' => ['permission:'.$routxxxx.'-leer']
	])->name($routxxxx.'.archivo');


	Route::get('borrar/{modeloxx}', [
	    'uses' => $controll.'Controller@inactivate',
	    'middleware' => ['permission:'.$routxxxx.'-borrar']
    ])->name($routxxxx.'.borrar');

    Route::put('borrar/{modeloxx}', [
		'uses' => $controll . 'Controller@destroy',
		'middleware' => ['permission:' . $routxxxx . '-borrar']
    ])->name($routxxxx . '.borrar');

    Route::get('activate/{modeloxx}', [
	    'uses' => $controll.'Controller@activate',
	    'middleware' => ['permission:'.$routxxxx.'-activarx']
    ])->name($routxxxx.'.activarx');

    Route::put('activate/{modeloxx}', [
		'uses' => $controll . 'Controller@activar',
		'middleware' => ['permission:' . $routxxxx . '-activarx']
    ])->name($routxxxx . '.activarx');

    Route::get('motivostseg', [
	    'uses' => $controll.'Controller@getMotivosts',
	    'middleware' => ['permission:'.$routxxxx.'-leer']
    ])->name($routxxxx.'.motitseg');
});

Route::group(['prefix' => 'resnnajsfos'], function () use ($controll, $routexxx) {
	Route::get('responsa', [
		'uses' => $controll . 'Controller@getResponsable',
		'middleware' => ['permission:' . $routexxx . '-borrar']
	])->name($routexxx . '.responsa');
});

<?php
$controll='App\Http\Controllers\Reportes\ReportesConci';
$routxxxx='reportes';
Route::group(['prefix' => 'ConsultaConci'], function () use($controll,$routxxxx){
	Route::get('', [
		'uses' => $controll.'Controller@index',
		//'middleware' => ['permission:'.$routxxxx.'-leer|'.$routxxxx.'-crear|'.$routxxxx.'-editar|'.$routxxxx.'-borrar']
	])->name($routxxxx);
	Route::get('general', [
		'uses' => $controll.'Controller@general',
		//'middleware' => ['permission:'.$routxxxx.'-crear']
	])->name($routxxxx.'.general');

	Route::get('dias', [
		'uses' => $controll.'Controller@dias',
		//'middleware' => ['permission:'.$routxxxx.'-crear']
	])->name($routxxxx.'.dias');
	Route::get('finalizado', [
		'uses' => $controll.'Controller@finalizados',
		//'middleware' => ['permission:'.$routxxxx.'-crear']
	])->name($routxxxx.'.finalizado');



    Route::get('editar/{modeloxx}', [
		'uses' => $controll.'Controller@edit',
	//	'middleware' => ['permission:'.$routxxxx.'-editar']
	])->name($routxxxx.'.editar');

    Route::post('generate-excel', [
		'uses' => $controll.'Controller@generateExcelGeneral',
		//'middleware' => ['permission:'.$routxxxx.'-editar']
	])->name($routxxxx.'.generate-excel');

	Route::post('generate-final', [
		'uses' => $controll.'Controller@generateExcelFinalizado',
		//'middleware' => ['permission:'.$routxxxx.'-editar']
	])->name($routxxxx.'.generate-finalizado');


	Route::post('generate-dias', [
		'uses' => $controll.'Controller@generateExcelDias',
		//'middleware' => ['permission:'.$routxxxx.'-editar']
	])->name($routxxxx.'.generate-dias');


	


	Route::put('editar/{modeloxx}', [
		'uses' => $controll.'Controller@update',
	//	'middleware' => ['permission:'.$routxxxx.'-editar']
	])->name($routxxxx.'.editar');

	Route::get('ver/{modeloxx}', [
		'uses' => $controll.'Controller@show',
	//	'middleware' => ['permission:'.$routxxxx.'-leer']
	])->name($routxxxx.'.ver');

	Route::get('agregar/{modeloxx}', [
		'uses' => $controll.'Controller@agregar',
	//	'middleware' => ['permission:'.$routxxxx.'-leer']
	])->name($routxxxx.'.agregar');

	Route::get('archivo/{id}', [
		'uses' => $controll.'Controller@archivo',
	//	'middleware' => ['permission:'.$routxxxx.'-leer']
	])->name($routxxxx.'.archivo');


	Route::get('borrar/{modeloxx}', [
	    'uses' => $controll.'Controller@inactivate',
	    'middleware' => ['permission:'.$routxxxx.'-borrar']
    ])->name($routxxxx.'.borrar');

    Route::put('borrar/{modeloxx}', [
		'uses' => $controll . 'Controller@destroy',
	//	'middleware' => ['permission:' . $routxxxx . '-borrar']
    ])->name($routxxxx . '.borrar');

    Route::get('activate/{modeloxx}', [
	    'uses' => $controll.'Controller@activate',
	    'middleware' => ['permission:'.$routxxxx.'-activarx']
    ])->name($routxxxx.'.activarx');

    Route::put('activate/{modeloxx}', [
		'uses' => $controll . 'Controller@activar',
	//	'middleware' => ['permission:' . $routxxxx . '-activarx']
    ])->name($routxxxx . '.activarx');

    Route::get('motivostseg', [
	    'uses' => $controll.'Controller@getMotivosts',
	    'middleware' => ['permission:'.$routxxxx.'-leer']
    ])->name($routxxxx.'.motitseg');
});

Route::group(['prefix' => 'resnnajsfos'], function () use ($controll, $routexxx) {
	Route::get('responsa', [
		'uses' => $controll . 'Controller@getResponsable',
	//	'middleware' => ['permission:' . $routexxx . '-borrar']
	])->name($routexxx . '.responsa');
});

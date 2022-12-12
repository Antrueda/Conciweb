<?php

$controll = 'App\Http\Controllers\Seguridad\Usuario\Usuario';
$routexxx = 'usuario';
Route::group(['prefix' => 'usuario'], function () use ($controll, $routexxx) {

    Route::get('', [
        'uses' => $controll . 'Controller@index',
        'middleware' => ['permission:' . $routexxx . '-leer|' . $routexxx . '-crear|' . $routexxx . '-editar|' . $routexxx . '-borrar']
    ])->name($routexxx);
    Route::get('listaxxx', [
	    'uses' => $controll.'Controller@getUsuario',
	    'middleware' => ['permission:'.$routexxx.'-leer|'.$routexxx.'-crear|'.$routexxx.'-editar|'.$routexxx.'-borrar']
	])->name($routexxx.'.listaxxx');

    Route::get('listanti', [
	    'uses' => $controll.'Controller@getUsuarioAnti',
	    'middleware' => ['permission:'.$routexxx.'-leer|'.$routexxx.'-crear|'.$routexxx.'-editar|'.$routexxx.'-borrar']
	])->name($routexxx.'.listanti');

    Route::get('nuevo', [
        'uses' => $controll . 'Controller@create',
        'middleware' => ['permission:' . $routexxx . '-crear']
    ])->name($routexxx . '.nuevo');
    Route::post('crear', [
        'uses' => $controll . 'Controller@store',
        'middleware' => ['permission:' . $routexxx . '-crear']
    ])->name($routexxx . '.crear');
    Route::get('editar/{modeloxx}', [
        'uses' => $controll . 'Controller@edit',
        'middleware' => ['permission:' . $routexxx . '-editar']
    ])->name($routexxx . '.editar');
    Route::get('editmigr/{modeloxx}', [
        'uses' => $controll . 'Controller@editmigr',
        'middleware' => ['permission:' . $routexxx . '-editar']
    ])->name($routexxx . '.editmigr');
    Route::put('editar/{modeloxx}', [
        'uses' => $controll . 'Controller@update',
        'middleware' => ['permission:' . $routexxx . '-editar']
    ])->name($routexxx . '.editar');
    Route::get('acuerdo/{modeloxx}', [
        'uses' => $controll . 'Controller@eacuerdo',
        'middleware' => ['permission:' . $routexxx . '-acuerdo']
    ])->name($routexxx . '.acuerdo');
    Route::put('acuerdo/{modeloxx}', [
        'uses' => $controll . 'Controller@uacuerdo',
        'middleware' => ['permission:' . $routexxx . '-acuerdo']
    ])->name($routexxx . '.acuerdo');
    Route::get('ver/{modeloxx}', [
        'uses' => $controll . 'Controller@show',
        'middleware' => ['permission:' . $routexxx . '-leer']
    ])->name($routexxx . '.ver');

    Route::get('borrar/{modeloxx}', [
	    'uses' => $controll.'Controller@inactivate',
	    'middleware' => ['permission:'.$routexxx.'-borrar']
    ])->name($routexxx.'.borrar');

    Route::put('borrar/{modeloxx}', [
		'uses' => $controll . 'Controller@destroy',
		'middleware' => ['permission:' . $routexxx . '-borrar']
	])->name($routexxx . '.borrar');



    Route::get('motivos', [
	    'uses' => $controll.'Controller@getMotivos',
	    'middleware' => ['permission:'.$routexxx.'-leer']
    ])->name($routexxx.'.motivosx');

    Route::post('municipio', [
        'uses' => $controll . 'Controller@municipioajax',
    ])->name($routexxx . '.municipio');




    Route::get('tiempocarga', [
        'uses' => $controll . 'Controller@tiempocarga',
    ])->name($routexxx . '.tiempocarga');


    /** Cambiar la contraseña */
    Route::get('password/{modeloxx}', [
        'uses' => $controll . 'Controller@editpassword',
        'middleware' => ['permission:usuario-editar']
    ])->name($routexxx . '.password');
    Route::put('password/{modeloxx}', [
        'uses' => $controll . 'Controller@updatepassword',
        'middleware' => ['permission:usuario-editar']
    ])->name($routexxx . '.password');

    Route::get('restart/{modeloxx}', [
        'uses' => $controll . 'Controller@getRestart',
        'middleware' => ['permission:usuario-editar']
    ])->name($routexxx . '.restartx');




    $controll = 'App\Http\Controllers\Seguridad\Usuario\UsuaRol';
    $routexxx = 'roleusua';
    Route::group(['prefix' => '{padrexxx}/roles'], function () use ($controll, $routexxx) {
        Route::get('', [
            'uses' => $controll . 'Controller@index',
            'middleware' => ['permission:' . $routexxx . '-leer|' . $routexxx . '-crear|' . $routexxx . '-editar|' . $routexxx . '-borrar']
        ])->name($routexxx);
        Route::get('nuevo', [
            'uses' => $controll . 'Controller@create',
            'middleware' => ['permission:' . $routexxx . '-crear']
        ])->name($routexxx . '.nuevo');
    });
});

require_once('web_role_user.php');
require_once('web_rol.php');
require_once('web_permiso.php');



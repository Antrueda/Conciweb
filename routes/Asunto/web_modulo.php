<?php
$routexxx='asuntomodulo';
$controll='App\Http\Controllers\Administracion\AsuntoAdmin\AsuntoModulo';
Route::group(['prefix' => 'moduloAsunto'], function () use($routexxx,$controll){
    Route::get('', [
		'uses' => $controll.'Controller@index',
		'middleware' => ['permission:'.$routexxx.'-modulo']
    ])->name($routexxx);
});
require_once('web_asunto.php');
require_once('web_subasunto.php');
require_once('web_asubasunto.php');
require_once('web_descripcion.php');
require_once('web_subdescripcion.php');

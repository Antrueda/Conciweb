<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Webcontroller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post("conciliaciones/login/validarLogin","App\Http\Controllers\conciliacionesController@validarLogin");
Route::post("conciliaciones/nuevaConciliacion","App\Http\Controllers\conciliacionesController@nuevaConciliacion");
Route::get("conciliaciones/moduloGestion","App\Http\Controllers\conciliacionesController@moduloGestion")->name('gestion');
Route::post("conciliaciones/comboAreaAsuntoJuridico","App\Http\Controllers\conciliacionesController@comboAreaAsuntoJuridico");
Route::post("conciliaciones/comboTemaAsuntoJuridico","App\Http\Controllers\conciliacionesController@comboTemaAsuntoJuridico");
Route::post("conciliaciones/comboSubTemaAsuntoJuridico","App\Http\Controllers\conciliacionesController@comboSubTemaAsuntoJuridico");
Route::post("conciliaciones/registroConciliacion","App\Http\Controllers\conciliacionesController@registroConciliacion");
Route::post("conciliaciones/consultaTramite","App\Http\Controllers\conciliacionesController@consultaTramite");
Route::post("conciliaciones/modalInfoHechos","App\Http\Controllers\conciliacionesController@modalInfoHechos");
Route::post("conciliaciones/registroHechos","App\Http\Controllers\conciliacionesController@registroHechos");
Route::post("conciliaciones/modalInfoConciliador","App\Http\Controllers\conciliacionesController@modalInfoConciliador");
Route::post("conciliaciones/registroConciliador","App\Http\Controllers\conciliacionesController@registroConciliador");
Route::post("conciliaciones/modalInfoAudiencia","App\Http\Controllers\conciliacionesController@modalInfoAudiencia");
Route::post("conciliaciones/registroAudiencia","App\Http\Controllers\conciliacionesController@registroAudiencia");
Route::post("conciliaciones/modalInfoConflicto","App\Http\Controllers\conciliacionesController@modalInfoConflicto");
Route::post("conciliaciones/registroManejoConflicto","App\Http\Controllers\conciliacionesController@registroManejoConflicto");
Route::post("conciliaciones/modalConvcaConvocan","App\Http\Controllers\conciliacionesController@modalConvcaConvocan");
Route::post("conciliaciones/tipoInvolucradoView","App\Http\Controllers\conciliacionesController@tipoInvolucradoView");
Route::post("conciliaciones/tramitesActivos","App\Http\Controllers\conciliacionesController@tramitesActivos");
Route::post("conciliaciones/consultaDatosCiudadano","App\Http\Controllers\conciliacionesController@consultaDatosCiudadano");
Route::post("conciliaciones/consultalistaCiudadaes","App\Http\Controllers\conciliacionesController@consultalistaCiudadaes");
Route::post("conciliaciones/registroCiudadano","App\Http\Controllers\conciliacionesController@registroCiudadano");
Route::post("conciliaciones/registroOrganizacion","App\Http\Controllers\conciliacionesController@registroOrganizacion");
Route::post("conciliaciones/modalCierreCaso","App\Http\Controllers\conciliacionesController@modalCierreCaso");
Route::post("conciliaciones/consultalistaResultado","App\Http\Controllers\conciliacionesController@consultalistaResultado");
Route::post("conciliaciones/registroCierreCon","App\Http\Controllers\conciliacionesController@registroCierreCon");
Route::post("conciliaciones/actualesUsuario","App\Http\Controllers\conciliacionesController@actualesUsuario");
Route::post("conciliaciones/moduloEdicionDatosUsr","App\Http\Controllers\conciliacionesController@moduloEdicionDatosUsr");
Route::post("conciliaciones/edicionDatosCiudadano","App\Http\Controllers\conciliacionesController@edicionDatosCiudadano");
Route::post("conciliaciones/moduloDesactivarUsr","App\Http\Controllers\conciliacionesController@moduloDesactivarUsr");
Route::post("conciliaciones/seccionApodeardoRepLegal","App\Http\Controllers\conciliacionesController@seccionApodeardoRepLegal");
Route::post("conciliaciones/registroApoderadoRepLEgal","App\Http\Controllers\conciliacionesController@registroApoderadoRepLEgal");
Route::post("conciliaciones/modalPrintconstancias","App\Http\Controllers\conciliacionesController@modalPrintconstancias");
Route::post("conciliaciones/generarReporte","App\Http\Controllers\conciliacionesController@generarReporte");
Route::post("conciliaciones/moduloEdicionDatosUsrOrg","App\Http\Controllers\conciliacionesController@moduloEdicionDatosUsrOrg");
Route::post("conciliaciones/edicionDatosCiudadanoOrg","App\Http\Controllers\conciliacionesController@edicionDatosCiudadanoOrg");
/****PRINT DE ACTA SIN Y CON APODERADO  ROUT *******/
Route::get("conciliaciones/pdf/printActas/ActaEntrega/{sinproc}/{identificacion}/{tipo}","App\Http\Controllers\conciliacionesController@impresionActaActaEntrega");
Route::get("conciliaciones/pdf/printActas/printActaIncial/{sinproc}","App\Http\Controllers\conciliacionesController@printActaIncial");
Route::get("conciliaciones/pdf/printActas/printActaFinal/{sinproc}","App\Http\Controllers\conciliacionesController@printActaFinal");
/*** PRINT DE RESULTADOS POR AUDIENCIA WORD *******/
Route::get("conciliaciones/word/{sinproc}/{tipo}","App\Http\Controllers\conciliacionesController@impresionResutaldoWord");
Route::get("conciliaciones/exitSystem","App\Http\Controllers\conciliacionesController@exitSystem");

/***********  RUTAS CONCILIACIONES WEB ***************** */

Route::get('/','App\Http\Controllers\Webcontroller@home')->name('home');
Route::post('modalMensajeBienvenida','App\Http\Controllers\Webcontroller@modalMensajeBienvenida');
Route::post('modalTratamientoDatos','App\Http\Controllers\Webcontroller@modalTratamientoDatos');
Route::post('solicitud','App\Http\Controllers\Webcontroller@solicitud');
Route::post('consultalistaSubAsuntos','App\Http\Controllers\Webcontroller@consultalistaSubAsuntos');
Route::post('seleccionarCondicion','App\Http\Controllers\Webcontroller@seleccionarCondicion');
Route::post('updateCondicionesDisponibles','App\Http\Controllers\Webcontroller@updateCondicionesDisponibles');
Route::post('consultaDocumentosRelacionados','App\Http\Controllers\Webcontroller@detalleAbcAsunto');
Route::post('registroConciliacionWeb','App\Http\Controllers\Webcontroller@registroConciliacionWeb');
Route::get('conciliacionWebUpdateDatos','App\Http\Controllers\Webcontroller@actualizarDato')->name('actualiza');
Route::post('registroActualizacionDatos','App\Http\Controllers\Webcontroller@registroActualizacionDatos');
Route::get('downloadFileWord', 'App\Http\Controllers\Webcontroller@descargaWord');
Route::get('search', [Webcontroller::class, 'autosearch'])->name('search');
Route::get('Adjuntar/{id}','App\Http\Controllers\Webcontroller@adjuntararchivos')->name('adjuntar');
Route::get('Desistir/{id}','App\Http\Controllers\Webcontroller@Desistir')->name('desistir');
Route::post('Test/{id}','App\Http\Controllers\Webcontroller@Test')->name('test');
Route::post('Cambioestado/{id}','App\Http\Controllers\Webcontroller@CambioEstado')->name('cambioestado');
Route::get('getMunicipio','App\Http\Controllers\Webcontroller@getMunicipio')->name('municipio');
Route::post('Adjunta/{id}','App\Http\Controllers\Webcontroller@CargaArchivos')->name('cargararchivos');
Route::get('subasunto', [
    'uses' => 'App\Http\Controllers\Webcontroller@getSubasunto',
])->name('subasunto');

Route::get('/reload-captcha', [Webcontroller::class, 'reloadCaptcha']);
// Route::get('/','App\Http\Controllers\frmWebController@home')->name('home');
// Route::post('modalMensajeBienvenida','App\Http\Controllers\frmWebController@modalMensajeBienvenida');
// Route::post('modalTratamientoDatos','App\Http\Controllers\frmWebController@modalTratamientoDatos');
// Route::post('solicitud','App\Http\Controllers\frmWebController@solicitud');
// Route::post('consultalistaSubAsuntos','App\Http\Controllers\frmWebController@consultalistaSubAsuntos');
// Route::post('consultaDocumentosRelacionados','App\Http\Controllers\frmWebController@detalleAbcAsunto');
// Route::post('registroConciliacionWeb','App\Http\Controllers\frmWebController@registroConciliacionWeb');
// Route::get('conciliacionWebUpdateDatos','App\Http\Controllers\frmWebController@actualizarDato')->name('actualiza');
// Route::post('registroActualizacionDatos','App\Http\Controllers\frmWebController@registroActualizacionDatos');
// Route::get('downloadFileWord', 'App\Http\Controllers\frmWebController@descargaWord');

require_once('Textos/web_moduloT.php');
require_once('Asunto/web_modulo.php');
require_once('Administracion/web_parametro.php');
require_once('Administracion/web_salario.php');
require_once('Administracion/web_estadoform.php');
require_once('Administracion/web_tema.php');
require_once('Seguridad/web_usuario.php');


Route::get('login', [AuthController::class, "login"]);
// login?key=Wnp5TEVrTlc0U05jVzcreU1CWnVjcFlPeDdETDMxR3E2MzRSU0ZVS3lETT0=


Route::get('unautorized', function () { abort(403);
});
Route::get('validation/{codigo}', function () {
    abort(401);
});

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('view:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    return 'exito';

});

Route::get('/storage', function () {
    Artisan::call('storage:link');
       return 'exitos';

});




Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//  Route::group(['middleware' => ['guest']], function () {
//      Route::post('login', 'App\Http\Controllers\Auth\AuthController@Login');
//      Route::get('cambio', 'App\Http\Controllers\Auth\LoginController@getCambio')->name('login.cambio');
//  });

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


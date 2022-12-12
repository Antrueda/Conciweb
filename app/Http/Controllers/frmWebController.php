<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Mail;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Storage;
use Response;

//MODELS
use App\tramiteusuario;
use App\tramiterespuesta;
use App\binconsecutivo;

class frmWebController extends Controller
{
    //Ventana de inicio
    public function home()
    {
        $mensaje = 'test';
        $localidadList = DB::table('localidad')->where('tipoloc', 1)->orderBy('descloc')->get();
        $listaSedes = DB::table('tab_sedes')->where('IDSEDE', '!=', 250)->get();
        $listaAsuntos = DB::table('tab_asunto_web')->where('ESTADO', 0)->orderBy('DESCRIPCION')->get();
        $estadoTipoAudi = DB::table('TAB_PARAMETROS_WEB')->where('CODIGO', 'TIA')->get();
        $listaTipoDoc = DB::table('TAB_TIPODOCUMENTOIDENTIDAD')
            ->select('SICIDTIPODOCUMENTOIDENTIDAD', 'SICTIPODOCUMENTOIDENTIDAD')
            ->orderBy('SICTIPODOCUMENTOIDENTIDAD')
            ->get();
        $data = array(
            "listaLocalidades" => $localidadList,
            "listaSedes" => $listaSedes,
            "listaAsuntos" => $listaAsuntos,
            "listaTipoDoc" => $listaTipoDoc,
            "estadoTipoAudi" => $estadoTipoAudi,
            "mensaje" => $mensaje
        );
        return ((string)\View::make("frmWeb.home", array("data" => $data)));
    }
    //Modal con el texto de bienvenida
    public function modalMensajeBienvenida()
    {
        $mensaje = 'test';
        $data = array(
            "mensaje" => $mensaje
        );
        return ((string)\View::make("frmWeb.modal.modalMensajeBienvenida", array("data" => $data)));
    }
    //Modal con mensaje de tratamiento de datos
    public function modalTratamientoDatos()
    {
        $mensaje = DB::table('TAB_PARAMETROS_WEB')->where('CODIGO', 'MD')->get();
        $data = array(
            "mensaje" => $mensaje
        );
        return ((string)\View::make("frmWeb.modal.modalManejoDatos", array("data" => $data)));
    }
    //Cargar la lista de los sub asuntos
    public function consultalistaSubAsuntos(Request $request)
    {
        $asunto = $request->input("asunto");

        $detalleASunto = DB::table('TAB_ASUNTO_DETALLE_WEB')
            ->where('ID_ASUNTO', $asunto)
            ->where('ESTADO', 0)
            ->orderBy('DESCRIPCION')
            ->get();
        return $detalleASunto;
    }
    //Consultar informacion del ABC del asunto
    public function detalleAbcAsunto(Request $request)
    {

        $asunto = $request->input("asunto");
        $subAsunto = $request->input("subAsunto");
        //SQL
        $detalleAbc = DB::table('TAB_ASUNTO_DOCUMENTOS_WEB')
            ->where('ID_ASUNTO', $asunto)
            ->where('ID_DETALLE', $subAsunto)
            ->where('ESTADO', 0)
            ->orderBy('descripcion')
            ->get();
        //INFORMACION RETORNADA EN LA VISTA
        $data = array(
            "detalleAbc" => $detalleAbc
        );
        //RETURN DE LA VISTA
        return ((string)\View::make("frmWeb.card.abcAsunto", array("data" => $data)));
    }
    //Registro de la solicitud
    public function registroConciliacionWeb(Request $request)
    {
        //Datos requeridos por sistema
        $carbonDate = Carbon::now();
        $vigencia = $carbonDate->year;
        $fechaRegistro = date_format($carbonDate, 'd/m/Y h:m:s');
        $fechaRegistroA = date('d/m/Y H:i:s A');

        $idTramite = 330;
        $msg = "Registro conciliaciones Web.";
        //Datos del solictante
        $tipoDocumento = $request->input("tipoDocumento");
        $numeroDocumento = $request->input("numeroDocumento");
        $primerNombre = $request->input("primerNombre");
        $segundoNombre = $request->input("segundoNombre");
        $primerApellido = $request->input("primerApellido");
        $segundoApellido = $request->input("segundoApellido");
        $primerTelefono = $request->input("primerTelefono");
        $segundoTelefono = $request->input("segundoTelefono");
        $email = $request->input("email");
        $direccion = $request->input("direccion");
        $localidad = $request->input("localidad");
        //Tipo de solicitud
        $tipoSolicitud = $request->input("tipoSolicitud");
        //Datos convocados
        $nombreConvocados = $request->input("nomConvocante");
        $emailConvocados = $request->input("emailConvocante");
        //Datos del apoderado
        $tipoDocApoderado = $request->input("tipoDocApoderado");
        $numDocApoderado = $request->input("numDocApoderado");
        $primerNombreApoderado = $request->input("primerNombreApoderado");
        $segundoNombreApoderado = $request->input("segundoNombreApoderado");
        $primerApellidoApoderado = $request->input("primerApellidoApoderado");
        $segundoApellidoApoderado = $request->input("segundoApellidoApoderado");
        $tarjetaProfesional = $request->input("tarjetaProfesional");
        $primerTelefonoApoderado = $request->input("primerTelefonoApoderado");
        $segundoTelefonoApoderado = $request->input("segundoTelefonoApoderado");
        $emailApoderado = $request->input("emailApoderado");
        //Datos de la audiencia
        $tipoAudiencia = $request->input("tipoAudiencia");
        $sedePrincipal = $request->input("sedePrincipal");
        $sedeSecundaria = $request->input("sedeSecundaria");
        $asunto = $request->input("asunto");
        $subAsunto = $request->input("subAsunto");
        $detalle = $request->input("detalle");
        $cuantia = $request->input("cuantia");
        //Documento

        //0.0) Preguntar si se registro un caso 

        try {
            $contadorSolicitudes = DB::table('TRAMITEUSUARIO')
                ->where('ID_USUARIO_REG', DB::raw("'" . $numeroDocumento . "'"))
                ->where('ESTADO_TRAMITE', DB::raw("'Remitido'"))
                ->where('TEXTO01', DB::raw("'" . $primerNombre . "'"))
                ->where('TEXTO02', DB::raw("'" . $segundoNombre . "'"))
                ->where('TEXTO03', DB::raw("'" . $primerApellido . "'"))
                ->where('TEXTO04', DB::raw("'" . $segundoApellido . "'"))
                ->where('TEXTO05', DB::raw("'" . $primerTelefono . "'"))
                ->where('NUMERO05', DB::raw("'" . $asunto . "'"))
                ->where('NUMERO06', DB::raw("'" . $subAsunto . "'"))
                ->where('TEXTO21', DB::raw("'" . $detalle . "'"))
                ->count();
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 0.0 Problema al indentificar la cantidad de solicitudes realizada [TRAM_USU] <br>' . $e->getMessage();
        }

        if ($contadorSolicitudes >= 1) {
            DB::commit();
            return '|1|El registro finalizo de forma correcta <br> Por favor verifique su correo electronico para mas información.';
        }


        try {
            $document1 = $request->file("document1");
            $nombreOriginalFile = $document1->getClientOriginalName();
            $rutaFinalFile = Storage::disk('local')->put("", $document1);
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 0.0) Problema al anexar el soporte en el sistema' . $e->getMessage();
        }

        /*
         $rutaFinalFile='asb.lm_ruta';
         $nombreOriginalFile='asb.lm_ruta.pdf';
         */
        //0) Extrear el consecutivo de la solicitud
        try {

            $user = DB::table('BINCONSECUTIVO')->where('vigencia', $vigencia)->first();
            $numSolicitud = $user->secuencial + 1;
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 0.1) Problema al extraer el numero de solicitud asignado por el sistema' . $e->getMessage();
        }

        //0.2) ACTUALIZAR EL REGISTRO EN BINCONSECUTIVO
        try {

            DB::table('BINCONSECUTIVO')
                ->where('vigencia', $vigencia)
                ->update(['SECUENCIAL' => $numSolicitud]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 0.2) Problema al actualizar el numero asignado por el sistema' . $e->getMessage();
        }

        //1) Registrar informacion en tramiteusuario
        try {
            tramiteusuario::insert(
            [
                'NUM_SOLICITUD' => $numSolicitud,
                'ID_TRAMITE' => $idTramite,
                'ID_USUARIO_REG' => $numeroDocumento,
                'FEC_SOLICITUD_TRAMITE' => DB::raw("TO_DATE('" . $fechaRegistro . "','DD/MM/YYYY HH24:MI:SS')"),
                'ESTADO_TRAMITE' => DB::raw("'Remitido'"),
                'VIGENCIA' => $vigencia,
                'OIDO_CODIGO' => 0,
                'TEXTO01' => DB::raw("'$primerNombre'"),
                'TEXTO02' => DB::raw("'$segundoNombre'"),
                'TEXTO03' => DB::raw("'$primerApellido'"),
                'TEXTO04' => DB::raw("'$segundoApellido'"),
                'TEXTO05' => DB::raw("'$primerTelefono'"),
                'TEXTO06' => DB::raw("'$segundoTelefono'"),
                'TEXTO07' => DB::raw("'$email'"),
                'TEXTO08' => DB::raw("'$direccion'"),
                'TEXTO09' => DB::raw("$localidad"),
                'NUMERO01' => $tipoSolicitud,
                'TEXTO10' => DB::raw("'$tipoDocApoderado'"),
                'TEXTO11' => DB::raw("'$numDocApoderado'"),
                'TEXTO12' => DB::raw("'$primerNombreApoderado'"),
                'TEXTO13' => DB::raw("'$segundoNombreApoderado'"),
                'TEXTO14' => DB::raw("'$primerApellidoApoderado'"),
                'TEXTO15' => DB::raw("'$segundoApellidoApoderado'"),
                'TEXTO16' => DB::raw("'$tarjetaProfesional'"),
                'TEXTO17' => DB::raw("'$primerTelefonoApoderado'"),
                'TEXTO18' => DB::raw("'$segundoTelefonoApoderado'"),
                'TEXTO19' => DB::raw("'$emailApoderado'"),
                'NUMERO02' => $tipoAudiencia,
                'NUMERO03' => $sedePrincipal,
                'NUMERO04' => $sedeSecundaria,
                'NUMERO05' => $asunto,
                'NUMERO06' => $subAsunto,
                'NUMERO07' => $tipoDocumento,
                'TEXTO21' => DB::raw("'$detalle'"),
                'NUMERO08' => $cuantia,
                'TEXTO22' => DB::raw("'$rutaFinalFile'"),
                'TEXTO23' => DB::raw("'$nombreOriginalFile'")
            ]
            );
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| Problema al Insertar la informacion al sistema TRAMITEUSUARIO ' . $e->getMessage();
        }

        //2) Registrar datos en tramiterespuesta

        //2.0) Extraer consecutivo de tramiterespuesta
        try {
            $user = tramiterespuesta::max('CONSECUTIVO');
            $consecutivo = ($user) + rand(1, 3);
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 2.0) Problema al extraer el consecutivo TR' . $e->getMessage();
        }
        //2.1) Extraer datos del funcionario asignado
        try {
            $datosSolicitante = DB::table('TAB_REPARTO_WEB TR')
                ->select('TR.CONSEC', 'UR.depend_codigo', 'TR.contador')
                ->join("USUARIO_ROL UR", "UR.CONSEC", "TR.CONSEC")
                ->where('TR.ESTADO', 0)
                ->orderBy('contador', 'asc')
                ->first();

            //$datosSolicitante= DB::table('USUARIO_ROL')->where('cedula',DB::raw("TO_CHAR(1010213817)")  )->first();
            $depAsignada = $datosSolicitante->depend_codigo;
            $consecResponsable = $datosSolicitante->consec;
            $contador = $datosSolicitante->contador + 1;
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 2.1) problema al extraer datos del funcionario asignado para el caso' . $e->getMessage();
        }

        //2.2) INSERT DEL PASO 0
        try {
            tramiterespuesta::insert([
                [
                    'NUM_SOLICITUD' => $numSolicitud, 'ID_TRAMITE' => $idTramite, 'NUM_PASO' => 0,
                    'FEC_RESPUESTA' => DB::raw("sysdate"),
                    'TEX_RESPUESTA' => DB::raw("'" . $msg . "'"), 'ID_USU_ADM_CONTESTA' => $consecResponsable,
                    'ID_USU_ADM' => $consecResponsable, 'ESTADO_TRAMITE' => DB::raw("'Remitido'"),
                    'CONSECUTIVO' => $consecutivo, 'VIGENCIA' => $vigencia,
                    'ID_DEPENDENCIA_REG' => $depAsignada, 'ID_DEPENDENCIA_ASIG' => $depAsignada
                ]
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 2.2) Problema al Insertar la informacion al sistema TRAMITERESPUESTA ' . $e->getMessage();
        }

        //2.1.1) actualziar datos del funcionario asignado
        try {
            DB::table('TAB_REPARTO_WEB')
                ->where('CONSEC', $consecResponsable)
                ->update(['contador' => $contador]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 2.1.1) Problema al actualizar los datos del funcionario responsable TAB_REPARTO_WEB' . $e->getMessage();
        }

        $i = 0;
        foreach ($nombreConvocados as $quan) {
            if ($quan != null) {
                try {
                    DB::table('TAB_INVOLUCRADO_WEB')->insert([
                        'NUM_SOLICITUD' => $numSolicitud,
                        'NOMBRE' => DB::raw("'" . $quan . "'"),
                        'EMAIL' => DB::raw("'" . $emailConvocados[$i] . "'"),
                        'ESTADO' => 0,
                    ]);
                }
                catch (\Exception $e) {
                    DB::rollback();
                    return '|0| 4.2.7) Problema al insertar los datos de los convocados. [TAB_INVOLUCRADO_WEB]' . $e->getMessage();
                }
            }
            $i++;
        }

        //3) Envio del email al usuario solicitante verificar si existe

        try {
            $contadorRegistro = DB::table('TRAMITEUSUARIO')
                ->where('NUM_SOLICITUD', DB::raw("'" . $numSolicitud . "'"))
                ->where('ID_TRAMITE', DB::raw("'" . $idTramite . "'"))
                ->count();
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 3.1.0 Problema al indentificar la cantidad de solicitudes realizada [TRAM_USU] <br> ' . $e->getMessage();
        }

        // 3.1 Se asegura que la variable tenga un valor en $emailapoderado

        trim($emailApoderado);
        $data['emailApoderado'] = $emailApoderado;

        if ($contadorRegistro >= 1) {
            try {
                $subject = 'Solicitud conciliaciones Web  - Personería de Bogotá D.C.';
                $data = array(
                    'email' => $email,
                    'subject' => $subject,
                    'numSolicitud' => $numSolicitud,
                    'fechaRegistro' => $fechaRegistroA,
                    'emailApoderado' => $data['emailApoderado']
                );

                Mail::send('frmWeb.email.registroSolicitud', $data, function ($message) use ($data) {
                    $message->from('master@personeriabogota.gov.co', 'Solicitud conciliaciones Web - Personería de Bogotá D.C.');
                    $message->to($data['email']);
                    if (isset($data['emailApoderado']) && !empty($data['emailApoderado'])) {$message->cc($data['emailApoderado']);}
                    //$message->bcc('acastellanos@personeriabogota.gov.co');
                    $message->bcc('ljmeza@personeriabogota.gov.co');
                    $message->bcc('nylopez@personeriabogota.gov.co');
                    $message->bcc('asarmiento@personeriabogota.gov.co');
                    $message->subject($data['subject']);
                });
            }
            catch (\Exception $e) {
                return '|0| 3.0) Problema al enviar el correo de confirmacion: </br>' . $e->getMessage();
            }
            DB::commit();
        }
        else {
            return '|0| 3.0) No es posible enviar el correo electronico ya que no se registraron los datos en el sistema </br>';
        }

        //4) Registro del usuario en USUARIO_ROL
        $depeUsuario = 9999;
        $estadoUsr = 'I';
        $tipoUsr = 'US';
        $nombresUsr = $primerNombre . ' ' . $segundoNombre;
        $apellidosUsr = $primerApellido . ' ' . $segundoApellido;

        //4.1) Extraer consecutivo
        try {
            $user = DB::table('USUARIO_ROL')->max('CONSEC');
            $consec = ($user) + 1;
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 4.1) Problema al extraer el consecutivo USR_ROL' . $e->getMessage();
        }
        //4.2) Preguntar si el usuario existe o no
        try {
            $contadorUsuarioSol = DB::table('USUARIO_ROL')
                ->where('CEDULA', DB::raw("'" . $numeroDocumento . "'"))
                ->count();
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 4.2 Problema al indentificar el estodo del solicitante [USR_ROL] <br>' . $e->getMessage();
        }
        if ($contadorUsuarioSol == 1) {
        //4.2.1) Actualizar dependencai
        /* try {
         DB::table('USUARIO_ROL')
         ->where('CEDULA', DB::raw("'".$numeroDocumento."'"))
         ->update([
         'DEPEND_CODIGO' => $depeUsuario,
         'ESTADO' =>  DB::raw("'".$estadoUsr."'") ,
         'TIPO' =>   DB::raw("'".$tipoUsr."'"),
         ]);
         } catch (\Exception $e) {
         DB::rollback();
         return '|0| 4.2.1 Problema al actualizar el estodo del solicitante [USR_ROL] <br>'.$e->getMessage();
         }
         */
        }
        else {
            //4.2.2) Insertar datos
            try {
                DB::table('USUARIO_ROL')->insert([
                    'CONSEC' => $consec,
                    'NOMBRE' => DB::raw("'" . $nombresUsr . "'"),
                    'APELLIDO' => DB::raw("'" . $apellidosUsr . "'"),
                    'CEDULA' => DB::raw("'" . $numeroDocumento . "'"),
                    'EMAIL' => DB::raw("'" . $email . "'"),
                    'FECHA_CREACION' => DB::raw("sysdate"),
                    'DIRECCION' => $direccion,
                    'TELEFONO' => $primerTelefono,
                    'ESTADO' => DB::raw("'" . $estadoUsr . "'"),
                    'TIPO' => DB::raw("'" . $tipoUsr . "'"),
                    'DEPEND_CODIGO' => DB::raw("'" . $depeUsuario . "'")
                ]);
            }
            catch (\Exception $e) {
                DB::rollback();
                return '|0| 4.2.2) Problema al insertar los datos referentes al al usuario solicitante. [USR_ROL]' . $e->getMessage();
            }
        }

        DB::commit();
        return '|1|El registro finalizo de forma correcta <br> su numero de solicitud es: <strong>' . $numSolicitud . '</strong> <br> Por favor verifique su correo electronico para mas información.';
    }

    // Retornar vista con información del funcionario a atualizar
    public function actualizarDato(Request $request)
    {
        $numSolicitud = $request->input("numSolicitud");
        //0) Verificar que caso exista y con estado 1 de actualización

        try {
            $contadorSolicitudActualizar = DB::table('TRAMITEUSUARIO')
                ->where('NUM_SOLICITUD', $numSolicitud)
                ->where('ID_TRAMITE', 330)
                ->where('NUMERO10', 1)
                ->count();
        }
        catch (\Exception $e) {
            DB::rollback();
            return ((string)\View::make("frmWeb.pagina404"));
        //return '|0| 0.1) Problema al verificar el estado de la solicitud'.$e->getMessage();
        }

        if ($contadorSolicitudActualizar == 0) {
            DB::rollback();
            return ((string)\View::make("frmWeb.pagina404"));
        //return '|0| 0.1) En este momento no se requiere actualizar ninguna información.';
        }
        else {
            //1) Extraer infromacion registrada por el funcionario al solicitante
            try {
                $detalleSolicitud = DB::table('ETAPA_ACTUACION_DOCUMENTO')
                    ->where('NUM_SOLICITUD', $numSolicitud)
                    ->where('ACTUAC_CODIGO', 2588)
                    ->orderBy('CONSECUTIVO', 'desc')
                    ->first();

                $nombreDocumento = $detalleSolicitud->nombre_documento;
                $fechaRegistro = $detalleSolicitud->fecha_registro;
            }
            catch (\Exception $e) {
                DB::rollback();
                return '|0| 1.0) Problema al extraer los datos del funcionario TRAMITERESPUESTA ' . $e->getMessage();
            }
            //2)Retornar vista con datos clave
            $data = array(
                "detalleSolicitud" => $detalleSolicitud,
                "numSolicitud" => $numSolicitud,
                "nombreDocumento" => $nombreDocumento,
                "fechaRegistro" => $fechaRegistro
            );
            return ((string)\View::make("frmWeb.actualizacionDatos", array("data" => $data)));
        }
    }


    public function agregaradjunto(Request $request)
    {
        $numSolicitud = $request->input("numSolicitud");
        

        try {
            $contadorSolicitudActualizar = DB::table('TRAMITEUSUARIO')
                ->where('NUM_SOLICITUD', $numSolicitud)
                ->where('ID_TRAMITE', 330)
                ->where('NUMERO10', 1)
                ->count();
        }
        catch (\Exception $e) {
            DB::rollback();
            return ((string)\View::make("frmWeb.pagina404"));
        //return '|0| 0.1) Problema al verificar el estado de la solicitud'.$e->getMessage();
        }

        if ($contadorSolicitudActualizar == 0) {
            DB::rollback();
            return ((string)\View::make("frmWeb.pagina404"));
        //return '|0| 0.1) En este momento no se requiere actualizar ninguna información.';
        }
        else {
            //1) Extraer infromacion registrada por el funcionario al solicitante
            try {
                $detalleSolicitud = DB::table('ETAPA_ACTUACION_DOCUMENTO')
                    ->where('NUM_SOLICITUD', $numSolicitud)
                    ->where('ACTUAC_CODIGO', 2588)
                    ->orderBy('CONSECUTIVO', 'desc')
                    ->first();

                $nombreDocumento = $detalleSolicitud->nombre_documento;
                $fechaRegistro = $detalleSolicitud->fecha_registro;
            }
            catch (\Exception $e) {
                DB::rollback();
                return '|0| 1.0) Problema al extraer los datos del funcionario TRAMITERESPUESTA ' . $e->getMessage();
            }
            //2)Retornar vista con datos clave
            $data = array(
                "detalleSolicitud" => $detalleSolicitud,
                "numSolicitud" => $numSolicitud,
                "nombreDocumento" => $nombreDocumento,
                "fechaRegistro" => $fechaRegistro
            );
            return ((string)\View::make("frmWeb.actualizacionDatos", array("data" => $data)));
        }
    }



    //Registro de solicitud de actualziar datos por arte del solicitante
    public function registroActualizacionDatos(Request $request)
    {
        //0) Verificar que caso exista y con estado 1 de actualización
        //Datos requeridos por sistema
        $carbonDate = Carbon::now();
        $vigencia = $carbonDate->year;
        $fechaRegistro = date_format($carbonDate, 'd/m/Y h:m:s');
        $fechaRegistroA = date_format($carbonDate, 'd/m/Y h:m:s A');
        $idTramite = 330;
        $depRegistra = 311;
        $idActuacion = 3078;
        $msg = "Registro respuesta ciudadano a solicitud de actualziacion de datos para conciliaciones Web.";
        //Datos del solictante
        $numSolicitud = $request->input("numSolicitud");
        $detalle = $request->input("detalle");
        //0) Cargue de documento
        if ($request->input("detalle") != '' && $request->file("document1") != '') {
            try {
                $document1 = $request->file("document1");
                $nombreOriginalFile = $document1->getClientOriginalName();
                $rutaFinalFile = Storage::disk('local')->put("", $document1);
                $nombreOriginalFile = 'Informacion: ' . $request->input("detalle") . ' <br> Documento: ' . $nombreOriginalFile;
            }
            catch (\Exception $e) {
                DB::rollback();
                return '|0| 0.0) Problema al anexar el soporte en el sistema </br>' . $e->getMessage();
            }
        }
        else if (!empty($request->file("document1"))) {
            try {
                $document1 = $request->file("document1");
                $nombreOriginalFile = $request->file("document1")->getClientOriginalName();
                $rutaFinalFile = Storage::disk('local')->put("", $document1);
            }
            catch (\Exception $e) {
                DB::rollback();
                return '|0| 0.0) Problema al anexar el soporte en el sistema' . $e->getMessage();
            }
        }
        else if ($request->input("detalle") != '') {
            $nombreOriginalFile = $request->input("detalle");
            $rutaFinalFile = '';
        }

        //1) Registro de la actuacion

        //1.0) Traer cosnecutivo tramiterespuesta 
        try {
            $detalleSolicitud = DB::table('TRAMITERESPUESTA')
                ->where('NUM_SOLICITUD', $numSolicitud)
                ->where('ID_TRAMITE', $idTramite)
                ->where('VIGENCIA', $vigencia)
                ->where('ESTADO_TRAMITE', 'Remitido')
                ->first();
            $consecutivo = $detalleSolicitud->consecutivo;
            $consecResponsable = $detalleSolicitud->id_usu_adm;
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 1.0) Problema al extraer el consecutivo TRAMITERESPUESTA ' . $e->getMessage();
        }

        //1.1) Estrael el consecutivo de la lista de docuemntos
        try {
            $contadorSolicitudActualizar = DB::table('ETAPA_ACTUACION_DOCUMENTO')
                ->where('TRARES_CONSECUTIVO', $consecutivo)
                ->count();
            $contadorSolicitudActualizar = $contadorSolicitudActualizar + 1;
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 1.1) Problema al extraer el consecutivo del documento' . $e->getMessage();
        }

        //1.2) Estraer datos del usuario
        try {
            $detalleSolicitud = DB::table('TRAMITEUSUARIO')
                ->where('NUM_SOLICITUD', $numSolicitud)
                ->where('ID_TRAMITE', 330)
                ->first();

            $ccUsr = $detalleSolicitud->id_usuario_reg;
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 1.0) Problema al extraer los datos del funcionario TRAMITEUSUARIO ' . $e->getMessage();
        }

        try {
            $datosFunc = DB::table('USUARIO_ROL')
                ->where('CEDULA', DB::raw("'" . $ccUsr . "'"))
                ->first();
            $consecUSr = $datosFunc->consec;
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 1.2) Problema al extraer datos del funcionario' . $e->getMessage();
        }

        //1.3) Insert ETAPA ACTUACION DOCUMENTO
        try {

            DB::table('ETAPA_ACTUACION_DOCUMENTO')->insert([
                'CONSECUTIVO' => $contadorSolicitudActualizar, 'TRARES_CONSECUTIVO' => $consecutivo,
                'ACTUAC_CODIGO' => $idActuacion, 'FECHA_DOCUMENTO' => DB::raw("SYSDATE"),
                'NOMBRE_DOCUMENTO' => DB::raw("'" . $nombreOriginalFile . "'"),
                'ENLACE' => DB::raw("'" . $rutaFinalFile . "'"), 'IDICADOR_PUBLICACION' => DB::raw("'N'"),
                'IMTIDO_CODIGO' => DB::raw("'0'"), 'USUARIO' => $ccUsr, 'FECHA_REGISTRO' => DB::raw("SYSDATE"),
                'CONSECUTIVO_REGISTRO' => $contadorSolicitudActualizar, 'CONSEC_USUARIO' => $consecUSr,
                'NUM_SOLICITUD' => $numSolicitud, 'DEPENDENCIA_REGISTRA' => 9999, 'ID_TRAMITE' => $idTramite
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 1.2) Problema al Insertar la informacion al sistema ETAPA_ACTUACION_DOCUMENTO ' . $e->getMessage();
        }

        // 1.4) EXTRAER CONSECUTIVO DE EXPEDEINTE DIGITAL
        try {
            $consecutivoSinproc = DB::table('EXPEDIENTE_DIGITAL')->max('CONSECUTIVO_EXPEDIENTE');
            $consecutivoSinproc = $consecutivoSinproc + 1;
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 1.1) Problema al extraer el consecutivo del documento' . $e->getMessage();
        }

        // 1.5) INSERT EXPEDIENTE_DIGITAL
        try {

            DB::table('EXPEDIENTE_DIGITAL')->insert([
                'CONSECUTIVO_EXPEDIENTE' => $consecutivoSinproc,
                'NOMBRE_DOCUMENTO' => DB::raw("'" . $nombreOriginalFile . "'"),
                'RUTA_DOCUMENTO' => DB::raw("'" . $rutaFinalFile . "'"),
                'FECHA_CARGUE' => DB::raw("SYSDATE"),
                'FUNCIONARIO_REGISTRA' => $ccUsr,
                'ID_DEPENDENCIA_REGISTRA' => $depRegistra,
                'ID_TRAMITE' => $idTramite,
                'ESTADO' => DB::raw("'0'"),
                'TRARES_CONSECUTIVO' => $consecutivo,
                'CONSECUTIVO_REGISTRO' => $contadorSolicitudActualizar
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 1.2) Problema al Insertar la informacion al sistema ETAPA_ACTUACION_DOCUMENTO ' . $e->getMessage();
        }

        // 2) Actualizar estado de solicitud para no solicitar nuevo documento
        try {
            DB::table('TRAMITEUSUARIO')
                ->where('num_solicitud', $numSolicitud)
                ->where('id_tramite', $idTramite)
                ->where('vigencia', $vigencia)
                ->update(['NUMERO10' => 0]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 0.2) Problema al actualizar el numero asignado por el sistema' . $e->getMessage();
        }

        DB::commit();
        return '|1|El registro finalizó de forma correcta. <br> La información registrada será validada al interior de la Personería de Bogotá';
    }
    //Descargar archivo word
    public function descargaWord()
    {
        $file = public_path() . "/FORMATO_SOLICITUD_DE_CONCILIACION_V4.DOCX";
        $headers = array(
            'Content-Type: application/word',
        );
        return Response::download($file, 'FORMATO_SOLICITUD_DE_CONCILIACION_V4.DOCX', $headers);
    }
}

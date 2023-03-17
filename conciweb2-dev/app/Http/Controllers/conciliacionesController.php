<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Mail;
use Session;
use Carbon\Carbon;
use File;
use Response;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;
use NumerosEnLetras;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

//use App\User;
//use League\Flysystem\Filesystem;
//use League\Flysystem\Sftp\SftpAdapter;
//use PhpOffice\PhpWord\PhpWord;


class conciliacionesController extends Controller
{
    public function login(){
        $listaSedes = DB::connection('oracleexterna')->table('TAB_SEDES')->get();
        $data=array(
            "listaSedes"=>$listaSedes
        );
        return((String)\View::make("conciliaciones.login", array("data" => $data)));
    }
    //VALIDACION DE QUE EL USAURIO Y CLAVE EXISTAN Y ESTEN CORRECTOS EN EL SISTEMA
    public function validarLogin(Request $request){

        $ccFuncionario=$request->input("ccFuncionario");
        $clave=$request->input("clave");
        $idSede=$request->input("sede");

        $user = User::where('CEDULA',$ccFuncionario)->where('CLAVE', $clave)->first();

        if ($user === null) {
            return '|0|Los datos ingresados no coinciden con algun usuario del sistema por favor contacte con el administrador.';
        }else{
            $datosUsuarios = User::where('CEDULA', $ccFuncionario)
                ->first();
            $emailUser=$datosUsuarios->email;
            $nombreFunc=$datosUsuarios->nombre." ".$datosUsuarios->apellido;

            $datosSede = DB::connection('oracleexterna')->table('TAB_SEDES')
                ->where('IDSEDE', $idSede)
                ->first();
            $nombreSede=$datosSede->nombresede;
            $sigalSede  =$datosSede->siglasede;

            \Session::put("emailUsuario",$emailUser);
            \Session::put("ccFuncionario",$ccFuncionario);
            \Session::put("idSede",$idSede);
            \Session::put("siglaSede",$sigalSede);
            \Session::put("nombreSede",$nombreSede);
            \Session::put("nombreUsuario",$nombreFunc);
            \Session::save();

            return '|1|Los datos ingresados fueron correctos <br> Por favor verifique su correo electrónico y registre el código de seguridad enviado a este.';
        }
    }
    //DIRECCIONAMIENTO AL FORMULARIO PARA REGISTRO DE NUEVO CIUDADANO
    public function moduloGestion(){

        $idSede=Session::get('idSede');
        $ccFuncionario=Session::get('idSede');
        $nombreFunc=Auth::user()->nombre." ". Auth::user()->apellido;
        if(isset($idSede) && isset($ccFuncionario) && isset($nombreFunc)){
            return((String)\View::make("conciliaciones.moduloGestion"));
        }else{
            return((String)\View::make("conciliaciones.moduloGestion"));
        }

    }
    //MODAL PARA MSOTRAR EL FRM PARA UN NUEVO REGISTRO
    public function nuevaConciliacion(){
        $solicitantesServicio = DB::connection('oracleexterna')->table('TAB_SOLICITANTESERVICIO')->where('SICESTADOSOLICITANTESERVICIO',1)->orderBy('SICIDSOLICITANTESERVICIO')->get();
        $finalidadAdquicision = DB::connection('oracleexterna')->table('TAB_TIPOFINALIDADMINISTERIO')->where('SICESTADOTIPOFINALIDADMIN',1)->orderBy('SICIDTIPOFINALIDADMINISTERIO')->get();
        $tiempoConflicto = DB::connection('oracleexterna')->table('TAB_TIEMPOCONFLICTO')->where('SICESTADOTIEMPOCONFLICTO',1)->orderBy('SICIDTIEMPOCONFLICTO')->get();
        $data=array(
            "solicitantesServicio"=>$solicitantesServicio,
            "finalidadAdquicision"=>$finalidadAdquicision,
            "tiempoConflicto"=>$tiempoConflicto
            //"tiempoConflicto"=>$tiempoConflicto
        );
        return((String)\View::make("conciliaciones.modal.nuevaConciliacion", array("data" => $data)));
    }
    //LISTA DE AREAS RETORNA VISTA
    public function comboAreaAsuntoJuridico(Request $request){
        $dato=$request->input("dato");
        $listaAreas = DB::table('TAB_AREA')
            ->where('SICASUNTOJURIDICODEFINIBLE',$dato)
            ->where('SICAREAACTIVA',1)
            ->orderBy('SICNOMBREAREA')
            ->get();
        $data=array(
            "listaAreas"=>$listaAreas
        );

        return((String)\View::make("conciliaciones.combos.area", array("data" => $data)));
    }
    //LISTA DE TEMAS RETORNA VISTA
    public function comboTemaAsuntoJuridico(Request $request){
        $dato=$request->input("dato");

        $listaTemas = DB::table('TAB_ASUNTO')
            ->where('SICIDAREA',$dato)
            ->where('SICASUNTOACTIVA',1)
            ->orderBy('SICNOMBREASUNTO')
            ->get();
        $data=array(
            "listaTemas"=>$listaTemas
        );

        return((String)\View::make("conciliaciones.combos.tema", array("data" => $data)));
    }
    //LISTA DE SUB TEMAS RETORNA VISTA
    public function comboSubTemaAsuntoJuridico(Request $request){
        $dato=$request->input("dato");
        $contador = DB::table('TAB_CLASIFICACIONASUNTO')
            ->where('SICIDASUNTO',$dato)
            ->where('SICCLASIFICACIONASUNTOACTIVA',1)
            ->count();

        //SE CONSULTA SI EXITE INFORMACION PREVIA EN LA TABLA
        if($contador==1) {
            $listaSubTemas = DB::table('TAB_CLASIFICACIONASUNTO')
                ->where('SICIDASUNTO',$dato)
                ->where('SICCLASIFICACIONASUNTOACTIVA',1)
                ->orderBy('SICNOMBRECLASIFICACIONASUNTO')
                ->get();
            $data = array(
                "listaSubTemas" => $listaSubTemas
            );
            return ((String)\View::make("conciliaciones.combos.subTema", array("data" => $data)));
        }else{
            return 0;
        }
    }
    //REGISTRO DE CONCILIACION BASICA EN BASE DE DATOS
    public function registroConciliacion(Request $request){

        $carbonDate = Carbon::now();
        $vigencia= $carbonDate->year;

        $datePlassTreeMonths=Carbon::now()->addMonths(3);
        $datePlassTreeMonths=date_format($datePlassTreeMonths, 'd/m/Y h:m:s');
        $fechaRegistro=date_format($carbonDate, 'd/m/Y h:m:s');
        $numeroCaso=$request->input("numeroDelCaso");
        $solicitanteServicio=$request->input("solicitanteServicio");
        $fechaSolicitud=$request->input("fecSolicitud");
        $finalidad=$request->input("finalidad");
        $tiempoDelConflicto=$request->input("tiempoConflicto");
        $asuntoJuridico=$request->input("customRadioInline1"); //SI ó NO NOSEGUARDA
        $idArea=$request->input("idArea");
        $idTema=$request->input("idTema");
        $idSubTema=$request->input("idSubTema");

        if($idSubTema=='' or $idSubTema=="" or strlen($idSubTema)<=0){$idSubTema=0;}

        $contador = DB::table('TAB_CASO')->where('SICNUMEROREGISTROCONCILIACION',$numeroCaso)->count();
        if($contador>=1) { return '|0|El número de caso digitado ya se encuentra registrado para otro tramite<br>'; }

        //EXTRAER CONSECUTIVO DE BINCONSECUTIVO QUE SERA EL NUMERO DE SINPROC
        try {
            $user = DB::table('BINCONSECUTIVO')->where('vigencia',$vigencia)->first();
            $numSolicitud=$user->secuencial+1;
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al extrael el numero asignado por el sistema';
        }
        //ACTUALIZAR EL CONSECUTIVO PARA QUE NO DAÑE LA CADENA ACENDENTE
        try {
            DB::table('BINCONSECUTIVO')
                ->where('vigencia', $vigencia)
                ->update(['SECUENCIAL' => $numSolicitud]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al actualizar el numero asignado por el sistema';
        }
        try {
            DB::table('TAB_CASO')->insert([
                [
                    'SICNUMEROREGISTROCONCILIACION' => \DB::raw("'".$numeroCaso."'"),
                    'SICFECHASOLICITUD' => \DB::raw("TO_DATE('".$fechaSolicitud."','DD/MM/YYYY HH24:MI:SS')"),
                    'SICIDSOLICITANTESERVICIO' => $solicitanteServicio,
                    'SICIDTIPOFINALIDADMINISTERIO' =>  $finalidad,
                    'SICIDTIEMPOCONFLICTO' => $tiempoDelConflicto,
                    'SICIDASUNTO' => $idTema,
                    'SICIDCLASIFICACIONASUNTO' => $idSubTema,
                    'NUM_SOLICITUD' => $numSolicitud,
                    'VIGENCIA' => $vigencia,
                    'REGISTRADO_POR' => Session::get('ccFuncionario'),
                    'ID_DEPENDENCIA' => 311,
                    'FECHA_VENCIMIENTO' => \DB::raw("TO_DATE('".$datePlassTreeMonths."','DD/MM/YYYY HH24:MI:SS')"),
                    'SICDESCRIPCIONHECHOS' => \DB::raw("' '"),
                    'SICIDUBICACIONHECHOS' => \DB::raw("'0'"),
                    'SICDESCRIPCIONPRETENSIONES'=> \DB::raw("' '"),
                    'SICCUANTIAINDETERMINADA' => 0,
                    'SICCUANTIAPRETENSIONES' => 0,
                    'SICCASOACTIVO'  => \DB::raw("'1'"),
                    'SICCASOREMITIDO' => \DB::raw("'1'"),
                    'SICCASOREPORTADO' => \DB::raw("'1'"),
                    'SICFECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')"),
                    'SICIDDATOENTIDADHABILITADA' => \DB::raw("'1'"),
                    'PASO1' => \DB::raw("'1'"),
                    'SICIDAREA' => $idArea,
                    'SICIDSEDE' => Session::get('idSede')
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al insertar los datos de la conciliación por favor verifique estos datos. [TAB_CASO] <br>'.$e;
        }

        DB::commit();
        return '|1|EL REGISTRO FUE EXITOSO <br> NUMERO DEL CASO :: <strong>'.$numSolicitud.'</strong>';
    }
    //BK: CONSULTA DE CASO YA SEA POR NUMERO DE SINPROC NUMERO DE CASO O NUMERO SICAAC
    public function consultaTramite(Request $request){
        $numCaso=$request->input("numCaso");
        $validador=$request->input("validador");
        $idSede=Session::get('idSede');
        $inicialSede=Session::get('siglaSede');

        //EXTRAER EL NUM SOLICITUD A CONSULTAR
        switch ($validador) {
            case 1:
                $numSolicitud=$numCaso;
                break;
            case 2:
                $numSinproc=$inicialSede.$numCaso;
                $datoConsulta = DB::table('TAB_CASO ')
                    ->select('NUM_SOLICITUD')
                    ->where("SICNUMEROREGISTROCONCILIACION",$numSinproc)
                    ->get();
                $numSolicitud=$datoConsulta->num_solicitud;
                break;
            case 3:
                $datoConsulta = DB::table('TAB_CASO')
                    ->select('NUM_SOLICITUD')
                    ->where("SICCONSECUTIVOEXTERNO",$numCaso)
                    ->get();
                $numSolicitud=$datoConsulta->num_solicitud;
                break;
        }

        //EXTRAER EL ESTADO DE CADA PASO
        $datosEstadoEtapas = DB::table('TAB_CASO')
            ->select('SICNUMEROREGISTROCONCILIACION','PASO2','PASO3','PASO4','PASO5','PASO6','PASO7','PASO8')
            ->where("NUM_SOLICITUD",$numSolicitud)
            ->where("SICIDSEDE",$idSede)
            ->get();

        //TOTAL CONVOCADOS
        $contadorConvocados = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO')
            ->where('SICIDTIPOINVOLUCRADOCASO','CONVOCADO')
            ->where('NUM_SOLICITUD',$numSolicitud)
            ->count();
        //if($contador>=1) { return '|0|El número de caso digitado ya se encuentra registrado para otro tramite<br>'; }

        //TOTAL CONVOCANTES
        $contadorConvocantes = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO')
            ->where('SICIDTIPOINVOLUCRADOCASO','CONVOCANTE')
            ->where('NUM_SOLICITUD',$numSolicitud)
            ->count();

        /*CONTADOR APODERADO CONVOCANTE*/
        $contador = DB::table('TAB_APODERADO_INVOLUCRADO')
            ->where('SICTIPOINVOLUCRADOCASO','CONVOCANTE')
            ->where('NUM_SOLICITUD',$numSolicitud)
            ->count();
        if($contador>=1) {$textoApoderadoConvocante='<i class="fas fa-check fa-1x" ></i>  APODERADO';}else{$textoApoderadoConvocante='APODERADO';}

        /*CONTADOR APODERADO CONVOCADO*/
        $contador = DB::table('TAB_APODERADO_INVOLUCRADO')
            ->where('SICTIPOINVOLUCRADOCASO','CONVOCADO')
            ->where('NUM_SOLICITUD',$numSolicitud)
            ->count();
        if($contador>=1) {$textoApdoeradoConvocado='<i class="fas fa-check fa-1x" ></i>  APODERADO';}else{$textoApdoeradoConvocado='APODERADO';}

        //RESULTADO DE LA CONCILIACION
        $contadorResultado = DB::table('TAB_RESULTADOCONCILIACION')
            ->where('NUM_SOLICITUD',$numSolicitud)
            ->count();

        if($contadorResultado>=1) {
            $casosPendeintes = DB::table('TAB_CASO as TC')
                ->select('TR.SICIDRESULTADOCONCILIACION','TR.SICIDTIPORESULTADOCONCILIACION')
                ->join("TAB_RESULTADOCONCILIACION as TR","TR.NUM_SOLICITUD","TC.NUM_SOLICITUD")
                ->where("TR.NUM_SOLICITUD",$numSolicitud)
                ->first();
            $resultadoPadre=$casosPendeintes->sicidresultadoconciliacion;
            $tipoResultado=$casosPendeintes->sicidtiporesultadoconciliacion;

            /************ RUTA PARA LA IMPRESIÓN DE ACTAS DE CONCILIACIÓN  *******************/
            /**********************************************************************************
            $tipoResultado		$resultadoPadre			TEXTO
            4					1						CONCILIACIÓN PARCIAL
            5					1						CONCILIACIÓN TOTAL
            7					2						ASUNTO NO CONCILIABLE
            8					3						FALTA DE COMPETENCIA
            9					3						RETIRO DE LA SOLICITUD
            10					3						ACUERDO EXTRACONCILIACIÓN
            12					3						OTROS
            13					6						AMBAS PARTES
            14					6						CONVOCANTE
            15					6						CONVOCADO
            17					2						NO ACUERDO
             *********************************************************************************/

            switch ($resultadoPadre) {
                case 1:	$carpeta="acta";	break;
                case 2:	$carpeta="constancia";	break;
                case 6:	$carpeta="inasistencia";	break;
                case 3: $carpeta="otros";	break;
            }
            switch ($tipoResultado) {
                case 4:	$archivo="conciliacionParcial.php";	$tipo=1; break;
                case 5:	$archivo="conciliacionTotal.php"; $tipo=0;	break;
                case 7:	$archivo="asuntoNoConciliable.php";	$tipo=2; break;
                case 8: $archivo="sinDefinir";	$tipo=9999; break;
                case 9: $archivo="sinDefinir";	$tipo=9999; break;
                case 10: $archivo="sinDefinir";	$tipo=9999; break;
                case 12: $archivo="sinDefinir";	$tipo=9999; break;
                case 13: $archivo="inasistencia2partes.php";	$tipo=4; break;
                case 14: $archivo="inasistenciaConvocante.php";	$tipo=6; break;
                case 15: $archivo="inasistenciaConvocado.php";	$tipo=5; break;
                case 17: $archivo="noAcuerdo.php";	$tipo=3; break;
                default:  $archivo="sinDefinir"; $tipo=9999;  break;
            }
        }else{
            $carpeta='NULL';
            $archivo='NULL';
            $tipo=9999;
        }

        $data=array(
            "datosEstadoEtapas"=>$datosEstadoEtapas,
            "contadorConvocados"=>$contadorConvocados,
            "textoApoderadoConvocante"=>$textoApoderadoConvocante,
            "textoApdoeradoConvocado"=>$textoApdoeradoConvocado,
            "carpeta"=>$carpeta,
            "archivo"=>$archivo,
            "tipo"=>$tipo,
            "numSolicitud"=>$numSolicitud

        );

        return((String)\View::make("conciliaciones.resultadoConsulta", array("data" => $data)));

    }
    //MODAL CON LOS DATOS DE LOS HECHOS Y LA CUANTIA
    public function modalInfoHechos(Request $request){
        $numSinproc=$request->input("sinproc");

        $datosHehcos = DB::table('TAB_CASO')
            ->select('SICDESCRIPCIONHECHOS','SICDESCRIPCIONPRETENSIONES','SICCUANTIAPRETENSIONES')
            ->where("NUM_SOLICITUD",$numSinproc)
            ->get();

        //dd($datosHehcos);

        $data=array(
            "datosHehcos"=>$datosHehcos,
            "numSolicitud"=>$numSinproc
        );

        return((String)\View::make("conciliaciones.modal.infoHechos", array("data" => $data)));

    }
    //REGISTRO DE HECHOS BASICA EN BASE DE DATOS
    public function registroHechos(Request $request){
        $numSolicitud=$request->input("numSolicitud");
        $descripHechos=strtoupper($request->input("descripHechos"));
        $cuantia=$request->input("cuantia");
        $carbonDate = Carbon::now();
        $fechaRegistro=date_format($carbonDate, 'd/m/Y h:m:s');
        $funcRegistra=Session::get('ccFuncionario');
        if($cuantia!=0){
            $cuantiaDetermina=0;
        }else{
            $cuantiaDetermina=-1;
        }

        //UPDATE HECHOS Y PRETENCIONES
        try {
            DB::table('TAB_CASO')
                ->where('NUM_SOLICITUD', $numSolicitud)
                ->update(['SICDESCRIPCIONHECHOS' => \DB::raw("'$descripHechos'"), 'SICDESCRIPCIONPRETENSIONES' => \DB::raw("'$descripHechos'"),
                    'SICCUANTIAPRETENSIONES' =>$cuantia , 'SICCUANTIAINDETERMINADA' =>$cuantiaDetermina,
                    'IDUSUARIOHECHOS' => $funcRegistra, 'FECHAREGISTROHECHOS' =>\DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')"),]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al actualizar los hechos [TAB_CASO] <br>'.$e;
        }

        //UPDATE ESTADO TAB_CASO
        try {
            DB::table('TAB_CASO')
                ->where('NUM_SOLICITUD', $numSolicitud)
                ->update(['PASO4' => 1]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al actualizar el estodo del registro  [TAB_CASO] <br>'.$e;
        }


        DB::commit();
        return '|1|ATENCIÓN...!. La información ha sido registrada correctamente.';
    }
    //MODAL CON LA LISTA DE CONCILAIDORES POR SEDE
    public function modalInfoConciliador(Request $request){
        $numSinproc=$request->input("sinproc");
        $idSede=Session::get('idSede');

        $actualAbogado = DB::connection('oracleexterna')->table('TAB_CASO as TC')
            ->select('TOP.SICNOMBREPERSO','TOP.SICIDPERSONA','TOP.SICAPELLIDOPERSO')
            ->join("TAB_OPERADORCASO as TOC","TOC.SICIDCASO","TC.SICNUMEROREGISTROCONCILIACION")
            ->join("TAB_OPERADOR as TOP","TOP.SICIDPERSONA","TOC.SICIDOPERADORCASO")
            ->where("TC.NUM_SOLICITUD",$numSinproc)
            ->get();

        $listaAbogados = DB::connection('oracleexterna')->table('TAB_OPERADOR')
            ->select('SICIDPERSONA','SICNOMBREPERSO','SICAPELLIDOPERSO')
            ->where("SICSEDEPER",$idSede)
            ->orderBy('SICNOMBREPERSO')
            ->get();

        $data=array(
            "actualAbogado"=>$actualAbogado,
            "listaAbogados"=>$listaAbogados,
            "numSolicitud"=>$numSinproc
        );

        return((String)\View::make("conciliaciones.modal.infoConciliador", array("data" => $data)));
    }
    //REGISTRO DEL CONCILIADOR EN BASE DE DATOS
    public function registroConciliador(Request $request){
        $numSolicitud=$request->input("numSolicitud");
        $idConciliador=$request->input("idConciliador");
        $carbonDate = Carbon::now();
        $fechaRegistro=date_format($carbonDate, 'd/m/Y h:m:s');

        $data = DB::table('TAB_CASO')->where('NUM_SOLICITUD',$numSolicitud)->first();
        $sicIdCaso=$data->sicnumeroregistroconciliacion;

        $contador = DB::table('TAB_OPERADORCASO')->where('NUM_SOLICITUD',$numSolicitud)->count();
        if($contador==0) {
            //GENERA INSERT
            try {
                DB::table('TAB_OPERADORCASO')->insert([
                    [
                        'SICIDOPERADORCASO' => $idConciliador,
                        'SICIDCASO' =>  \DB::raw("'$sicIdCaso'"),
                        'SICIDOPERADORCENTROFUNMEC' => Session::get('idSede'),
                        'SICOPERADORACTIVO' =>  \DB::raw("'A'"),
                        'NUM_SOLICITUD' => $numSolicitud,
                        'FECHA_REGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')"),
                        'IDUSUARIO' => Session::get('ccFuncionario'),
                        'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')"),
                        'ETAPA' => 5
                    ]
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos del conciliador por favor verifique estos datos. [TAB_CASO] <br>'.$e;
            }
        }else{
            //GENERA UPDATE
            try {
                DB::table('TAB_OPERADORCASO')
                    ->where('NUM_SOLICITUD', $numSolicitud)
                    ->where('SICIDCASO', \DB::raw("'$sicIdCaso'"))
                    ->update(['SICIDOPERADORCASO' => $idConciliador,'IDUSUARIO'=> Session::get('ccFuncionario'),
                        'FECHAREGISTRO'=> \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al actualizar el Conciliador seleccionado <br>'.$e;
            }
        }

        //UPDATE ESTADO TAB_CASO
        try {
            DB::table('TAB_CASO')
                ->where('NUM_SOLICITUD', $numSolicitud)
                ->update(['PASO5' => 1]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al actualizar el estodo del registro  [TAB_CASO] <br>'.$e;
        }


        DB::commit();
        return '|1|ATENCIÓN...!. La información ha sido actualizada correctamente.';
    }
    //MODAL CON LA INFROMACION DE AUDIENCIA FECHA Y DESCRIPCION
    public function modalInfoAudiencia(Request $request){
        $numSinproc=$request->input("sinproc");

        $detalleAudiencia = DB::table('TAB_SESIONAUDIENCIACONCI as TS')
            ->select( DB::raw("TO_CHAR(TS.SICFECHASESIONAUDIENCIACONCILI, 'DD/MM/YY HH24:MI') as SICFECHASESIONAUDIENCIACONCILI") ,'TS.SICDETALLESSESIONAUDIENCIACONC')
            ->join("TAB_CASO as TC","TC.SICNUMEROREGISTROCONCILIACION","TS.SICIDCASO")
            ->where("TC.NUM_SOLICITUD",$numSinproc)
            ->get();

        $data=array(
            "detalleAudiencia"=>$detalleAudiencia,
            "numSolicitud"=>$numSinproc
        );

        return((String)\View::make("conciliaciones.modal.infoAudiencia", array("data" => $data)));        $data=array(
            "detalleAudiencia"=>$detalleAudiencia,
            "numSolicitud"=>$numSinproc
        );

        return((String)\View::make("conciliaciones.modal.infoAudiencia", array("data" => $data)));
    }
    //REGISTRO DE LA AUDIENCIA  EN BASE DE DATOS
    public function registroAudiencia (Request $request){
        $numSolicitud=$request->input("numSolicitud");
        $fechaSession=$request->input("fechaSesion");
        $detalleSession=strtoupper($request->input("detalleSesion"));
        $carbonDate = Carbon::now();
        $fechaRegistro=date_format($carbonDate, 'd/m/Y h:m:s');

        $data = DB::table('TAB_CASO')->where('NUM_SOLICITUD',$numSolicitud)->first();
        $sicIdCaso=$data->sicnumeroregistroconciliacion;

        /*CONTADOR DATOS DE LA SESSION*/
        $contador = DB::table('TAB_SESIONAUDIENCIACONCI')
            ->where('SICIDCASO',\DB::raw("'$sicIdCaso'"))
            ->count();
        if($contador==0) {
            //GENERA INSERT
            $user = DB::table('TAB_SESIONAUDIENCIACONCI')->max('SICIDSESIONAUDIENCIACONCILIACI');
            $idSesionAudi=$user+1;

            try {
                DB::table('TAB_SESIONAUDIENCIACONCI')->insert([
                    [
                        'SICIDSESIONAUDIENCIACONCILIACI' => $idSesionAudi,
                        'SICIDCASO' =>  \DB::raw("'$sicIdCaso'"),
                        'SICFECHASESIONAUDIENCIACONCILI' => \DB::raw("TO_DATE('".$fechaSession."','DD/MM/YYYY HH24:MI:SS')"),
                        'SICDETALLESSESIONAUDIENCIACONC' =>  \DB::raw("'$detalleSession'"),
                        'IDUSUARIO' => Session::get('ccFuncionario'),
                        'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')"),
                        'ETAPA' => 6
                    ]
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos del conciliador por favor verifique estos datos. [TAB_CASO] <br>'.$e;
            }
        }else{
            //GENERA UPDATE
            try {
                DB::table('TAB_SESIONAUDIENCIACONCI')
                    ->where('SICIDCASO',\DB::raw("'$sicIdCaso'"))
                    ->update(['SICFECHASESIONAUDIENCIACONCILI' => \DB::raw("TO_DATE('".$fechaSession."','DD/MM/YYYY HH24:MI:SS')"),'SICDETALLESSESIONAUDIENCIACONC'=> \DB::raw("'$detalleSession'"),
                        'IDUSUARIO'=> Session::get('ccFuncionario'), 'FECHAREGISTRO'=> \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al actualizar el Conciliador seleccionado <br>'.$e;
            }
        }

        //UPDATE ESTADO TAB_CASO
        try {
            DB::table('TAB_CASO')
                ->where('NUM_SOLICITUD', $numSolicitud)
                ->update(['PASO6' => 1]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al actualizar el estodo del registro  [TAB_CASO] <br>'.$e;
        }

        DB::commit();
        return '|1|ATENCIÓN...!. La información ha sido actualizada correctamente.';

    }
    //MODAL CON LA INJFORMACION DEL CONFLICTO
    public function modalInfoConflicto(Request $request){
        $numSinproc=$request->input("sinproc");

        //DB::enableQueryLog();

        $escaladaConflicto = DB::table('TAB_CONCILIACION TCO')
            ->select('TE.SICNOMBREESCALADACONFLICTOCONC','TE.SICIDESCALADACONFLICTOCONCILIA')
            ->join("TAB_CASO TC","TC.SICNUMEROREGISTROCONCILIACION","TCO.SICIDCASO")
            ->join("TAB_ESCALADACONFLICTOCONCI TE","TE.SICIDESCALADACONFLICTOCONCILIA","TCO.SICIDESCALADACONFLICTOCONCILIA")
            ->where("TC.NUM_SOLICITUD",$numSinproc)
            ->get();

        $intervencionTercero = DB::table('TAB_CASO TC')
            ->select('TT.SICNOMBRETERCEROCONCILIACION','TT.SICIDTERCERO')
            ->join("TAB_INTERVENCIONTERCEROCONCI TI","TI.SICIDCASO","TC.SICNUMEROREGISTROCONCILIACION")
            ->join("TAB_TERCEROCONCILIACION TT","TT.SICIDTERCERO","TI.SICIDTERCEROCONCILIACION")
            ->where("TC.NUM_SOLICITUD",$numSinproc)
            ->get();

        $documentoTercero = DB::table('TAB_CASO TC')
            ->select('TD.SICNOMBREDOCUMENTOINTERVENCION','TD.SICIDDOCUMENTOINTERVENCION')
            ->join("TAB_INTERVENCIONTERCEROCONCI TI","TI.SICIDCASO","TC.SICNUMEROREGISTROCONCILIACION")
            ->join("TAB_TERCEROCONCILIACION TT","TT.SICIDTERCERO","TI.SICIDTERCEROCONCILIACION")
            ->join("TAB_DOCINTERVENTERCEROCONCI TD","TD.SICIDDOCUMENTOINTERVENCION","TI.SICIDDOCUMENTOINTERVENCIONTERC")
            ->where("TC.NUM_SOLICITUD",$numSinproc)
            ->get();

        $fechaIntervencion = DB::table('TAB_CASO TC')
            ->select( DB::raw("TO_CHAR(TI.SICFECHAINTERVENCIONTERCEROCON, 'DD/MM/YY') as SICFECHAINTERVENCIONTERCEROCON"))
            ->join("TAB_INTERVENCIONTERCEROCONCI TI","TI.SICIDCASO","TC.SICNUMEROREGISTROCONCILIACION")
            ->join("TAB_TERCEROCONCILIACION TT","TT.SICIDTERCERO","TI.SICIDTERCEROCONCILIACION")
            ->where("TC.NUM_SOLICITUD",$numSinproc)
            ->get();

        $listaIntervenTerceros = DB::table('TAB_TERCEROCONCILIACION')
            ->select('SICIDTERCERO','SICNOMBRETERCEROCONCILIACION')
            ->orderBy('SICIDTERCERO')
            ->get();

        $listaEscaladaClonflicto = DB::table('TAB_ESCALADACONFLICTOCONCI')
            ->select('SICIDESCALADACONFLICTOCONCILIA','SICNOMBREESCALADACONFLICTOCONC')
            ->orderBy("SICIDESCALADACONFLICTOCONCILIA")
            ->get();

        $listaDocFirmados = DB::table('TAB_DOCINTERVENTERCEROCONCI')
            ->select('SICIDDOCUMENTOINTERVENCION','SICNOMBREDOCUMENTOINTERVENCION')
            ->orderBy('SICIDDOCUMENTOINTERVENCION')
            ->get();

        $data=array(
            "escaladaConflicto"=>$escaladaConflicto,
            "intervencionTercero"=>$intervencionTercero,
            "documentoTercero"=>$documentoTercero,
            "fechaIntervencion"=>$fechaIntervencion,
            "listaIntervenTerceros"=>$listaIntervenTerceros,
            "listaEscaladaClonflicto"=>$listaEscaladaClonflicto,
            "listaDocFirmados"=>$listaDocFirmados,
            "numSolicitud"=>$numSinproc
        );

        //dd(DB::getQueryLog());
        return((String)\View::make("conciliaciones.modal.infoConflicto", array("data" => $data)));
    }
    //REGISTRO NBASE DE DATOS DEL MANEJO DEL CONFLICTO
    public function registroManejoConflicto(Request $request){

        $numSolicitud=$request->input("numSolicitud");
        $idEscaladaConflicto=$request->input("idEscaladaConflicto");
        $idTipoTercero=$request->input("idTipoTercero");
        $fechaIntervencion=$request->input("fechaIntervencion");
        $idTipoDocumentoFinal=$request->input("idTipoDocumentoFinal");
        $carbonDate = Carbon::now();
        $fechaRegistro=date_format($carbonDate, 'd/m/Y h:m:s');

        $data = DB::table('TAB_CASO')->where('NUM_SOLICITUD',$numSolicitud)->first();
        $sicIdCaso=$data->sicnumeroregistroconciliacion;

        $contador = DB::table('TAB_CONCILIACION')
            ->where('SICIDCASO',\DB::raw("'$sicIdCaso'"))
            ->count();

        //PARTE 1
        if($contador==0) {
            //INSERT
            try {
                DB::table('TAB_CONCILIACION')->insert([
                    [
                        'SICIDCASO' =>  \DB::raw("'$sicIdCaso'"),
                        'SICNUMERORESGISTROCONCILIACION' => \DB::raw("'$sicIdCaso'"),
                        'SICIDESCALADACONFLICTOCONCILIA' =>  $idEscaladaConflicto,
                        'IDUSUARIO' => Session::get('ccFuncionario'),
                        'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')"),
                        'ETAPA' => 7
                    ]
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos referentes al conflicto por favor verifique estos datos. [TAB_CASO] <br>'.$e;
            }
        }else{
            //UPDATE
            try {
                DB::table('TAB_CONCILIACION')
                    ->where('SICIDCASO',\DB::raw("'$sicIdCaso'"))
                    ->update(['SICIDESCALADACONFLICTOCONCILIA' =>$idEscaladaConflicto,
                        'IDUSUARIO'=> Session::get('ccFuncionario'), 'FECHAREGISTRO'=> \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al actualizar los datos del conflicto <br>'.$e;
            }
        }
        //PARTE 2

        if($idTipoTercero!='' and $idTipoTercero!="" and strlen($idTipoTercero)>=1
            or $idTipoDocumentoFinal!='' and $idTipoDocumentoFinal!="" and strlen($idTipoDocumentoFinal)>=1
            or $fechaIntervencion!='' and $fechaIntervencion!="" and strlen($fechaIntervencion)>=1){

            $contador = DB::table('TAB_INTERVENCIONTERCEROCONCI')
                ->where('SICIDCASO',\DB::raw("'$sicIdCaso'"))
                ->count();
            if($contador==0) {
                //INSERT
                try {
                    DB::table('TAB_INTERVENCIONTERCEROCONCI')->insert([
                        [
                            'SICIDCASO' =>  \DB::raw("'$sicIdCaso'"),
                            'SICIDTERCEROCONCILIACION' => $idTipoTercero,
                            'SICIDDOCUMENTOINTERVENCIONTERC' =>  $idTipoDocumentoFinal,
                            'SICFECHAINTERVENCIONTERCEROCON' => \DB::raw("TO_DATE('".$fechaIntervencion."','DD/MM/YYYY HH24:MI:SS')"),
                            'IDUSUARIO' => Session::get('ccFuncionario'),
                            'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')"),
                            'ETAPA' => 7
                        ]
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return '|0|Problema al insertar los datos referentes al conflicto por favor verifique estos datos. [TAB_CASO] <br>'.$e;
                }
            }else{
                //UPDATE
                try {
                    DB::table('TAB_INTERVENCIONTERCEROCONCI')
                        ->where('SICIDCASO',\DB::raw("'$sicIdCaso'"))
                        ->update(['SICIDTERCEROCONCILIACION' =>$idTipoTercero, 'SICIDDOCUMENTOINTERVENCIONTERC' =>  $idTipoDocumentoFinal,
                            'SICFECHAINTERVENCIONTERCEROCON' =>  \DB::raw("TO_DATE('".$fechaIntervencion."','DD/MM/YYYY HH24:MI:SS')"),
                            'IDUSUARIO'=> Session::get('ccFuncionario'), 'FECHAREGISTRO'=> \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return '|0|Problema al actualizar los datos del conflicto <br>'.$e;
                }
            }
        }

        try {
            DB::table('TAB_CASO')
                ->where('NUM_SOLICITUD', $numSolicitud)
                ->update(['PASO7' => 1]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al actualizar el estodo del registro  [TAB_CASO] <br>'.$e;
        }

        DB::commit();
        return '|1|ATENCIÓN...!. La información ha sido actualizada correctamente.';
    }
    //MODAL PARA REGISTRAR O MOSTRAR LOS CONVOCANTES
    public function modalConvcaConvocan(Request $request){
        $numSinproc=$request->input("sinproc");
        $rol=$request->input("rol");
        $data=array(
            "numSolicitud"=>$numSinproc,
            "rol"=>$rol
        );
        return((String)\View::make("conciliaciones.modal.moduloRegistroInvolucrado", array("data" => $data)));
    }
    //RETURN VIEW DE TIPO DE INVOLUCRADO
    public function tipoInvolucradoView(Request $request){
        $dato=$request->input("dato");
        if($dato==1){

            $listaTipoDoc = DB::table('TAB_TIPODOCUMENTOIDENTIDAD')
                ->select('SICIDTIPODOCUMENTOIDENTIDAD','SICTIPODOCUMENTOIDENTIDAD')
                ->orderBy('SICTIPODOCUMENTOIDENTIDAD')
                ->get();

            $listaEscolaridad = DB::table('TAB_GRADOESCOLARIDAD')
                ->select('SICIDGRADOESCOLARIDAD','SICGRADOESCOLARIDAD')
                ->orderBy('SICGRADOESCOLARIDAD')
                ->get();

            $listaDepartamento = DB::table('TAB_DEPARTAMENTO')
                ->select('SICIDDEPARTAMENTO','SICDEPARTAMENTO')
                ->where('SICIDPAIS',170)
                ->orderBy('SICDEPARTAMENTO')
                ->get();

            $data=array(
                "listaTipoDoc"=>$listaTipoDoc,
                "listaEscolaridad"=>$listaEscolaridad,
                "listaDepartamento"=>$listaDepartamento
            );

            return((String)\View::make("conciliaciones.modal.moduloRegistroInvolucradoPersona", array("data" => $data)));
        }else{

            $listaTipoDoc = DB::table('TAB_TIPODOCUMENTOIDENTIDAD')
                ->select('SICIDTIPODOCUMENTOIDENTIDAD','SICTIPODOCUMENTOIDENTIDAD')
                ->orderBy('SICTIPODOCUMENTOIDENTIDAD')
                ->get();
            $tipoEntidadPublica = DB::table('TAB_TIPOENTIDADPUBLICA')
                ->select('SICIDTIPOENTIDADPUBLICA','SICTIPOENTIDADPUBLICA')
                ->orderBy('SICTIPOENTIDADPUBLICA')
                ->get();
            $tipoSectorEconomico = DB::table('TAB_SECTORECONOMICO')
                ->select('SICIDSECTORECONOMICO','SICSECTORECONOMICO')
                ->orderBy('SICSECTORECONOMICO')
                ->get();
            $listaDepartamento = DB::table('TAB_DEPARTAMENTO')
                ->select('SICIDDEPARTAMENTO','SICDEPARTAMENTO')
                ->where('SICIDPAIS',170)
                ->orderBy('SICDEPARTAMENTO')
                ->get();

            $data=array(
                "listaTipoDoc"=>$listaTipoDoc,
                "tipoEntidadPublica"=>$tipoEntidadPublica,
                "tipoSectorEconomico"=>$tipoSectorEconomico,
                "listaDepartamento"=>$listaDepartamento
            );

            return((String)\View::make("conciliaciones.modal.moduloRegistroInvolucradoOrganizacion", array("data" => $data)));
        }

    }
    //MODAL PARA MSOTRAR LA LISTA DE TRAMITES ACTIVOS EN EL SISTEMA
    public function tramitesActivos(){

        $conciliacionesActivas = DB::table('TAB_CASO')
            ->select('SICNUMEROREGISTROCONCILIACION','NUM_SOLICITUD','PASO2','PASO3','PASO4','PASO5','PASO6','PASO7','PASO8')
            ->where('SICIDSEDE',Session::get('idSede'))
            ->where('PASO8','<>',1)
            ->get();

        $data=array(
            "conciliacionesActivas"=>$conciliacionesActivas
        );
        return((String)\View::make("conciliaciones.modal.tramitesActivos", array("data" => $data)));
    }
    //FUNCION PARA SABER SI EL CIUDADANO TYA EXISTE EN EL SISTEMA
    public function consultaDatosCiudadano(Request $request){

        $numeroDocuemnto=$request->input("numeroDocuemnto");
        $contador = DB::table('TAB_PERSONA')->where('SICIDENTIFICACION',$numeroDocuemnto)->count();
        if($contador==0){ return 'null'; }else{
            $datosCiudadano = DB::table('TAB_PERSONA')
                ->select('SICCIUDADEXPEDICION','SICPRIMERNOMBRE','SICSEGUNDONOMBRE','SICPRIMERAPELLIDO','SICSEGUNDOAPELLIDO','SICDIRECCION',
                    'SICTELEFONO','SICCELULAR','SICIDTIPODOCUMENTO','SICNATURALEZA','SICIDGRADOESCOLARIDAD','SICESTRATO','SICSEXO',
                    \DB::raw("TO_CHAR(SICFECHANACIMIENTO,'DD/MM/yyyy') SICFECHANACIMIENTO"))
                ->where('SICIDENTIFICACION',$numeroDocuemnto)
                ->get();
            return $datosCiudadano;
        }

    }
    //FUNCION PARA SABER LA LISTA DE CIUDADES
    public function consultalistaCiudadaes(Request $request){
        $idDeparamento=$request->input("idDeparamento");

        $departamentos = DB::table('TAB_CIUDAD')
            ->select('SICCIUDAD','SICIDCIUDAD')
            ->where('SICIDDEPARTAMENTO',$idDeparamento)
            ->get();
        return $departamentos;
    }
    //REGISTRO BD CONVOCANTE/CONVOCADO PERDONA U ORGANIZACION
    public function registroCiudadano(Request $request){

        $numSolicitud=$request->input("numSolicitud");
        $rolCiudadano=$request->input("rolCiudadano"); //CONVOCANTE - CONVOCADO
        $tipo=$request->input("tipo"); //1 PERSONA
        if($rolCiudadano=='CONVOCANTE'){$etapa='2'; $pasoCambio='PASO2';}else{$etapa='3'; $pasoCambio='PASO3';}
        $tipoDocumento=$request->input("tipoDocumento");
        $numeroDocuemnto=$request->input("numeroDocuemnto");
        $ciudadExpedicion=strtoupper($request->input("ciudadExpedicion"));
        $tipoPersona=$request->input("tipoPersona");
        $primerNombre=strtoupper($request->input("primerNombre"));
        $segundoNombre=strtoupper($request->input("segundoNombre"));
        $primerApellido=strtoupper($request->input("primerApellido"));
        $segundoApellido=strtoupper($request->input("segundoApellido"));
        $fechaNacimiento=$request->input("fechaNacimiento");
        $tipoGenero=$request->input("tipoGenero");
        $gradoEscolaridad=$request->input("gradoEscolaridad");
        $direccion=$request->input("direccion");
        $tipoDepartamento=$request->input("tipoDepartamento");
        $tipoCiudad=$request->input("tipoCiudad");
        $tipoEstrato=$request->input("tipoEstrato");
        $telefono=$request->input("telefono");
        $carbonDate = Carbon::now();
        $fechaRegistro=date_format($carbonDate, 'd/m/Y h:m:s');
        $datosTramite = DB::table('TAB_CASO')->where('NUM_SOLICITUD',$numSolicitud)->first();
        $idCaso=$datosTramite->sicnumeroregistroconciliacion;

        $contador = DB::table('TAB_PERSONA')->where('SICIDENTIFICACION',$numeroDocuemnto)->count();
        if($contador==0){
            //INGRESA A INSERT
            //EXTRAER SICIDPERSONA
            try {
                $user =DB::table('TAB_PERSONA')->orderBy('SICIDPERSONA', 'desc')->first();
                $sicIdPersona=$user->sicidpersona+1;
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al extrael el numero asignado por el sistema'.$e;
            }

            try {
                DB::table('TAB_PERSONA')->insert([
                    [
                        'SICIDPERSONA' =>  $sicIdPersona, 'SICIDTIPODOCUMENTO' =>$tipoDocumento, 'SICCIUDADEXPEDICION' => \DB::raw("'$ciudadExpedicion'"),
                        'SICNATURALEZA' => \DB::raw("'$tipoPersona'"), 'SICPRIMERNOMBRE' => \DB::raw("'$primerNombre'"), 'SICSEGUNDONOMBRE' => \DB::raw("'$segundoNombre'"),
                        'SICPRIMERAPELLIDO' => \DB::raw("'$primerApellido'"), 'SICSEGUNDOAPELLIDO' => \DB::raw("'$segundoApellido'"), 'SICIDNACIONALIDAD' => 170,
                        'SICFECHANACIMIENTO' => \DB::raw("TO_DATE('".$fechaNacimiento."','DD/MM/YYYY')"), 'SICSEXO' => \DB::raw("'$tipoGenero'"),
                        'SICIDGRADOESCOLARIDAD' => $gradoEscolaridad, 'SICIDPAIS' => 170, 'SICIDCIUDAD' => $tipoCiudad, 'SICDIRECCION' => \DB::raw("'$direccion'"),
                        'SICESTRATO' => $tipoEstrato, 'SICTELEFONO' =>\DB::raw("'$telefono'") , 'SICCELULAR' => \DB::raw("'$telefono'"), 'SICIDENTIFICACION' => $numeroDocuemnto,
                        'IDUSUARIO' =>  Session::get('ccFuncionario'), 'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                    ]
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos referentes al conflicto por favor verifique estos datos. [TAB_CASO] <br>'.$e;
            }
        }else{
            //INGRESA A UPDATE
            //EXTRAER SICIDPERSONA
            try {
                $user = DB::table('TAB_PERSONA')->where('SICIDENTIFICACION',$numeroDocuemnto)->first();
                $sicIdPersona=$user->sicidpersona;
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al extrael el numero asignado por el sistema';
            }
            try {
                DB::table('TAB_PERSONA')
                    ->where('SICIDENTIFICACION',$numeroDocuemnto)
                    ->update([
                        'SICIDPERSONA' =>  $sicIdPersona, 'SICIDTIPODOCUMENTO' =>$tipoDocumento, 'SICCIUDADEXPEDICION' => \DB::raw("'$ciudadExpedicion'"),
                        'SICNATURALEZA' => \DB::raw("'$tipoPersona'"), 'SICPRIMERNOMBRE' => \DB::raw("'$primerNombre'"), 'SICSEGUNDONOMBRE' => \DB::raw("'$segundoNombre'"),
                        'SICPRIMERAPELLIDO' => \DB::raw("'$primerApellido'"), 'SICSEGUNDOAPELLIDO' => \DB::raw("'$segundoApellido'"), 'SICIDNACIONALIDAD' => 170,
                        'SICFECHANACIMIENTO' => \DB::raw("TO_DATE('".$fechaNacimiento."','DD/MM/YYYY')"), 'SICSEXO' => \DB::raw("'$tipoGenero'"),
                        'SICIDGRADOESCOLARIDAD' => $gradoEscolaridad, 'SICIDPAIS' => 170, 'SICIDCIUDAD' => $tipoCiudad, 'SICDIRECCION' => \DB::raw("'$direccion'"),
                        'SICESTRATO' => $tipoEstrato, 'SICTELEFONO' =>\DB::raw("'$telefono'") , 'SICCELULAR' => \DB::raw("'$telefono'"),
                        'IDUSUARIO' =>  Session::get('ccFuncionario'), 'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                    ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos por favor verifique estos datos. [TAB_PERSONA]  <br>'.$e;
            }
        }

        //INSERT EN TAB_INVOLUCRADOCASO PARA RELACIONAR A LA PERSONA AL CASO
        try {
            DB::table('TAB_INVOLUCRADOCASO')->insert([
                [
                    'SICIDINVOLUCRADOCASO' =>  $numeroDocuemnto, 'SICTIPOINVOLUCRADOCASO' => \DB::raw("'$rolCiudadano'") , 'SICIDCASO' => \DB::raw("'$idCaso'"),
                    'NUM_SOLICITUD' => $numSolicitud, 'IDUSUARIO' =>  Session::get('ccFuncionario'),  'ETAPA' => $etapa,
                    'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al insertar los datos por favor verifique estos datos. [TAB_INVOLUCRADOCASO] <br>'.$e;
        }
        //UPDATE PARA ACTUALIZAR EL ESTADO DE LA ETAPA
        try {
            DB::table('TAB_CASO')
                ->where('NUM_SOLICITUD',$numSolicitud)
                ->update([ $pasoCambio =>  1 ]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al insertar los datos por favor verifique estos datos. [TAB_CASO] <br>'.$e;
        }

        //FINALIZA REGISTRO CORRECTO DE USUARIO
        DB::commit();
        return '|1|ATENCIÓN...!. La información ha sido actualizada correctamente.';
    }
    //REGISTRAR ORGANIZACIONES
    public function registroOrganizacion(Request $request){
        $numSolicitud=$request->input("numSolicitud");
        $rolCiudadano=$request->input("rolCiudadano");
        if($rolCiudadano=='CONVOCANTE'){$etapa='2'; $pasoCambio='PASO2';}else{$etapa='3'; $pasoCambio='PASO3';}
        $tipo=$request->input("tipo");
        $tipoOrganizacion=$request->input("tipoOrganizacion");
        $tipoEntidad=$request->input("tipoEntidad");
        if(!isset( $tipoEntidad )){
            $tipoEntidad='000';
        }else{
            $tipoEntidad=$request->input("tipoEntidad");
        }

        $tipoIdentificacion=$request->input("tipoIdentificacion");
        $numeroDocuemnto=$request->input("numeroDocuemnto");
        $nombreOrganizacion=$request->input("nombreOrganizacion");
        $tipoSectorEconomico=$request->input("tipoSectorEconomico");
        $tipoDepartamento=$request->input("tipoDepartamento");
        $tipoCiudad=$request->input("tipoCiudad");
        $direccion=$request->input("direccion");
        $telefono=$request->input("telefono");


        $contador = DB::table('TAB_ORGANIZACION')->where('SICIDENTIFICACION',$numeroDocuemnto)->count();
        if($contador==0){
            //ENTRA SECCION INSERT
            //EXTRAER SICIDORGANIZACION
            try {
                $user =DB::table('TAB_ORGANIZACION')->orderBy('SICIDORGANIZACION', 'desc')->first();
                $sicIdOrganizacion=$user->sicidorganizacion+1;
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al extrael el numero asignado por el sistema'.$e;
            }

            try {
                DB::table('TAB_ORGANIZACION')->insert([
                    [
                        'SICIDORGANIZACION' =>  $sicIdOrganizacion, 'SICTIPOORGANIZACION' =>\DB::raw("'$tipoOrganizacion'"), 'SICTIPODOCUMENTOIDENTIDAD' => $tipoIdentificacion,
                        'SICIDENTIFICACION' => $numeroDocuemnto, 'SICTIPOENTIDADPUBLICA' => $tipoEntidad, 'SICIDNACIONALIDAD' =>170,'SICIDPAIS' =>170,
                        'SICNOMBRE'=>\DB::raw("'$nombreOrganizacion'"), 'SICIDSECTORECONOMICO'=>$tipoSectorEconomico, 'SICIDCIUDAD' => $tipoCiudad,
                        'SICDIRECCION' => \DB::raw("'$direccion'"), 'SICTELEFONO' => \DB::raw("'$telefono'"), 'SICCELULAR'=> \DB::raw("'$telefono'")
                    ]
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos referentes al conflicto por favor verifique estos datos. [TAB_CASO] <br>'.$e;
            }
        }else{
            //ENTRA SECCION UPDATE
            //EXTRAER SICIDORGANIZACION
            try {
                $user =DB::table('TAB_ORGANIZACION')->where('SICIDENTIFICACION', $numeroDocuemnto)->first();
                $sicIdOrganizacion=$user->sicidorganizacion;
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al extrael el numero asignado por el sistema'.$e;
            }

            try {
                DB::table('TAB_ORGANIZACION')
                    ->where('SICIDENTIFICACION',$numeroDocuemnto)
                    ->update([
                        'SICIDORGANIZACION' =>  $sicIdOrganizacion, 'SICTIPOORGANIZACION' =>$tipoOrganizacion, 'SICTIPODOCUMENTOIDENTIDAD' => $tipoIdentificacion,
                        'SICIDENTIFICACION' => $numeroDocuemnto, 'SICTIPOENTIDADPUBLICA' => $tipoEntidad, 'SICIDNACIONALIDAD' =>170,
                        'SICNOMBRE'=>\DB::raw("'$nombreOrganizacion'"), 'SICIDSECTORECONOMICO'=>$tipoSectorEconomico, 'SICIDCIUDAD' => $tipoCiudad,
                        'SICDIRECCION' => \DB::raw("'$direccion'"), 'SICTELEFONO' => \DB::raw("'$telefono'"), 'SICCELULAR'=> \DB::raw("'$telefono'")
                    ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos por favor verifique estos datos. [TAB_PERSONA]  <br>'.$e;
            }
        }

        try {
            $user =DB::table('TAB_ORGANIZACION')->where('SICIDENTIFICACION', $numeroDocuemnto)->first();
            $sicIdOrganizacion=$user->sicidorganizacion;
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al extrael el numero asignado por el sistema'.$e;
        }
        try {
            $user =DB::table('TAB_INVOLUCRADOCASOORGANIZACIO')->orderBy('SICIDINVOLUCRADOCASOORGANIZACI', 'desc')->first();
            $idInvolucradoOrg=$user->sicidinvolucradocasoorganizaci+1;
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al extrael el numero asignado por el sistema'.$e;
        }

        try {
            DB::table('TAB_INVOLUCRADOCASOORGANIZACIO')->insert([
                [
                    'SICIDINVOLUCRADOCASOORGANIZACI' =>  $idInvolucradoOrg, 'SICIDINVOLUCRADOCASO' =>$numeroDocuemnto, 'SICIDORGANIZACION' => $sicIdOrganizacion,
                    'SICDIRECCION' => \DB::raw("'$direccion'"), 'SICTELEFONO' => \DB::raw("'$telefono'"), 'SICCORREO' =>\DB::raw("null"),
                    'SICPAGINAWEB'=>\DB::raw("null"), 'NUM_SOLICITUD'=>$numSolicitud, 'SICIDTIPOINVOLUCRADOCASO' =>\DB::raw("'$rolCiudadano'")
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al insertar los datos referentes al conflicto por favor verifique estos datos. [TAB_CASO] <br>'.$e;
        }

        //UPDATE PARA ACTUALIZAR EL ESTADO DE LA ETAPA
        try {
            DB::table('TAB_CASO')
                ->where('NUM_SOLICITUD',$numSolicitud)
                ->update([ $pasoCambio =>  1 ]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al insertar los datos por favor verifique estos datos. [TAB_CASO] <br>'.$e;
        }

        //FINALIZA REGISTRO CORRECTO DE LA ORGANZIACION
        DB::commit();
        return '|1|ATENCIÓN...!. La información ha sido actualizada correctamente.';
    }
    //REGISTRAR COMO QUEDO CERRADO EL CASO
    public function modalCierreCaso(Request $request){
        $numSinproc=$request->input("sinproc");

        $detalleCierre = DB::table('TAB_RESULTADOCONCILIACION as TR')
            ->select( "TR.SICIDRESULTADOCONCILIACION as RESULPADRE","TTR.SICNOMBRETIPORESULTADOCONCILIA as NOMRES",
                "TD.SICNOMBREDOCUMENTO as NOMDOC", DB::raw("TO_CHAR(TR.SICFECHAREGISTRORESULTADOC, 'DD/MM/YY HH24:MI') as FECRESUL")
            )
            ->join("TAB_TIPORESULTADOCONCILIACION as TTR","TTR.SICIDTIPORESULTADOCONCILIACION","TR.SICIDTIPORESULTADOCONCILIACION")
            ->join("TAB_DOCUMENTO as TD","TD.SICIDENTIFICADORDOCUMENTO","TR.NUM_SOLICITUD")
            ->where("TR.NUM_SOLICITUD",$numSinproc)
            ->first();

        if($detalleCierre!=null){
            $resultadoPadre=$detalleCierre->resulpadre;
            $nombreDoc=$detalleCierre->nomdoc;
            $nombreResultado=$detalleCierre->nomres;
            $fechaCargue=$detalleCierre->fecresul;

            switch ($resultadoPadre) {
                case 1:	@$resultadoPadre="ACTA";	break;
                case 2:	@$resultadoPadre="CONSTANCIA";	break;
                case 6:	@$resultadoPadre="INASISTENCIA";	break;
                case 3:	@$resultadoPadre="OTROS";	break;
            }
        }else{
            $resultadoPadre=0;
            $nombreDoc=0;
            $nombreResultado=0;
            $fechaCargue=0;

            switch ($resultadoPadre) {
                case 1:	@$resultadoPadre="ACTA";	break;
                case 2:	@$resultadoPadre="CONSTANCIA";	break;
                case 6:	@$resultadoPadre="INASISTENCIA";	break;
                case 3:	@$resultadoPadre="OTROS";	break;
                case 0:	@$resultadoPadre="SIN REGISTRAR";	break;
            }
        }
            $data=array(
                "detalleCierre"=>$detalleCierre,
                "resultadoPadre"=>$resultadoPadre,
                "nombreDoc"=>$nombreDoc,
                "nombreResultado"=>$nombreResultado,
                "fechaCargue"=>$fechaCargue,
                "numSolicitud"=>$numSinproc
            );

        return((String)\View::make("conciliaciones.modal.infoCierre", array("data" => $data)));
    }
    //EXTRAER LISTA DE SUB-CIERRES SEGUN EL TIPO DE CIERRE
    public function consultalistaResultado(Request $request){
        $idResultadoPadre=$request->input("idResultadoPadre");

        $cierres = DB::table('TAB_TIPORESULTADOCONCILIACION')
            ->select('SICIDTIPORESULTADOCONCILIACION','SICNOMBRETIPORESULTADOCONCILIA')
            ->where('SICPADREID',$idResultadoPadre)
            ->orderBy('SICIDTIPORESULTADOCONCILIACION')
            ->get();
        return $cierres;
    }
    //REGSTR DEL CIERRERE DE LA CONCILIACION
    public function registroCierreCon(Request $request){

        $numSolicitud=$request->input("numSolicitud");
        $tipoResultadoPadre=$request->input("tipoResultadoPadre");
        $tipoResultadoHijo=$request->input("tipoResultadoHijo");
        $fehcaDocumento=$request->input("fehcaDocumento");
        $carbonDate = Carbon::now();
        $fechaRegistro=date_format($carbonDate, 'd/m/Y h:m:s');

        /*****************************************************************************/
        $document1=$request->file("document1");
        $nombreOriginalFile=$request->file("document1")->getClientOriginalName();
        $rutaFinalFile=Storage::disk('sftp')->put('',$document1);

        $data = DB::table('TAB_CASO')->where('NUM_SOLICITUD',$numSolicitud)->first();
        $sicIdCaso=$data->sicnumeroregistroconciliacion;

        $contador = DB::table('TAB_RESULTADOCONCILIACION')
            ->where('NUM_SOLICITUD',$numSolicitud)
            ->count();

        if($contador==0) {

            //CAPTURAR EL COSNECUTIVO DEL DOCUMENTO
            try {
                $user =DB::table('TAB_DOCUMENTO')->orderBy('SICIDDOCUMENTO', 'desc')->first();
                $sicIdDocumento=$user->siciddocumento+1;
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al extrael el numero asignado por el sistema CCCCCC'.$e;
            }


            //INSERT INFROMAIO NDEL COSUMENTO
            try {
                DB::table('TAB_DOCUMENTORESULTADOCONCIL')->insert([
                    [
                        'SICIDDOCUMENTO' =>  $sicIdDocumento,
                        'SICIDRESULTADOCONCILIACION' => $sicIdDocumento,
                        'SICIDDOCUMENTORESULTADOCONC' => $tipoResultadoHijo,
                        'ETAPA' => 8,
                        'IDUSUARIO' => Session::get('ccFuncionario'),
                        'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                    ]
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos referentes al conflicto por favor verifique estos datos. [TAB_DOCUMENTORESULTADOCONCIL] <br>'.$e;
            }
            //INSERT
            try {
                DB::table('TAB_RESULTADOCONCILIACION')->insert([
                    [
                        'SICIDRESULTADOCONCILIACION' =>  $tipoResultadoPadre,
                        'SICIDTIPORESULTADOCONCILIACION' => $tipoResultadoHijo,
                        'SICIDCASO' => \DB::raw("'$sicIdCaso'"),
                        'NUM_SOLICITUD' => $numSolicitud,
                        'SICFECHAREGISTRORESULTADOC' => \DB::raw("TO_DATE('".$fehcaDocumento."','DD/MM/YYYY HH24:MI:SS')"),
                        'IDUSUARIO' => Session::get('ccFuncionario'),
                        'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')"),
                        'ETAPA' => 8,
                    ]
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos referentes al conflicto por favor verifique estos datos. [TAB_RESULTADOCONCILIACION] <br>'.$e;
            }

            //INSERT INFORMACION DEL DOCUMENTO
            try {
                DB::table('TAB_DOCUMENTO')->insert([
                    [
                        'SICRUTADOCUMENTO' =>  \DB::raw("'$rutaFinalFile'"),
                        'SICNOMBREDOCUMENTO' => \DB::raw("'$nombreOriginalFile'"),
                        'SICIDENTIFICADORDOCUMENTO' => $numSolicitud,
                        'SICIDDOCUMENTO'=>$sicIdDocumento,
                        'SICFECHADOCUMENTO' => \DB::raw("TO_DATE('".$fehcaDocumento."','DD/MM/YYYY HH24:MI:SS')"),
                        'IDUSUARIO' => Session::get('ccFuncionario'),
                        'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                    ]
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos referentes al conflicto por favor verifique estos datos. [TAB_DOCUMENTO] <br>'.$e;
            }

            //ACTUALIZAR EL REGISTRO EN TAB_CASO
            try {
                DB::table('TAB_CASO')
                    ->where('NUM_SOLICITUD', $numSolicitud)
                    ->update(['PASO8' => 1]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al actualizar el estodo del registro  [TAB_CASO] <br>'.$e;
            }


            DB::commit();
            return '|1|ATENCIÓN...!. La información ha sido actualizada correctamente.';

        }else{
            //UPDATE

            //CAPTURAR EL COSNECUTIVO DEL DOCUMENTO
            try {
                $user =DB::table('TAB_DOCUMENTO')->where('SICIDENTIFICADORDOCUMENTO', $numSolicitud)->first();
                $sicIdDocumento=$user->siciddocumento;
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al extrael el numero asignado por el sistema '.$e;
            }

            //UPDATE INFROACIO NDE TIPO DE CIERRE QUE SE LE DIO
            try {
                DB::table('TAB_RESULTADOCONCILIACION')
                    ->where('NUM_SOLICITUD', $numSolicitud)
                    ->update([
                        'SICIDRESULTADOCONCILIACION' =>  $tipoResultadoPadre,
                        'SICIDTIPORESULTADOCONCILIACION' => $tipoResultadoHijo,
                        'SICIDCASO' => \DB::raw("'$sicIdCaso'"),
                        'SICFECHAREGISTRORESULTADOC' => \DB::raw("TO_DATE('".$fehcaDocumento."','DD/MM/YYYY HH24:MI:SS')"),
                        'IDUSUARIO' => Session::get('ccFuncionario'),
                        'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')"),
                        'ETAPA' => 8
                    ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al actualziar los datos referentes al conflicto por favor verifique estos datos. [TAB_RESULTADOCONCILIACION] <br>'.$e;
            }
            //UPDATE INFROMAIO NDEL COSUMENTO
            try {
                DB::table('TAB_DOCUMENTO')
                    ->where('SICIDENTIFICADORDOCUMENTO', $numSolicitud)
                    ->update([
                        'SICRUTADOCUMENTO' =>  \DB::raw("'$rutaFinalFile'"),
                        'SICNOMBREDOCUMENTO' => \DB::raw("'$nombreOriginalFile'"),
                        'SICFECHADOCUMENTO' => \DB::raw("TO_DATE('".$fehcaDocumento."','DD/MM/YYYY HH24:MI:SS')"),
                        'IDUSUARIO' => Session::get('ccFuncionario'),
                        'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                    ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al actualziar los datos referentes al conflicto por favor verifique estos datos. [TAB_DOCUMENTO] <br>'.$e;
            }

            //INSERT INFROMAIO NDEL COSUMENTO
            try {
                DB::table('TAB_DOCUMENTORESULTADOCONCIL')
                    ->where('SICIDDOCUMENTO', $sicIdDocumento)
                    ->update([
                        'SICIDRESULTADOCONCILIACION' => $sicIdDocumento,
                        'SICIDDOCUMENTORESULTADOCONC' => $tipoResultadoHijo,
                        'ETAPA' => 8,
                        'IDUSUARIO' => Session::get('ccFuncionario'),
                        'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                    ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al actualziar los datos referentes al conflicto por favor verifique estos datos. [TAB_DOCUMENTORESULTADOCONCIL] <br>'.$e;
            }

            DB::commit();
            return '|1|ATENCIÓN...!. La información ha sido actualizada correctamente.';

        }
    }
    //REGISTRO DEL CIERRERE DE LA CONCILIACION
    public function actualesUsuario(Request $request){
        $numSinproc=$request->input("sinproc");
        $rol=$request->input("rol");


        $registrosCiudadano = DB::table('TAB_INVOLUCRADOCASO as TI')
            ->select('TP.SICPRIMERNOMBRE','TP.SICSEGUNDONOMBRE','TP.SICPRIMERAPELLIDO','TP.SICSEGUNDOAPELLIDO','TP.SICDIRECCION',
                'TTD.SICTIPODOCUMENTOIDENTIDAD','TI.ESTADO','TP.SICIDENTIFICACION','TTD.SICSIGLA')
            ->join("TAB_PERSONA as TP","TP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TI.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TTD","TTD.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
            ->where('TI.NUM_SOLICITUD',$numSinproc)
            ->where('TI.SICTIPOINVOLUCRADOCASO',\DB::raw("'$rol'"))
            ->where('TI.ESTADO', 1)
            ->get();

        $registroOrganizaciones = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO as TI')
            ->select('TOR.SICNOMBRE','TOR.SICIDENTIFICACION','TOR.SICDIRECCION','TOR.SICDIRECCION','TI.ESTADO')
            ->join('TAB_ORGANIZACION as TOR','TOR.SICIDENTIFICACION',\DB::raw('TO_CHAR(TI.SICIDINVOLUCRADOCASO)'))
            ->where('TI.NUM_SOLICITUD',$numSinproc)
            ->where('TI.SICIDTIPOINVOLUCRADOCASO',\DB::raw("'$rol'"))
            ->where('TI.ESTADO', 1)
            ->get();


        //dd($registroOrganizaciones);

        $data=array(
            "registrosCiudadano"=>$registrosCiudadano,
            "registroOrganizaciones"=>$registroOrganizaciones,
            "numSolicitud"=>$numSinproc,
            "rol"=>$rol
        );

        return((String)\View::make("conciliaciones.modal.infoInvolucrados", array("data" => $data)));
    }
    //MODULO PARA LA EDICION DE DATOS DEL USUARIO
    public function moduloEdicionDatosUsr(Request $request){
        $numSinproc=$request->input("sinproc");
        $identificacion=$request->input("identificacion");
        $rol=$request->input("rol");

        $datosCiudadano = DB::table('TAB_PERSONA as TP')
            ->select('TP.SICPRIMERNOMBRE','TP.SICSEGUNDONOMBRE','TP.SICPRIMERAPELLIDO','TP.SICSEGUNDOAPELLIDO','TP.SICDIRECCION','TP.SICTELEFONO',
                'TTD.SICTIPODOCUMENTOIDENTIDAD','TP.SICIDENTIFICACION','TTD.SICSIGLA','TP.SICCIUDADEXPEDICION','TP.SICFECHANACIMIENTO','TP.SICIDCIUDAD')
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TTD","TTD.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
            ->where('TP.SICIDENTIFICACION',$identificacion)
            ->get();

        $datosUsuarios = DB::table('TAB_CIUDAD as TC')
            ->select('TC.SICCIUDAD','TC.SICIDCIUDAD','TD.SICDEPARTAMENTO','TC.SICIDDEPARTAMENTO','TTD.SICTIPODOCUMENTOIDENTIDAD')
            ->join("TAB_DEPARTAMENTO as TD","TD.SICIDDEPARTAMENTO","TC.SICIDDEPARTAMENTO")
            ->join("TAB_PERSONA as TP","TP.SICIDCIUDAD","TC.SICIDCIUDAD")
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TTD","TTD.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
            ->where('TP.SICIDENTIFICACION',$identificacion)
            ->first();

        $idCiudadadActual=$datosUsuarios->sicidciudad;
        $tipoDocCiudadano=$datosUsuarios->sictipodocumentoidentidad;
        $nombreCiudadadActual=$datosUsuarios->sicciudad;
        $idDepartamente=$datosUsuarios->siciddepartamento;
        $nombreDepartamento=$datosUsuarios->sicdepartamento;

        $listaDepartamento = DB::table('TAB_DEPARTAMENTO')
            ->select('SICIDDEPARTAMENTO','SICDEPARTAMENTO')
            ->where('SICIDPAIS',170)
            ->orderBy('SICDEPARTAMENTO')
            ->get();

        $data=array(
            "numSinproc"=>$numSinproc,
            "identificacion"=>$identificacion,
            "rol"=>$rol,
            "tipoDocCiudadano"=>$tipoDocCiudadano,
            "listaDepartamento"=>$listaDepartamento,
            "idCiudadadActual"=>$idCiudadadActual,
            "nombreCiudadadActual"=>$nombreCiudadadActual,
            "idDepartamente"=>$idDepartamente,
            "nombreDepartamento"=>$nombreDepartamento,
            "datosCiudadano"=>$datosCiudadano

        );

        return((String)\View::make("conciliaciones.modal.moduloEdicionDatosUsr", array("data" => $data)));

    }
    // MODULO PARA A EDICION DE DATOS DEL USUARIO ORGANZUIACION
    public function moduloEdicionDatosUsrOrg (Request $request){
        $numSinproc=$request->input("sinproc");
        $identificacion=$request->input("identificacion");
        $rol=$request->input("rol");

        $datosUsuarios = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO as TI')
            ->select('TI.SICDIRECCION','TI.SICTELEFONO','TOR.SICNOMBRE')
            ->join('TAB_ORGANIZACION as TOR','TOR.SICIDENTIFICACION',\DB::raw('TO_CHAR(TI.SICIDINVOLUCRADOCASO)'))
            ->where('TI.SICIDINVOLUCRADOCASO',$identificacion)
            ->where('TI.NUM_SOLICITUD',$numSinproc)
            ->where('TI.SICIDTIPOINVOLUCRADOCASO',\DB::raw("'$rol'"))
            ->first();

        $direccion=$datosUsuarios->sicdireccion;
        $telefono=$datosUsuarios->sictelefono;
        $nombreOrg=$datosUsuarios->sicnombre;

        $data=array(
            "numSinproc"=>$numSinproc,
            "identificacion"=>$identificacion,
            "rol"=>$rol,
            "direccion"=>$direccion,
            "telefono"=>$telefono,
            "nombreOrg"=>$nombreOrg
        );

        return((String)\View::make("conciliaciones.modal.moduloEdicionDatosUsrOrg", array("data" => $data)));
    }
    //FUNCION PARA ACTUALIZAR DATOS DE USUARIO
    public function edicionDatosCiudadano(Request $request){

        $rol=$request->input("rol");
        $numSolicitud=$request->input("numSolicitud");
        $primerNombre=strtoupper($request->input("primerNombre"));
        $segundoNombre=strtoupper($request->input("segundoNombre"));
        $primerApellido=strtoupper($request->input("primerApellido"));
        $segundoApellido=strtoupper($request->input("segundoApellido"));
        $numeroDocuemnto=$request->input("numeroDocuemnto");
        $ciudadExpedicion=strtoupper($request->input("ciudadExpedicion"));
        $tipoDepartamento=$request->input("tipoDepartamento");
        $direccion=strtoupper($request->input("direccion"));
        $telefono=$request->input("telefono");
        $tipoCiudad=$request->input("tipoCiudad");
        $carbonDate = Carbon::now();
        $fechaRegistro=date_format($carbonDate, 'd/m/Y h:m:s');

        try {
            DB::table('TAB_PERSONA')
                ->where('SICIDENTIFICACION',$numeroDocuemnto)
                ->update([
                    'SICCIUDADEXPEDICION' => \DB::raw("'$ciudadExpedicion'"),
                    'SICPRIMERNOMBRE' => \DB::raw("'$primerNombre'"), 'SICSEGUNDONOMBRE' => \DB::raw("'$segundoNombre'"),
                    'SICPRIMERAPELLIDO' => \DB::raw("'$primerApellido'"), 'SICSEGUNDOAPELLIDO' => \DB::raw("'$segundoApellido'"), 'SICIDNACIONALIDAD' => 170,
                    'SICIDCIUDAD' => $tipoCiudad, 'SICDIRECCION' => \DB::raw("'$direccion'"), 'SICTELEFONO' => \DB::raw("'$telefono'"),
                    'IDUSUARIO' =>  Session::get('ccFuncionario'), 'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                ]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al insertar los datos por favor verifique estos datos. [TAB_PERSONA]  <br>'.$e;
        }

        DB::commit();
        return '|1|ATENCIÓN...!. La información ha sido actualizada correctamente.';

    }
    // FUNCION PARA ACTUALIZAR DATOS DE USUARIO ORGANIZACION
    public function edicionDatosCiudadanoOrg(Request $request){
        $rol=$request->input("rol");
        $numSolicitud=$request->input("numSolicitud");
        $nombreOrg=$request->input("nombreOrg");
        $direccion=$request->input("direccion");
        $telefono=$request->input("telefono");
        $identificacion=$request->input("identificacion");


        try {
            DB::table('TAB_INVOLUCRADOCASOORGANIZACIO')
                ->where('NUM_SOLICITUD',$numSolicitud)
                ->where('SICIDTIPOINVOLUCRADOCASO',\DB::raw("'$rol'"))
                ->update([
                    'SICDIRECCION' => \DB::raw("'$direccion'"),
                    'SICTELEFONO' => $telefono
                ]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al insertar los datos por favor verifique estos datos. [TAB_PERSONA]  <br>'.$e;
        }
        try {
            DB::table('TAB_ORGANIZACION')
                ->where('SICIDENTIFICACION',$identificacion)
                ->update([
                    'SICNOMBRE' => \DB::raw("'$nombreOrg'"),
                    'SICDIRECCION' => \DB::raw("'$direccion'"),
                    'SICTELEFONO' => $telefono
                ]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0|Problema al insertar los datos por favor verifique estos datos. [TAB_PERSONA]  <br>'.$e;
        }

        DB::commit();
        return '|1|ATENCIÓN...!. La información ha sido actualizada correctamente.';

    }
    /***********FUNCTION PARA DESACTIVAR USUARIO DEL CASO***************/
    public function moduloDesactivarUsr(Request $request){
        $numSinproc=$request->input("sinproc");
        $identificacion=$request->input("identificacion");
        $rol=$request->input("rol");
        $tipo=$request->input("tipo");
        $carbonDate = Carbon::now();
        $fechaRegistro=date_format($carbonDate, 'd/m/Y h:m:s');

        if($tipo=='USR'){
            try {
                DB::table('TAB_INVOLUCRADOCASO')
                    ->where('SICTIPOINVOLUCRADOCASO',\DB::raw("'$rol'"))
                    ->where('NUM_SOLICITUD',$numSinproc)
                    ->where('SICIDINVOLUCRADOCASO',$identificacion)
                    ->update(['ESTADO' => 0,'IDUSUARIO' =>  Session::get('ccFuncionario'), 'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos por favor verifique estos datos. [TAB_PERSONA]  <br>'.$e;
            }
        }elseif ($tipo=='ORG'){
            try {
                DB::table('TAB_INVOLUCRADOCASOORGANIZACIO')
                    ->where('SICIDTIPOINVOLUCRADOCASO',\DB::raw("'$rol'"))
                    ->where('NUM_SOLICITUD',$numSinproc)
                    ->where('SICIDINVOLUCRADOCASO',$identificacion)
                    ->update(['ESTADO' => 0,'IDUSUARIO' =>  Session::get('ccFuncionario'), 'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos por favor verifique estos datos. [TAB_PERSONA]  <br>'.$e;
            }
        }

        DB::commit();
        return '|1|ATENCIÓN...!. La información ha sido actualizada correctamente.';
    }
    /************FUNCIONA PARA MUESTRA DE MODAL PARA REGISTRO DE APODERADO***********/
    public function seccionApodeardoRepLegal(Request $request){
        $numSinproc=$request->input("sinproc");
        $rol=$request->input("rol");
        $tipo=$request->input("tipo");

        if($tipo=='APODERADO'){
            /************** SECCION APODERADO *****************/
            /*CONTADOR DATOS DE LA SESSION*/
            $contador = DB::table('TAB_APODERADO_INVOLUCRADO')
                ->where('SICTIPOINVOLUCRADOCASO',\DB::raw("'$rol'"))
                ->where('NUM_SOLICITUD',$numSinproc)
                ->count();
            $listaTiposDoc = DB::table('TAB_TIPODOCUMENTOIDENTIDAD')->get();

            if($contador!=0){
                //TRAER SICIDPERSONA SICIDPERSONA -- ESTA EN TAB_APODERADO_INVOLUCRADO
                $datosApoderado = DB::table('TAB_PERSONA as TP')
                    ->select("TAI.SICIDPERSONA","TP.SICIDTIPODOCUMENTO","TTI.SICTIPODOCUMENTOIDENTIDAD","TP.SICPRIMERNOMBRE","TP.SICSEGUNDONOMBRE","TP.SICPRIMERAPELLIDO",
                        "TP.SICSEGUNDOAPELLIDO","TP.SICDIRECCION","TP.SICTELEFONO","TP.SICIDENTIFICACION","TP.SICPAGINAWEB")
                    ->join("TAB_APODERADO_INVOLUCRADO as TAI",\DB::raw("TO_CHAR(TAI.SICIDAPODERADOINVOLUCRADO)") ,"TP.SICIDENTIFICACION")
                    ->join("TAB_TIPODOCUMENTOIDENTIDAD TTI","TTI.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
                    ->where("TAI.SICTIPOINVOLUCRADOCASO",\DB::raw("'$rol'"))
                    ->where("TAI.NUM_SOLICITUD",$numSinproc)
                    ->get();
            }else{
                $datosApoderado=null;
            }
        }else{
            /************** SECCION REPRESENTATE LEGAL *****************/
            /*CONTADOR DATOS DE LA SESSION*/
            $contador = DB::table('TAB_REPRESENTANTELEGALINVOLUC')
                ->where('SICTIPOINVOLUCRADOCASO',\DB::raw("'$rol'"))
                ->where('NUM_SOLICITUD',$numSinproc)
                ->count();
            $listaTiposDoc = DB::table('TAB_TIPODOCUMENTOIDENTIDAD')->get();

            if($contador!=0){
                //TRAER SICIDPERSONA SICIDPERSONA -- ESTA EN TAB_APODERADO_INVOLUCRADO
                $datosApoderado = DB::table('TAB_PERSONA as TP')
                    ->select("TAI.SICIDPERSONA","TP.SICIDTIPODOCUMENTO","TTI.SICTIPODOCUMENTOIDENTIDAD","TP.SICPRIMERNOMBRE","TP.SICSEGUNDONOMBRE","TP.SICPRIMERAPELLIDO",
                        "TP.SICSEGUNDOAPELLIDO","TP.SICDIRECCION","TP.SICTELEFONO","TP.SICIDENTIFICACION","TP.SICPAGINAWEB")
                    ->join("TAB_REPRESENTANTELEGALINVOLUC as TAI",\DB::raw("TO_CHAR(TAI.SICIDREPRESENTANTELEGAL)") ,"TP.SICIDENTIFICACION")
                    ->join("TAB_TIPODOCUMENTOIDENTIDAD TTI","TTI.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
                    ->where("TAI.SICTIPOINVOLUCRADOCASO",\DB::raw("'$rol'"))
                    ->where("TAI.NUM_SOLICITUD",$numSinproc)
                    ->get();
            }else{
                $datosApoderado=null;
            }
        }

        $data=array(
            "datosApoderado"=>$datosApoderado,
            "listaTiposDoc"=>$listaTiposDoc,
            "numSolicitud"=>$numSinproc,
            "rol"=>$rol,
            "tipo"=>$tipo
        );

        return((String)\View::make("conciliaciones.modal.informacionApoderadoRepLegal", array("data" => $data)));

    }
    /***********REGISTRAR O EDITAR APODERADO O REPRESENTATE LEGAL DE UN CASO*********/
    public function registroApoderadoRepLEgal(Request $request){
        $numSinproc=$request->input("numSolicitud");
        $rol=$request->input("rol");
        $tipo=$request->input("tipo");
        $carbonDate = Carbon::now();
        $fechaRegistro=date_format($carbonDate, 'd/m/Y h:m:s');

        $tipoDocumento=$request->input("tipoDocumento");
        $numeroDocuemnto=$request->input("numeroDocuemnto");
        $ciudadExpedicion=$request->input("ciudadExpedicion");
        $tipoPersona=$request->input("tipoPersona");
        $primerNombre=$request->input("primerNombre");
        $segundoNombre=$request->input("segundoNombre");
        $primerApellido=$request->input("primerApellido");
        $segundoApellido=$request->input("segundoApellido");
        $direccion=$request->input("direccion");
        $telefono=$request->input("telefono");
        $email=$request->input("email");
        $webPage=$request->input("webPage");

        /****  1) REGISTRAR O ACTUALZIAR A LA PERSONA EN TAP_PERSONA **************/
        $contadorUsuario = DB::table('TAB_PERSONA')->where('SICIDENTIFICACION',$numeroDocuemnto)->count();


        if($contadorUsuario==0){
            /********* SECCIO PARA INSERT DE UNA NUEVA PERSONA ***************/
            //EXTRAER SICIDPERSONA
            try {
                $user =DB::table('TAB_PERSONA')->orderBy('SICIDPERSONA', 'desc')->first();
                $sicIdPersona=$user->sicidpersona+1;
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al extrael el numero asignado por el sistema'.$e;
            }
            try {
                DB::table('TAB_PERSONA')->insert([
                    [
                        'SICIDPERSONA' =>  $sicIdPersona, 'SICIDTIPODOCUMENTO' => $tipoDocumento,
                        'SICPRIMERNOMBRE' => \DB::raw("'$primerNombre'") , 'SICSEGUNDONOMBRE' =>\DB::raw("'$segundoNombre'") ,
                        'SICPRIMERAPELLIDO' =>  \DB::raw("'$primerApellido'") , 'SICSEGUNDOAPELLIDO' =>  \DB::raw("'$segundoApellido'") ,
                        'SICIDNACIONALIDAD' =>  170, 'SICDIRECCION' =>\DB::raw("'$direccion'"),
                        'SICTELEFONO' => $telefono, 'SICCORREO' => \DB::raw("'$email'"), 'SICPAGINAWEB' => \DB::raw("'$webPage'"),
                        'SICIDENTIFICACION' => $numeroDocuemnto, 'SICIDPAIS' => 170, 'SICIDCIUDAD' => 11001,
                        'SICCIUDADEXPEDICION' => \DB::raw("'$ciudadExpedicion'"), 'IDUSUARIO' => Session::get('ccFuncionario'),
                        'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                    ]
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al insertar los datos referentes al conflicto por favor verifique estos datos. [TAB_PERSONA] <br>'.$e;
            }
        }else{
            /********* SECCION PARA UPDATE DE UNA NUEVA PERSONA ************/
            //EXTRAER SICIDPERSONA
            try {
                $user = DB::table('TAB_PERSONA')->where('SICIDENTIFICACION',$numeroDocuemnto)->first();
                $sicIdPersona=$user->sicidpersona;
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al extrael el numero asignado por el sistema';
            }

            try {
                DB::table("TAB_PERSONA")
                    ->where("SICIDENTIFICACION",$numeroDocuemnto)
                    ->update([
                        "SICIDPERSONA" =>  $sicIdPersona, "SICCIUDADEXPEDICION" => \DB::raw("'$ciudadExpedicion'"),
                        "SICNATURALEZA" => \DB::raw("'$tipoPersona'"), "SICPRIMERNOMBRE" => \DB::raw("'$primerNombre'"), "SICSEGUNDONOMBRE" => \DB::raw("'$segundoNombre'"),
                        "SICPRIMERAPELLIDO" => \DB::raw("'$primerApellido'"), "SICSEGUNDOAPELLIDO" => \DB::raw("'$segundoApellido'"), "SICIDNACIONALIDAD" => 170,
                        "SICIDPAIS" => 170,  "SICDIRECCION" => \DB::raw("'$direccion'"),
                        "SICTELEFONO" =>\DB::raw("'$telefono'") , "SICCELULAR" => \DB::raw("'$telefono'"),
                        "IDUSUARIO" =>  Session::get('ccFuncionario'), "FECHAREGISTRO" => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                    ]);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0|Problema al ACTUALZIAR los datos por favor verifique estos datos. [TAB_PERSONA]  <br>'.$e;
            }
        }

        /********************* ACTUALIZAR O REGISTRAR LOS DATOS SEGUN SEA APODERDO O REP LEGAL *********************/
        if($tipo=='APODERADO'){
            //IDFENTIFICAR SI EL SUJETO YA EXISTE O SE DEBE REGISTRAR DESDE CERO
            $contador = DB::table('TAB_APODERADO_INVOLUCRADO')->where('SICTIPOINVOLUCRADOCASO',\DB::raw("'$rol'"))->where('NUM_SOLICITUD',$numSinproc)->count();

            if($contador==0){
                /******** INSERT EN  TAB_APODERADO_INVOLUCRADO ************/
                try {
                    $userInt = DB::table('TAB_INVOLUCRADOCASO')
                        ->where('NUM_SOLICITUD',$numSinproc)
                        ->where('SICTIPOINVOLUCRADOCASO',\DB::raw("'$rol'"))
                        ->first();
                    $sicidinvolucradocaso=$userInt->sicidinvolucradocaso;
                } catch (\Exception $e) {
                    DB::rollback();
                    return '|0|Problema al identificar el id del involucrado<br> Por favor registre primero los convocantes y convocados. [TAB_INVOLUCRADOCASO] <br>';
                }

                try {
                    DB::table('TAB_APODERADO_INVOLUCRADO')->insert([
                        [
                            'SICIDAPODERADOINVOLUCRADO' =>$numeroDocuemnto,
                            'NUM_SOLICITUD' =>$numSinproc ,
                            'SICIDPERSONA' =>  $sicIdPersona,
                            'SICIDINVOLUCRADOCASO' =>  $sicidinvolucradocaso,
                            'SICTIPOINVOLUCRADOCASO' =>  \DB::raw("'$rol'") ,
                            'IDUSUARIO' => Session::get('ccFuncionario'),
                            'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                        ]
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return '|0|Problema al insertar los datos referentes al conflicto por favor verifique estos datos. [TAB_PERSONA] <br>'.$e;
                }

            }else{
                /***********INGRESA A LA SECCION DE UPDATE TANTO DE TAB_PERSONA COMO DE TAB_APODERADO_INVOLUCRADO ******************/
                try {
                    $user = DB::table('TAB_PERSONA')->where('SICIDENTIFICACION',$numeroDocuemnto)->first();
                    $sicIdPersona=$user->sicidpersona;
                } catch (\Exception $e) {
                    DB::rollback();
                    return '|0|Problema al extrael el numero asignado por el sistema';
                }
                try {
                    DB::table('TAB_PERSONA')
                        ->where('SICIDENTIFICACION',$numeroDocuemnto)
                        ->update([
                            'SICCIUDADEXPEDICION' => \DB::raw("'$ciudadExpedicion'"),
                            'SICNATURALEZA' => \DB::raw("'$tipoPersona'"), 'SICPRIMERNOMBRE' => \DB::raw("'$primerNombre'"), 'SICSEGUNDONOMBRE' => \DB::raw("'$segundoNombre'"),
                            'SICPRIMERAPELLIDO' => \DB::raw("'$primerApellido'"), 'SICSEGUNDOAPELLIDO' => \DB::raw("'$segundoApellido'"),
                            'SICDIRECCION' => \DB::raw("'$direccion'"), 'SICTELEFONO' =>\DB::raw("'$telefono'") , 'SICCELULAR' => \DB::raw("'$telefono'"),
                            'IDUSUARIO' =>  Session::get('ccFuncionario'), 'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                        ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return '|0|Problema al insertar los datos por favor verifique estos datos. [TAB_PERSONA]  <br>'.$e;
                }

            }
        }else{
            $contador = DB::table('TAB_REPRESENTANTELEGALINVOLUC')->where('SICTIPOINVOLUCRADOCASO',\DB::raw("'$rol'"))->where('NUM_SOLICITUD',$numSinproc)->count();
            if($contador==0){
                /********INGRESA A LA SECCION DE INSERT**************/
                /******** INSERT EN  TAB_REPRESENTANTELEGALINVOLUC ************/

                $userInt = DB::table('TAB_INVOLUCRADOCASO')
                    ->where('NUM_SOLICITUD',$numSinproc)
                    ->where('SICTIPOINVOLUCRADOCASO',\DB::raw("'$rol'"))
                    ->first();

                $sicidinvolucradocaso=$userInt->sicidinvolucradocaso;
                try {
                    DB::table('TAB_REPRESENTANTELEGALINVOLUC')->insert([
                        [
                            'SICIDREPRESENTANTELEGAL' =>$numeroDocuemnto,
                            'NUM_SOLICITUD' =>$numSinproc ,
                            'SICIDPERSONA' =>  $sicIdPersona,
                            'SICIDINVOLUCRADOCASO' =>  $sicidinvolucradocaso,
                            'SICTIPOINVOLUCRADOCASO' =>  \DB::raw("'$rol'") ,
                            'IDUSUARIO' => Session::get('ccFuncionario'),
                            'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                        ]
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return '|0|Problema al insertar los datos referentes al conflicto por favor verifique estos datos. [TAB_PERSONA] <br>'.$e;
                }
            }else{
                /********INGRESA A LA SECCION DE UPDATE**************/
                try {
                    $user = DB::table('TAB_PERSONA')->where('SICIDENTIFICACION',$numeroDocuemnto)->first();
                    $sicIdPersona=$user->sicidpersona;
                } catch (\Exception $e) {
                    DB::rollback();
                    return '|0|Problema al extrael el numero asignado por el sistema';
                }
                try {
                    DB::table('TAB_PERSONA')
                        ->where('SICIDENTIFICACION',$numeroDocuemnto)
                        ->update([
                            'SICCIUDADEXPEDICION' => \DB::raw("'$ciudadExpedicion'"),
                            'SICNATURALEZA' => \DB::raw("'$tipoPersona'"), 'SICPRIMERNOMBRE' => \DB::raw("'$primerNombre'"), 'SICSEGUNDONOMBRE' => \DB::raw("'$segundoNombre'"),
                            'SICPRIMERAPELLIDO' => \DB::raw("'$primerApellido'"), 'SICSEGUNDOAPELLIDO' => \DB::raw("'$segundoApellido'"),
                            'SICDIRECCION' => \DB::raw("'$direccion'"), 'SICTELEFONO' =>\DB::raw("'$telefono'") , 'SICCELULAR' => \DB::raw("'$telefono'"),
                            'IDUSUARIO' =>  Session::get('ccFuncionario'), 'FECHAREGISTRO' => \DB::raw("TO_DATE('".$fechaRegistro."','DD/MM/YYYY HH24:MI:SS')")
                        ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return '|0|Problema al insertar los datos por favor verifique estos datos. [TAB_PERSONA]  <br>'.$e;
                }

            }

        }

        DB::commit();
        return '|1|ATENCIÓN...!. La información ha sido actualizada correctamente.';

    }
    //SALIDA SEGURA DEL SISTEMA
    public function cerrar_session(){
        Session::flush();
        return redirect('/');
    }
    /*
    //PLANTILLA GENERADOR PDF
    public function generatePDF(){

        $ccUsuario=Session::get('ccUsuario');

        $datosCiudadano = DB::table('USUARIO_ROL as UR')
            ->select('UR.NOMBRE','UR.APELLIDO','UR.CONSEC','UR.CEDULA')
            ->where("UR.CEDULA",$ccUsuario)
            ->get();

        $registrosCiudadano = DB::table('TRAMITEUSUARIO as TU')
            ->select('TU.ID_TRAMITE', 'TU.NUM_SOLICITUD', 'TU.VIGENCIA', 'TU.ESTADO_TRAMITE', 'T.NOM_TRAMITE', 'TU.FEC_SOLICITUD_TRAMITE', 'TU.TEXTO08')
            ->join("TRAMITE as T","TU.ID_TRAMITE","T.ID_TRAMITE")
            ->where("ID_USUARIO_REG",$ccUsuario)
            ->orderBy('TU.FEC_SOLICITUD_TRAMITE')
            ->get();

        $data=array("datosCiudadano"=>$datosCiudadano, "registrosCiudadano"=>$registrosCiudadano);

        $pdf = PDF::loadView('moduloGestion2', $data);
        return $pdf->download('reporteDatosCiudadano.pdf');

    }
    */
    //MODAL PARA LA IMPRESION DE CONSTANCIAS
    public function modalPrintconstancias(Request $request){
        $numSinproc=$request->input("sinproc");

        /*LISTA DE LOS ACTUALES CONVOCADOS COMO PERONA NATURAL*/
        $convocadosNatural = DB::table('TAB_INVOLUCRADOCASO as TI')
            ->select( "TP.SICPRIMERNOMBRE","TP.SICSEGUNDOAPELLIDO", "TP.SICIDENTIFICACION")
            ->join("TAB_PERSONA as TP",\DB::raw("TO_CHAR(TI.SICIDINVOLUCRADOCASO)"),"TP.SICIDENTIFICACION")
            ->where("TI.NUM_SOLICITUD",\DB::raw("$numSinproc"))
            ->where("TI.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCADO'"))
            ->where("TI.ESTADO",1)
            ->get();

        /*LISTA DE LOS ACTUALES CONVOCADOS COMO ORGANIZACION*/
        $convocadosOrganizacion = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO as TI')
            ->select("TOR.SICNOMBRE","TOR.SICIDENTIFICACION")
            ->join("TAB_ORGANIZACION as TOR",\DB::raw("TO_CHAR(TI.SICIDINVOLUCRADOCASO)"),"TOR.SICIDENTIFICACION")
            ->where("TI.NUM_SOLICITUD",\DB::raw("$numSinproc"))
            ->where("TI.SICIDTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCADO'"))
            ->where("TI.ESTADO",1)
            ->get();

        /*SABER SI EXISTE EL APODERADO*/
        $apoderadoConvocante = DB::table('TAB_APODERADO_INVOLUCRADO')
            ->where("NUM_SOLICITUD",\DB::raw("$numSinproc"))
            ->where("SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->count();

        $data=array(
            "convocadosNatural"=>$convocadosNatural,
            "convocadosOrganizacion"=>$convocadosOrganizacion,
            "apoderadoConvocante"=>$apoderadoConvocante,
            "numSolicitud"=>$numSinproc
        );

        return((String)\View::make("conciliaciones.modal.impresioncitaciones", array("data" => $data)));
    }
    // IMPRESION DEL PDF CON EL ACATA DE CITACION CON APODERADO
    public function impresionActaActaEntrega($tipo,$sinproc,$identificacion){
        $carbonDate = Carbon::now();
        $fechaActual=date_format($carbonDate, 'd/m/Y h:m:s');
        // 1) DATOS BASICOS DEL CONVOCADO ( 1 PERSONA NATURAL 2 ORGANIZACION )
        if($tipo==1){
            //INGRESA COMO PERSONA NATURAL
            $datosBasicosConvocado = DB::table('TAB_PERSONA as TP')
                ->select(
                    \DB::raw("TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||'<br>'||TP.SICDIRECCION ||'<br>'|| TC.SICCIUDAD CONVOCADONOMBRE ")
                )
                ->join("TAB_CIUDAD as TC","TC.SICIDCIUDAD","TP.SICIDCIUDAD")
                ->where("TP.SICIDENTIFICACION",\DB::raw("'$identificacion'"))
                ->get();
        }else{
            //INGRESA COMO ORGANIZACION
            $datosBasicosConvocado = DB::table('TAB_ORGANIZACION as TOD')
                ->select(
                    DB::raw("TOD.SICNOMBRE||'@@'||TOD.SICDIRECCION ||'@@'|| TC.SICCIUDAD CONVOCADONOMBRE")
                )
                ->join("TAB_CIUDAD as TC","TC.SICIDCIUDAD","TOD.SICIDCIUDAD")
                ->where("TOD.SICIDENTIFICACION",\DB::raw("'$identificacion'"))
                ->get();
        }
        // 2) DATOS DEL APODERADO DEL CONVOCANTE
        $datosApoderado = DB::table('TAB_APODERADO_INVOLUCRADO as TAI')
            ->select(
                \DB::raw("'el(a) Sr(a) '||TPAP.SICPRIMERNOMBRE||' '||TPAP.SICSEGUNDONOMBRE||' '||TPAP.SICPRIMERAPELLIDO||' '||TPAP.SICSEGUNDOAPELLIDO||' identificado(a) con C.C. '||TAI.SICIDAPODERADOINVOLUCRADO  APODERADO")
            )
            ->join("TAB_PERSONA as TPAP","TPAP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TAI.SICIDAPODERADOINVOLUCRADO)") )
            ->where("TAI.NUM_SOLICITUD",$sinproc)
            ->where("TAI.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->get();

        // 3) DATOS DEL CONFLICTO
        $datosDelConflicto = DB::table('TAB_CASO as TC')
            ->select(
                \DB::raw("TC.SICNUMEROREGISTROCONCILIACION NUMREG, TO_CHAR(TC.SICFECHASOLICITUD,'DD/MM/YYYY') FECSOLICITUD,
                TC.SICDESCRIPCIONPRETENSIONES PRETENSIONES,TO_CHAR(TSA.SICFECHASESIONAUDIENCIACONCILI,'DD/MM/YYYY HH24:MI:SS') FECAUDI,
                TS.DIRECCIONSEDE||' PISO: '||TS.PISO||' MODULO '||TS.MODULO||' TORRE '||' TELEFONOS '||TS.TELEFONOSEDE||' '||TS.TELEFONOSEDE2||' '||TS.TELEFONOSEDE3||' EXT '||TS.EXT1||' '||TS.EXT2 DIREC")
            )
            ->join("TAB_SESIONAUDIENCIACONCI as TSA","TSA.SICIDCASO","TC.SICNUMEROREGISTROCONCILIACION")
            ->join("TAB_SEDES as TS","TS.IDSEDE","TC.SICIDSEDE")
            ->where("TC.NUM_SOLICITUD",$sinproc)
            ->get();


        // 4) ARRAY LISTA DE SOLICITANTES PERSONA NATURAL
       /* $arrayDatosSolicitanteNatural = DB::table('TAB_INVOLUCRADOCASO as TIC')
            ->select(
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificado(a) con # '||TP.SICIDENTIFICACION||', '  SOLICITAN")
            )
            ->join("TAB_PERSONA as TP", "TP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIC.SICIDINVOLUCRADOCASO)"))
            ->where("TIC.NUM_SOLICITUD",$sinproc)
            ->where("TIC.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->where("TIC.ESTADO",0)
            ->get();*/
        // 5) ARRAY LISTA DE SOLICITANTES ORGANIZACION
        /*$arrayDatosSolicitanteOrganizacion = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO TIO')
            ->select(
                \DB::raw("' '||TOR.SICNOMBRE ||' identificado(a) con # '||TOR.SICIDENTIFICACION SOLICITAN")
            )
            ->join("TAB_ORGANIZACION TOR", "TOR.SICIDORGANIZACION",\DB::raw("TO_CHAR(TIO.SICIDINVOLUCRADOCASOORGANIZACI)"))
            ->where("TIO.NUM_SOLICITUD",$sinproc)
            ->where("TIO.SICIDTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->where("TIO.ESTADO",0)
            ->get();*/
        // 6) ARRAY CON DATOS DE LOS CONVOCADOS (NATURAL ORGANIZACION) NOMBRES, TIPO DOCUMENTO, NUMERO DOCUMENTO , CIUDAD EXPEDICION
        $arrayDatosConvocadosNatural = DB::table('TAB_INVOLUCRADOCASO as TIC ')
            ->select(
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificad(@) con '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TP.SICIDENTIFICACION||' DE '||TP.SICCIUDADEXPEDICION||',' DATOS")
            )
            ->join("TAB_PERSONA as TP", "TP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIC.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
            ->where("TIC.NUM_SOLICITUD",$sinproc)
            ->where("TIC.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCADO'"))
            ->where("TIC.ESTADO",1)
            ->get();

        $arrayDatosConvocadosOrganizacion = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO as TIO ')
            ->select(
                \DB::raw("' '||TOR.SICNOMBRE ||' identificad(@) con la '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TOR.SICIDENTIFICACION DATOSORG")
            )
            ->join("TAB_ORGANIZACION as TOR", "TOR.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIO.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TOR.SICTIPODOCUMENTOIDENTIDAD")
            ->where("TIO.NUM_SOLICITUD",$sinproc)
            ->where("TIO.SICIDTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCADO'"))
            ->where("TIO.ESTADO",1)
            ->get();

        // 7)  CREAR ARRAY CON DATOS DE LOS CONVOCANTES (NATURAL ORGANIZACION) NOMBRES, TIPO DOCUMENTO, NUMERO DOCUMENTO , CIUDAD EXPEDICION

        $arrayDatosConvocanteNatural = DB::table('TAB_INVOLUCRADOCASO as TIC ')
            ->select(
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificado(a) con # '||TP.SICIDENTIFICACION||', '  SOLICITAN"),
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificad(@) con '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TP.SICIDENTIFICACION||' DE '||TP.SICCIUDADEXPEDICION||',' DATOS")
            )
            ->join("TAB_PERSONA as TP", "TP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIC.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
            ->where("TIC.NUM_SOLICITUD",$sinproc)
            ->where("TIC.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->where("TIC.ESTADO",1)
            ->get();

        $arrayDatosConvocanteOrganizacion = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO as TIO ')
            ->select(
                \DB::raw("' '||TOR.SICNOMBRE ||' identificado(a) con # '||TOR.SICIDENTIFICACION SOLICITAN"),
                \DB::raw("' '||TOR.SICNOMBRE ||' identificad(@) con la '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TOR.SICIDENTIFICACION DATOSORG")
            )
            ->join("TAB_ORGANIZACION as TOR", "TOR.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIO.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TOR.SICTIPODOCUMENTOIDENTIDAD")
            ->where("TIO.NUM_SOLICITUD",$sinproc)
            ->where("TIO.SICIDTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->where("TIO.ESTADO",1)
            ->get();

        switch(Session::get('idSede')){
            case 20:	$imgSede='centro.png';	break;
            case 30:	$imgSede='20julio.png';	break;
            case 40:	$imgSede='crr30.png';	break;
            case 50:	$imgSede='SCamericas.png';	break;
            case 60:	$imgSede='SCbosa.png';	break;
            case 70:	$imgSede='SCsuba.png';	break;
            case 80:	$imgSede='SUSsuba.png';	break;
            case 100:	$imgSede='CJmartirez.png';	break;
            case 110:	$imgSede='CJciudadBol.png';	break;
            case 120:	$imgSede='CJusme.png';	break;
        }

        // 8)  CONCOER EL CONCILIADOR
        $datosConciliador = DB::table('TAB_CASO as TC ')
            ->select(
                \DB::raw("' '||TOP.SICNOMBREPERSO||' '||TOP.SICAPELLIDOPERSO AS CONCILIADOR")
            )
            ->join("TAB_OPERADORCASO as TOC", "TOC.NUM_SOLICITUD","TC.NUM_SOLICITUD")
            ->join("TAB_OPERADOR as TOP", "TOP.SICIDPERSONA","TOC.SICIDOPERADORCASO")
            ->where("TC.NUM_SOLICITUD",$sinproc)
            ->get();

        $data=array(
            "datosBasicosConvocado"=>$datosBasicosConvocado,
            "datosApoderado"=>$datosApoderado,
            "datosDelConflicto"=>$datosDelConflicto,
            "arrayDatosConvocanteNatural"=>$arrayDatosConvocanteNatural,
            "arrayDatosConvocanteOrganizacion"=>$arrayDatosConvocanteOrganizacion,
            "arrayDatosConvocadosNatural"=>$arrayDatosConvocadosNatural,
            "arrayDatosConvocadosOrganizacion"=>$arrayDatosConvocadosOrganizacion,
            "datosConciliador"=>$datosConciliador,
            "fechaActual" =>$fechaActual,
            "imgSede"=>$imgSede
        );

        $pdf = PDF::loadView('conciliaciones.pdf.printActas.ActaApoderado', $data);
        return $pdf->download('reporteDatosCiudadano.pdf');

    }
    // IMPRESION DEL PDF CON EL ACATA INICIAL
    public function printActaIncial($sinproc){

        // 1) ARRAY CON DATOS DE LOS CONVOCADOS (NATURAL ORGANIZACION) NOMBRES, TIPO DOCUMENTO, NUMERO DOCUMENTO , CIUDAD EXPEDICION
        $arrayDatosConvocadosNatural = DB::table('TAB_INVOLUCRADOCASO as TIC ')
            ->select(
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificad(@) con '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TP.SICIDENTIFICACION||' DE '||TP.SICCIUDADEXPEDICION||',' DATOS")
            )
            ->join("TAB_PERSONA as TP", "TP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIC.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
            ->where("TIC.NUM_SOLICITUD",$sinproc)
            ->where("TIC.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCADO'"))
            ->where("TIC.ESTADO",1)
            ->get();

        $arrayDatosConvocadosOrganizacion = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO as TIO ')
            ->select(
                \DB::raw("' '||TOR.SICNOMBRE ||' identificad(@) con la '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TOR.SICIDENTIFICACION DATOS")
            )
            ->join("TAB_ORGANIZACION as TOR", "TOR.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIO.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TOR.SICTIPODOCUMENTOIDENTIDAD")
            ->where("TIO.NUM_SOLICITUD",$sinproc)
            ->where("TIO.SICIDTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCADO'"))
            ->where("TIO.ESTADO",1)
            ->get();

        // 2)  CREAR ARRAY CON DATOS DE LOS CONVOCANTES (NATURAL ORGANIZACION) NOMBRES, TIPO DOCUMENTO, NUMERO DOCUMENTO , CIUDAD EXPEDICION

        $arrayDatosConvocanteNatural = DB::table('TAB_INVOLUCRADOCASO as TIC ')
            ->select(
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificado(a) con # '||TP.SICIDENTIFICACION||', '  SOLICITAN"),
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificad(@) con '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TP.SICIDENTIFICACION||' DE '||TP.SICCIUDADEXPEDICION||',' DATOS")
            )
            ->join("TAB_PERSONA as TP", "TP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIC.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
            ->where("TIC.NUM_SOLICITUD",$sinproc)
            ->where("TIC.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->where("TIC.ESTADO",1)
            ->get();

        $arrayDatosConvocanteOrganizacion = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO as TIO ')
            ->select(
                \DB::raw("' '||TOR.SICNOMBRE ||' identificado(a) con # '||TOR.SICIDENTIFICACION SOLICITAN"),
                \DB::raw("' '||TOR.SICNOMBRE ||' identificad(@) con la '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TOR.SICIDENTIFICACION DATOS")
            )
            ->join("TAB_ORGANIZACION as TOR", "TOR.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIO.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TOR.SICTIPODOCUMENTOIDENTIDAD")
            ->where("TIO.NUM_SOLICITUD",$sinproc)
            ->where("TIO.SICIDTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->where("TIO.ESTADO",1)
            ->get();

        // 3) DATOS APODERADOCONOCANTE
        $datosApoderadoConvocante = DB::table('TAB_APODERADO_INVOLUCRADO as TAI')
            ->select(
                \DB::raw("'el(a) Sr(a) '||TPAP.SICPRIMERNOMBRE||' '||TPAP.SICSEGUNDONOMBRE||' '||TPAP.SICPRIMERAPELLIDO||' '||TPAP.SICSEGUNDOAPELLIDO||' identificado(a) con C.C. '||TAI.SICIDAPODERADOINVOLUCRADO  APODERADO")
            )
            ->join("TAB_PERSONA as TPAP","TPAP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TAI.SICIDAPODERADOINVOLUCRADO)") )
            ->where("TAI.NUM_SOLICITUD",$sinproc)
            ->where("TAI.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->get();
        // 4) DATOS APODERADOCONVOCADO
        $datosApoderadoConvocado = DB::table('TAB_APODERADO_INVOLUCRADO as TAI')
            ->select(
                \DB::raw("'el(a) Sr(a) '||TPAP.SICPRIMERNOMBRE||' '||TPAP.SICSEGUNDONOMBRE||' '||TPAP.SICPRIMERAPELLIDO||' '||TPAP.SICSEGUNDOAPELLIDO||' identificado(a) con C.C. '||TAI.SICIDAPODERADOINVOLUCRADO  APODERADO")
            )
            ->join("TAB_PERSONA as TPAP","TPAP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TAI.SICIDAPODERADOINVOLUCRADO)") )
            ->where("TAI.NUM_SOLICITUD",$sinproc)
            ->where("TAI.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->get();

        // 5) DATOS DE LA SOLICITUD

        $datosDeLaSolicitud = DB::table('TAB_CASO as TC ')
            ->select(
                \DB::raw("
                TC.NUM_SOLICITUD,
                TC.SICNUMEROREGISTROCONCILIACION NUMREG,
                UPPER(TC.SICDESCRIPCIONHECHOS) HECHOS,
                TC.SICDESCRIPCIONHECHOS HECHOS2,
                UPPER(TC.SICDESCRIPCIONPRETENSIONES) PRETENCIONES,TC.SICCUANTIAPRETENSIONES CUANTIA,
                TE.SICNOMBREESCALADACONFLICTOCONC TIPOCONFLICTO,
                TO_CHAR(TS.SICFECHASESIONAUDIENCIACONCILI,'DD/MM/YYYY HH24:MI') FECHASESION,
                TS.SICDETALLESSESIONAUDIENCIACONC DETALLESESION,TO_CHAR(TC.SICFECHASOLICITUD,'DD/MM/YYYY') FECSOL,
                CASE WHEN TC.SICIDAREA >=1 THEN (SELECT SICNOMBREAREA FROM TAB_AREA WHERE SICIDAREA=TC.SICIDAREA) END AREA,
                CASE WHEN TC.SICIDASUNTO >=1 THEN (SELECT SICNOMBREASUNTO FROM TAB_ASUNTO WHERE SICIDASUNTO=TC.SICIDASUNTO AND SICIDAREA=TC.SICIDAREA) END ASUNTO,
                CASE WHEN TC.SICIDCLASIFICACIONASUNTO >=1 
                  THEN (SELECT SICNOMBRECLASIFICACIONASUNTO FROM TAB_CLASIFICACIONASUNTO WHERE SICIDCLASIFICACIONASUNTO=TC.SICIDCLASIFICACIONASUNTO AND SICIDASUNTO=TC.SICIDASUNTO) 
                END SUBTEMA, TCON.SICTIEMPOCONFLICTO TIEMPO_CONFLICTO,
                SS.SICNOMBRESOLICITANTESERVICIO SOLICITANTE_SERVICIO,FS.SICNOMBRETIPOFINALIDADMINISTER FINALIDAD_CONCILIACION,
                UPPER(TOPER.SICNOMBREPERSO||' '||TOPER.SICAPELLIDOPERSO) CONCILIADORCASO"
                )
            )
            ->join("TAB_CONCILIACION as TCO", "TC.SICNUMEROREGISTROCONCILIACION","TCO.SICIDCASO")
            ->join("TAB_ESCALADACONFLICTOCONCI as TE", "TE.SICIDESCALADACONFLICTOCONCILIA","TCO.SICIDESCALADACONFLICTOCONCILIA")
            ->join("TAB_SESIONAUDIENCIACONCI as TS", "TC.SICNUMEROREGISTROCONCILIACION","TS.SICIDCASO")
            ->leftJoin('TAB_AREA as A', 'TC.SICIDASUNTO', '=', 'A.SICIDAREA')
            ->leftJoin('TAB_SOLICITANTESERVICIO as SS', 'TC.SICIDSOLICITANTESERVICIO', '=', 'SS.SICIDSOLICITANTESERVICIO')
            ->leftJoin('TAB_TIPOFINALIDADMINISTERIO as FS', 'TC.SICIDTIPOFINALIDADMINISTERIO', '=', 'FS.SICIDTIPOFINALIDADMINISTERIO')
            ->leftJoin('TAB_TIEMPOCONFLICTO as TCON ', 'TC.SICIDTIEMPOCONFLICTO', '=', 'TCON.SICIDTIEMPOCONFLICTO')
            ->leftJoin('TAB_OPERADORCASO as TOC', 'TOC.SICIDCASO', '=', 'TC.SICNUMEROREGISTROCONCILIACION')
            ->leftJoin('TAB_OPERADOR as TOPER', 'TOPER.SICIDPERSONA', '=', 'TOC.SICIDOPERADORCASO')
            ->where("TC.NUM_SOLICITUD",$sinproc)
            ->take(1)
            ->get();


        //dd($datosDeLaSolicitud);
        $data=array(
            "arrayDatosConvocadosNatural"=>$arrayDatosConvocadosNatural,
            "arrayDatosConvocadosOrganizacion"=>$arrayDatosConvocadosOrganizacion,
            "arrayDatosConvocanteNatural"=>$arrayDatosConvocanteNatural,
            "arrayDatosConvocanteOrganizacion"=>$arrayDatosConvocanteOrganizacion,
            "datosApoderadoConvocante"=>$datosApoderadoConvocante,
            "datosApoderadoConvocado" =>$datosApoderadoConvocado,
            "datosDeLaSolicitud"=>$datosDeLaSolicitud,
            "sinproc"=>$sinproc
        );

        $pdf = PDF::loadView('conciliaciones.pdf.printActas.printActaIncial', $data);
        return $pdf->download('actaInicial.pdf');

    }
    // IMPRESION DEL PDF CON EL ACATA CIERRE
    public function printActaFinal($sinproc){
        // 1) ARRAY CON DATOS DE LOS CONVOCADOS (NATURAL ORGANIZACION) NOMBRES, TIPO DOCUMENTO, NUMERO DOCUMENTO , CIUDAD EXPEDICION
        $arrayDatosConvocadosNatural = DB::table('TAB_INVOLUCRADOCASO as TIC ')
            ->select(
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificad(@) con '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TP.SICIDENTIFICACION||' DE '||TP.SICCIUDADEXPEDICION||',' DATOS")
            )
            ->join("TAB_PERSONA as TP", "TP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIC.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
            ->where("TIC.NUM_SOLICITUD",$sinproc)
            ->where("TIC.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCADO'"))
            ->where("TIC.ESTADO",1)
            ->get();

        $arrayDatosConvocadosOrganizacion = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO as TIO ')
            ->select(
                \DB::raw("' '||TOR.SICNOMBRE ||' identificad(@) con la '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TOR.SICIDENTIFICACION DATOS")
            )
            ->join("TAB_ORGANIZACION as TOR", "TOR.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIO.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TOR.SICTIPODOCUMENTOIDENTIDAD")
            ->where("TIO.NUM_SOLICITUD",$sinproc)
            ->where("TIO.SICIDTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCADO'"))
            ->where("TIO.ESTADO",1)
            ->get();

        // 2)  CREAR ARRAY CON DATOS DE LOS CONVOCANTES (NATURAL ORGANIZACION) NOMBRES, TIPO DOCUMENTO, NUMERO DOCUMENTO , CIUDAD EXPEDICION

        $arrayDatosConvocanteNatural = DB::table('TAB_INVOLUCRADOCASO as TIC ')
            ->select(
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificado(a) con # '||TP.SICIDENTIFICACION||', '  SOLICITAN"),
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificad(@) con '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TP.SICIDENTIFICACION||' DE '||TP.SICCIUDADEXPEDICION||',' DATOS")
            )
            ->join("TAB_PERSONA as TP", "TP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIC.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
            ->where("TIC.NUM_SOLICITUD",$sinproc)
            ->where("TIC.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->where("TIC.ESTADO",1)
            ->get();

        $arrayDatosConvocanteOrganizacion = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO as TIO ')
            ->select(
                \DB::raw("' '||TOR.SICNOMBRE ||' identificado(a) con # '||TOR.SICIDENTIFICACION SOLICITAN"),
                \DB::raw("' '||TOR.SICNOMBRE ||' identificad(@) con la '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TOR.SICIDENTIFICACION DATOS")
            )
            ->join("TAB_ORGANIZACION as TOR", "TOR.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIO.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TOR.SICTIPODOCUMENTOIDENTIDAD")
            ->where("TIO.NUM_SOLICITUD",$sinproc)
            ->where("TIO.SICIDTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->where("TIO.ESTADO",1)
            ->get();

        // 3) DATOS DE LA SOLICITUD
        $datosDeLaSolicitud = DB::table('TAB_CASO as TC ')
            ->select(
                \DB::raw("
                TC.SICNUMEROREGISTROCONCILIACION NUMREG, TO_CHAR(TC.SICFECHASOLICITUD,'DD/MM/YYYY HH24:MI') FECSOL,
                TC.SICCUANTIAPRETENSIONES CUANTIA,
                TO_CHAR(TS.SICFECHASESIONAUDIENCIACONCILI,'DD/MM/YYYY HH24:MI') FECHASESION,
                CASE WHEN TC.SICIDAREA >=1
                  THEN (SELECT SICNOMBREAREA FROM TAB_AREA WHERE SICIDAREA=TC.SICIDAREA)
                END AREA,
                CASE WHEN TC.SICIDASUNTO >=1 
                  THEN (SELECT SICNOMBREASUNTO FROM TAB_ASUNTO WHERE SICIDASUNTO=TC.SICIDASUNTO AND SICIDAREA=TC.SICIDAREA) 
                END ASUNTO,
                CASE WHEN TC.SICIDCLASIFICACIONASUNTO >=1 
                  THEN (SELECT SICNOMBRECLASIFICACIONASUNTO FROM TAB_CLASIFICACIONASUNTO WHERE SICIDCLASIFICACIONASUNTO=TC.SICIDCLASIFICACIONASUNTO AND SICIDASUNTO=TC.SICIDASUNTO) 
                END SUBTEMA, 
                CASE WHEN TR.SICIDRESULTADOCONCILIACION=1 THEN 'ACTA'
                    WHEN TR.SICIDRESULTADOCONCILIACION=2 THEN 'CONSTANCIA'
                    WHEN TR.SICIDRESULTADOCONCILIACION=6 THEN 'INASISTENCIA'
                    WHEN TR.SICIDRESULTADOCONCILIACION=3 THEN 'OTROS'
                    ELSE 'VERIFICAR'
                END RESULTADO_PADRE,
                TTR.SICNOMBRETIPORESULTADOCONCILIA TIPORESULTADO,
                UPPER(TOPER.SICNOMBREPERSO||' '||TOPER.SICAPELLIDOPERSO) CONCILIADORCASO ,
                TOPER.SICIDPERSONA CCCONCILIADOR,
                TOPER.SICIDPERSONA||'.png' FIRMACONCILIADOR,
                TSE.NOMBRESEDE NOMSEDE"
                )
            )
            ->join("TAB_SESIONAUDIENCIACONCI as TS", "TC.SICNUMEROREGISTROCONCILIACION","TS.SICIDCASO")
            ->leftJoin('TAB_OPERADORCASO as TOC', 'TOC.SICIDCASO', '=', 'TC.SICNUMEROREGISTROCONCILIACION')
            ->leftJoin('TAB_OPERADOR as TOPER', 'TOPER.SICIDPERSONA', '=', 'TOC.SICIDOPERADORCASO')
            ->leftJoin('TAB_RESULTADOCONCILIACION as TR', 'TR.NUM_SOLICITUD', '=', 'TC.NUM_SOLICITUD')
            ->leftJoin('TAB_SEDES as TSE', 'TSE.IDSEDE', '=', 'TC.SICIDSEDE')
            ->leftJoin('TAB_TIPORESULTADOCONCILIACION as TTR', function($join) {
                $join->on("TTR.SICIDTIPORESULTADOCONCILIACION","=","TR.SICIDTIPORESULTADOCONCILIACION")
                    ->on("TTR.SICPADREID","=","TR.SICIDRESULTADOCONCILIACION");})
            ->where("TC.NUM_SOLICITUD",$sinproc)
            ->take(1)
            ->get();

        $data=array(
            "arrayDatosConvocadosNatural"=>$arrayDatosConvocadosNatural,
            "arrayDatosConvocadosOrganizacion"=>$arrayDatosConvocadosOrganizacion,
            "arrayDatosConvocanteNatural"=>$arrayDatosConvocanteNatural,
            "arrayDatosConvocanteOrganizacion"=>$arrayDatosConvocanteOrganizacion,
            "datosDeLaSolicitud"=>$datosDeLaSolicitud,
            "sinproc"=>$sinproc
        );

        $pdf = PDF::loadView('conciliaciones.pdf.printActas.printActaFinal', $data);
        return $pdf->download('actaFinal.pdf');

    }
    // IMPRESION DEL WORD CON RESULTADO DE LA CONCILIACION
    public function impresionResutaldoWord($sinproc,$tipo){

        // 1) IDENTIFICAR VARIABLES BASICAS
        $dias=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


        $date = Carbon::now();
        $dia = $date->format('d');
        $mes = $meses[($date->format('n')) - 1];
        $vigencia = $date->format('Y');
        $hora=$date->format('H:i');
        $diaLetras=strtoupper(trim(NumerosEnLetras::convertir($dia)));

        $fechaDia=$diaLetras." ".$dia." día(s) del mes de ".$mes." del ".$vigencia.", siendo las ".$hora.",";
        $fechaDiaSimple=$dia." del ".$mes." del ".$vigencia.",";
        $datosConvocados='';
        $datosConvocadosTodo='';

        // 1.1) ARRAY CON DATOS DE LOS CONVOCADOS (NATURAL ORGANIZACION) NOMBRES, TIPO DOCUMENTO, NUMERO DOCUMENTO , CIUDAD EXPEDICION
        $arrayDatosConvocadosNatural = DB::table('TAB_INVOLUCRADOCASO as TIC ')
            ->select(
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificado(a) con # '||TP.SICIDENTIFICACION||', '  SOLICITAN"),
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificad(@) con '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TP.SICIDENTIFICACION||' DE '||TP.SICCIUDADEXPEDICION||',' DATOS")
            )
            ->join("TAB_PERSONA as TP", "TP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIC.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
            ->where("TIC.NUM_SOLICITUD",$sinproc)
            ->where("TIC.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCADO'"))
            ->where("TIC.ESTADO",1)
            ->get();

        foreach ($arrayDatosConvocadosNatural as $p) {
            $datosConvocados.=$p->solicitan;
            $datosConvocadosTodo.=$p->datos;
        }

        $arrayDatosConvocadosOrganizacion = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO as TIO ')
            ->select(
                \DB::raw("' '||TOR.SICNOMBRE ||' identificado(a) con # '||TOR.SICIDENTIFICACION SOLICITAN"),
                \DB::raw("' '||TOR.SICNOMBRE ||' identificad(@) con la '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TOR.SICIDENTIFICACION DATOS")
            )
            ->join("TAB_ORGANIZACION as TOR", "TOR.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIO.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TOR.SICTIPODOCUMENTOIDENTIDAD")
            ->where("TIO.NUM_SOLICITUD",$sinproc)
            ->where("TIO.SICIDTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCADO'"))
            ->where("TIO.ESTADO",1)
            ->get();
        foreach ($arrayDatosConvocadosOrganizacion as $p) {
            $datosConvocados.=$p->solicitan;
            $datosConvocadosTodo.=$p->datos;
        }
        $datosApoderadoConvocado = DB::table('TAB_APODERADO_INVOLUCRADO as TAI')
            ->select(
                \DB::raw("TPAP.SICPRIMERNOMBRE||' '||TPAP.SICSEGUNDONOMBRE||' '||TPAP.SICPRIMERAPELLIDO||' '||TPAP.SICSEGUNDOAPELLIDO||' identificado(a) con C.C. '||TAI.SICIDAPODERADOINVOLUCRADO  APODERADO")
            )
            ->join("TAB_PERSONA as TPAP","TPAP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TAI.SICIDAPODERADOINVOLUCRADO)") )
            ->where("TAI.NUM_SOLICITUD",$sinproc)
            ->where("TAI.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCADO'"))
            ->get();
        // 1.2)  CREAR ARRAY CON DATOS DE LOS CONVOCANTES (NATURAL ORGANIZACION) NOMBRES, TIPO DOCUMENTO, NUMERO DOCUMENTO , CIUDAD EXPEDICION
        $datosConvocantes='';
        $datosConvocantestodo='';

        $arrayDatosConvocanteNatural = DB::table('TAB_INVOLUCRADOCASO as TIC ')
            ->select(
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificado(a) con # '||TP.SICIDENTIFICACION||', '  SOLICITAN"),
                \DB::raw("' '||TP.SICPRIMERNOMBRE||' '||TP.SICSEGUNDONOMBRE||' '||TP.SICPRIMERAPELLIDO||' '||TP.SICSEGUNDOAPELLIDO||' identificad(@) con '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TP.SICIDENTIFICACION||' DE '||TP.SICCIUDADEXPEDICION||',' DATOS")
            )
            ->join("TAB_PERSONA as TP", "TP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIC.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TP.SICIDTIPODOCUMENTO")
            ->where("TIC.NUM_SOLICITUD",$sinproc)
            ->where("TIC.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->where("TIC.ESTADO",1)
            ->get();

        foreach ($arrayDatosConvocanteNatural as $p) {
            $datosConvocantestodo.=$p->solicitan;
            $datosConvocantes.=$p->datos;
        }

        //dd($datosConvocantes);

        $arrayDatosConvocanteOrganizacion = DB::table('TAB_INVOLUCRADOCASOORGANIZACIO as TIO ')
            ->select(
                \DB::raw("' '||TOR.SICNOMBRE ||' identificado(a) con # '||TOR.SICIDENTIFICACION SOLICITAN"),
                \DB::raw("' '||TOR.SICNOMBRE ||' identificad(@) con la '||TD.SICTIPODOCUMENTOIDENTIDAD||' '||TOR.SICIDENTIFICACION DATOS")
            )
            ->join("TAB_ORGANIZACION as TOR", "TOR.SICIDENTIFICACION",\DB::raw("TO_CHAR(TIO.SICIDINVOLUCRADOCASO)"))
            ->join("TAB_TIPODOCUMENTOIDENTIDAD as TD", "TD.SICIDTIPODOCUMENTOIDENTIDAD","TOR.SICTIPODOCUMENTOIDENTIDAD")
            ->where("TIO.NUM_SOLICITUD",$sinproc)
            ->where("TIO.SICIDTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->where("TIO.ESTADO",1)
            ->get();

        //dd($arrayDatosConvocanteOrganizacion);
        foreach ($arrayDatosConvocanteOrganizacion as $l) {
            $datosConvocantestodo.=$l->solicitan;
            $datosConvocantes.=$l->datos;
        }

        $datosApoderadoConvocante = DB::table('TAB_APODERADO_INVOLUCRADO as TAI')
            ->select(
                \DB::raw(" TPAP.SICPRIMERNOMBRE||' '||TPAP.SICSEGUNDONOMBRE||' '||TPAP.SICPRIMERAPELLIDO||' '||TPAP.SICSEGUNDOAPELLIDO||' identificado(a) con C.C. '||TAI.SICIDAPODERADOINVOLUCRADO  APODERADO")
            )
            ->join("TAB_PERSONA as TPAP","TPAP.SICIDENTIFICACION",\DB::raw("TO_CHAR(TAI.SICIDAPODERADOINVOLUCRADO)") )
            ->where("TAI.NUM_SOLICITUD",$sinproc)
            ->where("TAI.SICTIPOINVOLUCRADOCASO",\DB::raw("'CONVOCANTE'"))
            ->get();

        // 1.3) TRAR LOS DAROS BASICOS DE TODA LA CONCILIACION

        $datosBasicosConciliacion = DB::table('TAB_CASO TC ')
            ->select(
                \DB::raw("
                        SUBSTR(TC.SICNUMEROREGISTROCONCILIACION,INSTR(TC.SICNUMEROREGISTROCONCILIACION,'_')+1,2) NUMREG,
                        TO_CHAR(TC.SICFECHASOLICITUD, ' DD/MM/YYYY')FECHASOLICITUD,
                        TO_CHAR(TS.SICFECHASESIONAUDIENCIACONCILI,'DD/MM/YY HH24:MI') FECHAAUDIENCIA,
                        TO_CHAR(TS.SICFECHASESIONAUDIENCIACONCILI,'DD') DIAAUDIENCIA,
                        TO_CHAR(TS.SICFECHASESIONAUDIENCIACONCILI,'MM') MESAUDIENCIA,
                        TO_CHAR(TS.SICFECHASESIONAUDIENCIACONCILI,'YY') VIGENCIAAUDIENCIA,
                        TO_CHAR(TS.SICFECHASESIONAUDIENCIACONCILI,'HH24:MI') HORAAUDI,
                        TC.SICDESCRIPCIONPRETENSIONES PRETENCIONES,
                        TOPER.SICNUMTARJETAPROFECI CODABOGADO,
                        TS.DIRECCIONSEDE||' PISO: '||TS.PISO||' MODULO '||TS.MODULO DIREC,
                        ' TELEFONOS '||TS.TELEFONOSEDE||' '||TS.TELEFONOSEDE2||' '||TS.TELEFONOSEDE3||' EXT '||TS.EXT1||' '||TS.EXT2 TELSEDE,
                        CASE
                            WHEN TC.SICIDSEDE = 20 THEN 'CENTRO'
                            WHEN TC.SICIDSEDE = 30 THEN 'SUPERCADE 20 DE JULIO'
                            WHEN TC.SICIDSEDE = 40 THEN 'SUPERCADE CRA. 30 - CAD'
                            WHEN TC.SICIDSEDE = 50 THEN 'SUPERCADE AMERICAS'
                            WHEN TC.SICIDSEDE = 60 THEN 'SEPERCADE BOSA'
                            WHEN TC.SICIDSEDE = 70 THEN 'SUPERCADE SUBA'
                            WHEN TC.SICIDSEDE = 80 THEN 'S.A.U SUBA'
                            WHEN TC.SICIDSEDE = 100 THEN 'CASA DE JUSTICIA DE MARTIRES'
                            WHEN TC.SICIDSEDE = 110 THEN 'CASA DE JUSTICIA CIUDAD BOLIVA'
                            WHEN TC.SICIDSEDE = 120 THEN 'CASA DE JUSTICIA DE USME' 
                        END SEDE,
                        UPPER(TOPER.SICNOMBREPERSO||' '||TOPER.SICAPELLIDOPERSO) CONCILIADORCASO,
                        TOPER.SICNUMTARJETAPROFECI CODIGOABOGADO
                ")
            )
            ->leftJoin("TAB_OPERADORCASO as TOC ", "TOC.SICIDCASO","TC.SICNUMEROREGISTROCONCILIACION")
            ->leftJoin("TAB_OPERADOR as TOPER", "TOPER.SICIDPERSONA","TOC.SICIDOPERADORCASO")
            ->join("TAB_SESIONAUDIENCIACONCI as TS", "TC.SICNUMEROREGISTROCONCILIACION","TS.SICIDCASO")
            ->join("TAB_SEDES as TS","TS.IDSEDE","TC.SICIDSEDE")
            ->where("TC.NUM_SOLICITUD",$sinproc)
            ->get();



        foreach ($datosBasicosConciliacion as $p) {
            $numreg=$p->numreg;
            $fecSolicitud=$p->fechasolicitud;
            $fechaAudiencia=$p->fechaaudiencia;
            $pretenciones=$p->pretenciones;
            $sede=$p->sede;
            $conciliadorCaso=$p->conciliadorcaso;
            $codigoAbogado=$p->codigoabogado;
            $diaAudiencia=$p->diaaudiencia;
            $mesAudiencia=$p->mesaudiencia;
            $horaAudiencia=$p->horaaudi;
            $vigenciaAudiencia=$p->vigenciaaudiencia;
            $direccion=$p->direc;
            $codigoAbogado=$p->codabogado;
            $telefonoSede=$p->telsede;
        }

        // 2) DEFINIR LA PLANTILLA A UTILZIAR
        switch ($tipo) {
            case 0: $url = 'conciliaciones/acta/acuerdoTotalPlantilla.docx';    break;
            case 1: $url = 'conciliaciones/acta/conciliacParcialPlantilla.docx';    break;
            case 2: $url = 'conciliaciones/constancia/noAcuerdoPlantilla.docx'; break;
            case 3: $url = 'conciliaciones/constancia/noConciliablePlantilla.docx'; break;
            case 4: $url = 'conciliaciones/inasistencia/inasistencia2pPlantilla.docx';  break;
            case 5: $url = 'conciliaciones/inasistencia/inasistenciaConvocadoPlantilla.docx';   break;
            case 6: $url = 'conciliaciones/inasistencia/inasistenciaConvocantePlantilla.docx';  break;
        }
        // 3) CREAR ESTANDAR DE USO PARA PLANTILLA WORD
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(Storage_path($url));
        // 4) DEFNIR NOMBRE Y VALIABLES A ENCIAR EN PLANTILLA
        $templateProcessor->setValue('sinproc',$sinproc);
        $templateProcessor->setValue('dia',$fechaDia);
        $templateProcessor->setValue('fechaDiaSimple',$fechaDiaSimple);
        $templateProcessor->setValue('convocantes',$datosConvocantes);
        $templateProcessor->setValue('convocantesTodo',$datosConvocantestodo);
        $templateProcessor->setValue('convocandos',$datosConvocados);
        $templateProcessor->setValue('convocandosTodo',$datosConvocadosTodo);
        $templateProcessor->setValue('numConciliacion',$numreg);
        $templateProcessor->setValue('fechaSolicitud',$fecSolicitud);
        $templateProcessor->setValue('fechaAudiencia',$fechaAudiencia);
        $templateProcessor->setValue('pretenciones',$pretenciones);
        $templateProcessor->setValue('sede',$sede);
        $templateProcessor->setValue('conciliador',$conciliadorCaso);
        $templateProcessor->setValue('codigoAbogado',$codigoAbogado);
        $templateProcessor->setValue('diaAudiencia',$diaAudiencia);
        $templateProcessor->setValue('mesAudiencia',$mesAudiencia);
        $templateProcessor->setValue('vigenciaAudiencia',$vigenciaAudiencia);
        $templateProcessor->setValue('horaAudiencia',$horaAudiencia);
        $templateProcessor->setValue('direccionSede',$direccion);
        $templateProcessor->setValue('apoderadoConvocado',$datosApoderadoConvocado);
        $templateProcessor->setValue('apoderadoConvocante',$datosApoderadoConvocante);
        $templateProcessor->setValue('codAbogado',$codigoAbogado);
        $templateProcessor->setValue('telefonoSede',$telefonoSede);
        $templateProcessor->setValue('nombreDirectorConciliacion','JAIRO AUGUSTO MEJIA ALVAREZ');




        // 5) GRABAR PLANTILLA Y RETORNAR CON DATOS DE BD
        $templateProcessor->saveAs("$sinproc.docx");
        return response()->download("$sinproc.docx");
    }
    // GENERADOR DE EXCEL POR TIPO DE REPORTE
    public function generarReporte(Request $request){
        $fechaInicial=$request->input("fechaInicial");
        $fechaFinal=$request->input("fechaFinal");
        $tipoReporte=$request->input("tipoReporte");
        $idSede=Session::get('idSede');
        //dd($fechaInicial.' ****** '.$fechaFinal.' ------ '.$tipoReporte);

        switch ($tipoReporte) {
            case 0:
                $sqlAnx=" WHERE TC.PASO8=1  
                AND TR.SICFECHAREGISTRORESULTADOC BETWEEN TO_DATE('$fechaInicial 00:00:01','DD/MM/YYYY HH24:MI:SS') 
                AND TO_DATE('$fechaFinal 23:59:59','DD/MM/YYYY HH24:MI:SS')
                AND TC.SICIDSEDE=$idSede";
                break;
            case 1:
                $sqlAnx=" WHERE TC.PASO8=0  
                AND TC.SICFECHAREGISTRO BETWEEN TO_DATE('$fechaInicial 00:00:01','DD/MM/YYYY HH24:MI:SS') 
                AND TO_DATE('$fechaFinal 23:59:59','DD/MM/YYYY HH24:MI:SS')
                AND TC.SICIDSEDE=$idSede";
                break;
            case 2:
                $sqlAnx=" WHERE TC.SICFECHAREGISTRO BETWEEN TO_DATE('$fechaInicial 00:00:01','DD/MM/YYYY HH24:MI:SS') 
                AND TO_DATE('$fechaFinal 23:59:59','DD/MM/YYYY HH24:MI:SS')
                AND TC.SICIDSEDE=$idSede";
                break;
        }

        $query="SELECT TC.SICNUMEROREGISTROCONCILIACION NUMREG,UPPER(TC.SICDESCRIPCIONHECHOS) HECHOS,
            UPPER(TC.SICDESCRIPCIONPRETENSIONES) PRETENCIONES,TC.SICCUANTIAINDETERMINADA CUANTIA,
            TE.SICNOMBREESCALADACONFLICTOCONC TIPOCONFLICTO, TC.SICFECHAREGISTRO FECREGISTRO,
            TO_CHAR(TS.SICFECHASESIONAUDIENCIACONCILI,'DD/MM/YYYY HH24:MI') FECHASESION,TC.NUM_SOLICITUD SINPROC,
            TS.SICDETALLESSESIONAUDIENCIACONC DETALLESESION,TO_CHAR(TC.SICFECHASOLICITUD,'DD/MM/YYYY') FECSOL,
            CASE WHEN TC.SICIDAREA >=1
              THEN (SELECT SICNOMBREAREA FROM TAB_AREA WHERE SICIDAREA=TC.SICIDAREA)
            END AREA,
            CASE WHEN TC.SICIDASUNTO >=1 
              THEN (SELECT SICNOMBREASUNTO FROM TAB_ASUNTO WHERE SICIDASUNTO=TC.SICIDASUNTO AND SICIDAREA=TC.SICIDAREA) 
            END ASUNTO,
            CASE WHEN TC.SICIDCLASIFICACIONASUNTO >=1 
              THEN (SELECT SICNOMBRECLASIFICACIONASUNTO FROM TAB_CLASIFICACIONASUNTO WHERE SICIDCLASIFICACIONASUNTO=TC.SICIDCLASIFICACIONASUNTO AND SICIDASUNTO=TC.SICIDASUNTO) 
            END SUBTEMA, TCON.SICTIEMPOCONFLICTO TIEMPO_CONFLICTO,
            SS.SICNOMBRESOLICITANTESERVICIO SOLICITANTE_SERVICIO,FS.SICNOMBRETIPOFINALIDADMINISTER FINALIDAD_CONCILIACION,
            UPPER(TOPER.SICNOMBREPERSO||' '||TOPER.SICAPELLIDOPERSO) CONCILIADORCASO,
            TR.SICIDRESULTADOCONCILIACION RESULPADRE, TTR.SICNOMBRETIPORESULTADOCONCILIA TIPOACUERDO, 
            TO_CHAR(TR.SICFECHAREGISTRORESULTADOC,'DD/MM/YYYY') FECRESUL
        FROM TAB_CASO TC
            LEFT JOIN TAB_CONCILIACION TCO ON TC.SICNUMEROREGISTROCONCILIACION=TCO.SICIDCASO
            LEFT JOIN TAB_ESCALADACONFLICTOCONCI TE ON TE.SICIDESCALADACONFLICTOCONCILIA=TCO.SICIDESCALADACONFLICTOCONCILIA
            LEFT JOIN TAB_SESIONAUDIENCIACONCI TS ON TC.SICNUMEROREGISTROCONCILIACION=TS.SICIDCASO
            LEFT JOIN TAB_AREA A ON TC.SICIDASUNTO=A.SICIDAREA
            LEFT JOIN TAB_SOLICITANTESERVICIO SS ON TC.SICIDSOLICITANTESERVICIO=SS.SICIDSOLICITANTESERVICIO
            LEFT JOIN TAB_TIPOFINALIDADMINISTERIO FS ON TC.SICIDTIPOFINALIDADMINISTERIO = FS.SICIDTIPOFINALIDADMINISTERIO
            LEFT JOIN TAB_TIEMPOCONFLICTO TCON ON TC.SICIDTIEMPOCONFLICTO = TCON.SICIDTIEMPOCONFLICTO
            LEFT JOIN TAB_OPERADORCASO TOC ON TOC.SICIDCASO=TC.SICNUMEROREGISTROCONCILIACION
            LEFT JOIN TAB_OPERADOR TOPER ON TOPER.SICIDPERSONA = TOC.SICIDOPERADORCASO
            LEFT JOIN TAB_RESULTADOCONCILIACION TR ON TR.NUM_SOLICITUD=TC.NUM_SOLICITUD
            LEFT JOIN TAB_TIPORESULTADOCONCILIACION TTR ON TTR.SICIDTIPORESULTADOCONCILIACION=TR.SICIDTIPORESULTADOCONCILIACION";
        $query.=$sqlAnx;
        $resultadoSql=DB::select($query);
        (new FastExcel($resultadoSql))->export('reporteConciliaciones.xlsx');
    }
    // SALIDA DEL SSTEMA Y ELIMINACION DE DATO
    public function exitSystem(){

        session()->forget('emailUsuario');
        session()->forget('ccFuncionario');
        session()->forget('idSede');
        session()->forget('siglaSede');
        session()->forget('nombreSede');
        session()->forget('nombreUsuario');
        session()->flush();
        return redirect()->guest('/');
        //return \Redirect::Route('/','rapivController@login');
    }
}

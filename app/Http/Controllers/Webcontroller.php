<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Response;


//MODELS
use App\tramiteusuario;
use App\tramiterespuesta;
use App\binconsecutivo;

use App\Models\ASubasunto;
use App\Models\Asunto;
use App\Models\ConciCorreoinv;
use App\Models\ConciDocumento;
use App\Models\ConciReferente;
use App\Models\Convocante;
use App\Models\Estadoform;
use App\Models\Parametro;
use App\Models\Salario;
use App\Models\Sistema\CondicionProteccion;
use App\Models\Sistema\GrupoAfectado;
use App\Models\Sistema\RelacionCondicionProteccion;
use App\Models\Sistema\SisDepartam;
use App\Models\Soportecon;
use App\Models\SubAsunto;
use App\Models\Subdescripcion;
use App\Models\Tema;
use App\Models\Texto;
use App\Models\Tramiterespuesta as ModelsTramiterespuesta;
use App\Models\Tramiteusuario as ModelsTramiteusuario;
use App\tabrepartoweb;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Sistema\SisLocalidad;
use App\Models\Sistema\SisMunicipio;
use App\Models\Sistema\SisPai;
use App\Models\Tramite;
use App\Traits\Combos\CombosTrait;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;

class Webcontroller extends Controller
{
    use CombosTrait;


    public $listaCondicionesProteccion, $auxLista = [], $selectedCondiciones = [];
    public $listaDesplegables = [], $selectListaDesplegables = [];


//Funcion para cargar combos y vista del formulario
            public function home()
        {
            $mensaje = Texto::where('sis_esta_id', 1)->first();

            $salario = Salario::find(1)->first();
            $Maxhoy = Carbon::today()->isoFormat('YYYY-MM-DD');
            $minhoy = Carbon::today()->subYears(100)->isoFormat('YYYY-MM-DD');;
            $localidadList = SisLocalidad::combo();
            $listaSedes = SisLocalidad::combo();
            $listaAsuntos = Asunto::combo(true, false);
            $estadoTipoAudi = SisLocalidad::combo();
            $departamentos = SisDepartam::combo(true,false);
            $grupoafectado = GrupoAfectado::combo(true,false);
            $municipios = ['' => 'Seleccione'];
            $listaTipoDoc = Tema::combo(3, true, false);
            $sexocombo = Tema::comboasc(4, true, false);
            $generocombo = Tema::comboasc(5, true, false);
            $orientacioncombo = Tema::comboasc(6, true, false);
            $escolaridad = Tema::comboasc(7, true, false);
            $nacionalidad = SisPai::combo(false, false);
       
            $listaCondiciones = CondicionProteccion::where('habilitado', true)
            ->select('id', 'nombre', 'descripcion', 'imagen_on', 'imagen_off','habilitado')
            ->orderBy('id', 'ASC')
            ->get()->toArray();

            foreach ($listaCondiciones as $key => $lista) {
                /**
                 * Agrega a la lista traida de la base de dato los siguientes campos:
                 * enabled -> activar o desactivar boton en front
                 * checked -> cambiar icono al seleccionar o deseleccionar condicion
                 */
                $listaCondiciones[$key] += ['enabled' => true];
                $listaCondiciones[$key] += ['checked' => false];
            }
            $this->listaCondicionesProteccion=collect($listaCondiciones);
            //dd($this->listaCondicionesProteccion);
            $tipoSolicitud = '';
            $data = array(
                "listaLocalidades" => $localidadList,
                "listaSedes" => $listaSedes,
                "listaAsuntos" => $listaAsuntos,
                "listaTipoDoc" => $listaTipoDoc,
                "estadoTipoAudi" => $estadoTipoAudi,
                "grupoafectado" => $grupoafectado,
                "mensaje" => $mensaje,
                "salario" => $salario,
                "departamentos" => $departamentos,
                "municipios" => $municipios,
                "Maxhoy" => $Maxhoy,
                "minhoy" => $minhoy,
                 "sexocombo" => $sexocombo,
                 "generocombo" => $generocombo,
                 "orientacioncombo" => $orientacioncombo,
                 "escolaridad" => $escolaridad,
                 "nacionalidad" => $nacionalidad,
                 "listaCondiciones" => $listaCondiciones,
            );
            
            
            return ((string)\View::make("frmWeb.homestep", array("data" => $data,"listaCondicionesProteccion"=>$this->listaCondicionesProteccion)));
        }

        private function fetchCondicionesProteccion(){
            /**
             * Esta funcion se encarga de traer la lista inicial de condiciones
             * de proteccion de acuerdo con lo registrado en la base de datos
             */
            $this->listaCondicionesProteccion = 
                CondicionProteccion::where('habilitado', true)
                    ->select('id', 'nombre', 'descripcion', 'imagen_on', 'imagen_off','habilitado')
                    ->orderBy('id', 'ASC')
                    ->get();
            foreach ($this->listaCondicionesProteccion as $key => $lista) {
                /**
                 * Agrega a la lista traida de la base de dato los siguientes campos:
                 * enabled -> activar o desactivar boton en front
                 * checked -> cambiar icono al seleccionar o deseleccionar condicion
                 */
                $this->listaCondicionesProteccion[$key] += ['enabled' => true];
                $this->listaCondicionesProteccion[$key] += ['checked' => false];
            }
        }
    
        private function updateCondicionesDisponibles($undo){
            /**
             * Esta funcion se encarga de actualizar las condiciones posibles de seleccionar
             * de acuerdo con la seleccion del ususario y las relaciones asignadas en DB
             */
        
            if(count($this->selectedCondiciones) > 0){
                /**
                 * undo -> booleano usado para identificar la accion del usuario, es decir,
                 * si el usuario esta seleccionando o deseleccionando una condicion
                 */
       
                if(!$undo){
                    //Selecciona una condicion
               
                    //Itera el arreglo con las selecciones del peticionario
                    foreach ($this->selectedCondiciones as $selected) {
                        //Trae las relaciones de cada condicion seleccionada
                        $relaciones = RelacionCondicionProteccion::where('condicion', $selected)->get();
                        //Itera las relacioens
                        foreach ($this->listaCondicionesProteccion as $key => $lista) {
                            //Desactiva las condiciones que no posean relacion con la seleccion del peticionario
                            if($lista['id'] != $selected && $relaciones->where('relacion', $lista['id'])->first() == null){
                                $this->listaCondicionesProteccion[$key]['enabled'] = false;
                        
                            }
                        }
                    }
                } else{
                    //Deseleccionando una condicion
                    foreach ($this->listaCondicionesProteccion as $key => $lista) {
                        //Habilita todas las condiciones
                        $this->listaCondicionesProteccion[$key]['enabled'] = true;
                    }
                    //Recursividad para desactivar botones de acuerdo a las relaciones
                    $this->updateCondicionesDisponibles(false);
                }
            }else{
                //Habilita todos los botones
                foreach ($this->listaCondicionesProteccion as $key => $lista) {
                    $this->listaCondicionesProteccion[$key]['enabled'] = true;
                }
            }  
        }

        public function seleccionarCondicion(Request $request){
   

            $this->listaCondicionesProteccion = CondicionProteccion::where('habilitado', true)
            ->select('id', 'nombre', 'descripcion', 'imagen_on', 'imagen_off','habilitado')
            ->orderBy('id', 'ASC')
            ->get()->toArray();

            foreach ($this->listaCondicionesProteccion as $key => $lista) {
                /**
                 * Agrega a la lista traida de la base de dato los siguientes campos:
                 * enabled -> activar o desactivar boton en front
                 * checked -> cambiar icono al seleccionar o deseleccionar condicion
                 */
                $this->listaCondicionesProteccion[$key] += ['enabled' => true];
                $this->listaCondicionesProteccion[$key] += ['checked' => false];
            }
    
            if ($request->ajax()) {
            $id=$request->id;
            //Trae toda la informacion de la condicion seleccionada
            //$table = CondicionProteccion::find($request->id);
            $table = CondicionProteccion::find($this->listaCondicionesProteccion[$id]['id']);

            /**
             * Valida la accion del usuario
             * - Si el id que recibe la funcion no esta en el arreglo selectedCondiciones,
             *   es por que el usuario esta seleccionando una condicion
             * - Si el id que recibe la funcion SI existe en el arreglo selectedCondiciones,
             *   es porque el usuario esta deseleccionando una condicion
             */
            if(!in_array($this->listaCondicionesProteccion[$id]['id'], $this->selectedCondiciones)){
                //guarda el id de base de datos correspondiente a la condicion seleccionada
                array_push($this->selectedCondiciones, $this->listaCondicionesProteccion[$id]['id']);
                //marca como seleccionado el boton para cambiar el icono
                $this->listaCondicionesProteccion[$id]['checked'] = true;
                //valida si la condicion seleccionada posee una lista desplegable
            
                $lista = $this->getDesplegable(['condicion' => $table->id]);
          
                if(isset($lista)){
                    //trae la lista desplegable correspondiente a la condicion
                    $this->listaDesplegables[$table->id] = [
                        // 'datos' => DB::table($table->tabla_desplegable)->where('habilitado', true)->get(),
                        'datos' => $lista,
                        'nombre' =>  $table->tabla_desplegable,
                        // 'id' => $table->id,
                    ];
                    
                    // dd($this->listaDesplegables);
                    // $this->selectListaDesplegables[$table->tabla_desplegable] = '';
                }
                //actualiza las condiciones disponibles para seleccion
                $this->updateCondicionesDisponibles(false);
            } else{
                $indexCondicion = array_search($this->listaCondicionesProteccion[$id]['id'], $this->selectedCondiciones);
                //Elimina la condicion recibida del arreglo selectedCondiciones
                unset($this->selectedCondiciones[$indexCondicion], $this->listaDesplegables[$table->id], $this->selectListaDesplegables[$table->id]);
                $this->listaCondicionesProteccion[$id]['checked'] = false;
                $this->updateCondicionesDisponibles(true);
            }
        }
    }
    //Modal con el texto de bienvenida
    public function modalMensajeBienvenida()
    {
   
        $estadoform =Estadoform::where('sis_esta_id', 1)->first();
       
        if(isset($estadoform)){
            $mensaje = Texto::where('tipotexto_id', 20)->where('sis_esta_id', 1)->first();
            $data = array(
                "mensaje" => $mensaje
            );
            return ((string)\View::make("frmWeb.modal.modalMensajeBienvenida", array("data" => $data)));
        }else{
            $mensaje = Texto::where('tipotexto_id', 22)->first();
            $data = array(
                "mensaje" => $mensaje
            );
            return ((string)\View::make("frmWeb.modal.modalMensajeBienvenidaCerrado", array("data" => $data)));
        }
      
    }

    //Funcion de carga de municipios
    public function getMunicipio(Request $request)
    {
        $respuest = [
            'emptyxxx' => '#sis_municipio_id',
            'combosxx' => [
                [
                    'comboxxx' => $this->getSisMunicipioCT(['ajaxxxxx' => true, 'padrexxx' => $request->padrexxx])['comboxxx'],
                    'selectid' => 'sis_municipio_id'
                ],
            ]
        ];
        return response()->json($respuest);
    }

    //Creacion de combo de carga de municipios
    public function getSisMunicipioCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = SisMunicipio::select('sis_municipios.s_municipio as optionxx', 'sis_municipios.codigo as valuexxx')
            ->where(function ($queryxxx) use ($dataxxxx) {
                $queryxxx->where('sis_departam_id', $dataxxxx['padrexxx']);
                if (isset($dataxxxx['whereinx']) && count($dataxxxx['whereinx'])) {
                    $queryxxx->whereIN('codigo', $dataxxxx['whereinx']);
                }
                if (isset($dataxxxx['wherenot']) && count($dataxxxx['wherenot'])) {
                    $queryxxx->whereNotIn('codigo', $dataxxxx['wherenot']);
                }
            })
            ->orderBy('s_municipio', 'asc')->get();
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }



    //Modal con mensaje de tratamiento de datos
    public function modalTratamientoDatos()
    {
        $mensaje = Texto::where('tipotexto_id', 19)->where('sis_esta_id', 1)->first();
        $data = array(
            "mensaje" => $mensaje
        );
        return ((string)\View::make("frmWeb.modal.modalManejoDatos", array("data" => $data)));
    }
    //Cargar la lista de los sub asuntos
    public function consultalistaSubAsuntos(Request $request)
    {
        $asunto = $request->input("asunto");

        // $detalleASunto = DB::table('TAB_ASUNTO_DETALLE_WEB')
        //     ->where('ID_ASUNTO', $asunto)
        //     ->where('ESTADO', 0)
        //     ->orderBy('DESCRIPCION')
        //     ->get();

        $detalleASunto = ASubasunto::select(['conci_sub_asuntos.id', 'conci_sub_asuntos.nombre'])
            ->join('conci_asuntos', 'conci_a_subasuntos.asunto_id', '=', 'conci_asuntos.id')
            ->join('conci_sub_asuntos', 'conci_a_subasuntos.subasu_id', '=', 'conci_sub_asuntos.id')
            ->where('conci_a_subasuntos.asunto_id', $asunto)
            ->where('conci_a_subasuntos.sis_esta_id', 1)
            ->orderBy('conci_sub_asuntos.nombre', 'asc')
            ->get();



        return $detalleASunto;
    }
    //Consultar informacion del ABC del asunto
    public function detalleAbcAsunto(Request $request, $text = null)
    {
        $subAsunto = $request->input("subAsunto");
        //SQL
        $detalleAbc = Subdescripcion::where('subasu_id', $subAsunto)
            ->where('sis_esta_id', 1)
            ->orderBy('id')
            ->get();
        //INFORMACION RETORNADA EN LA VISTA
        $data = array(
            "detalleAbc" => $detalleAbc
        );
        //RETURN DE LA VISTA
        return ((string)\View::make("frmWeb.card.abchome", array("data" => $data)));
    }


    public function solicitud(Request $request)
    {
        $tipoSolicitud = $request->input("tipoSolicitud");;

        //INFORMACION RETORNADA EN LA VISTA

        //RETURN DE LA VISTA
        return compact('tipoSolicitud');
    }
    protected function validatorUpdate(array $data, $id)
    {
        return Validator::make($data, [
            'numeroDocumento' => 'required|string|max:120|unique:parametros,nombre,' . $id,
        ]);
    }
    //Registro de la solicitud
    public function registroConciliacionWeb(Request $request)
    {

        $tramiteid=Tramite::select('id_tramite')->where('id_tramite', 335)->first();
            //America/Bogota
        //Datos requeridos por sistema
        $carbonDate = Carbon::now();
        $vigencia = Carbon::today()->isoFormat('YYYY');
        $fechaRegistro = date_format($carbonDate, 'd/m/Y h:m:s');
        $fechaRegistroA = date('d/m/Y H:i:s A');

        $idTramite = $tramiteid->id_tramite; 
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
        $departamento = $request->input("sis_departam_id");
        $municipio = $request->input("sis_municipio_id");
        //Tipo de solicitud
        $tipoSolicitud = $request->input("tipoSolicitud");
        //Datos convocados
        $nombreConvocados = $request->input("nomConvocante");
        $apellidoConvocados = $request->input("apeConvocante");
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
        $direccionapoderado = $request->input("direccionApoderado");
        //Datos de la audiencia
        $tipoAudiencia = $request->input("tipoAudiencia");
        $sedePrincipal = $request->input("sedePrincipal");
        $sedeSecundaria = $request->input("sedeSecundaria");
        $asunto = $request->input("asunto");
        $subAsunto = $request->input("subAsunto");
        $detalle = $request->input("detalle");
        $cuantia = $request->input("cuantia");
        

        //Nuevos campos
        $fechanacimiento = $request->input("fechanacimiento");
        $rangoedad = $request->input("rangoedad");
        $escolaridad = $request->input("escolaridad");
        $nacionalidad = $request->input("nacionalidad");
        $sexo = $request->input("sexo");
        $genero = $request->input("genero");
        $orientacion = $request->input("orientacion");
        $grupoafectado = $request->input("grupoafectado");
        



        //Valores Conciweb 1.0
        $asuntoold =Asunto::select(['nombre'])
        ->where('id', $request->input("asunto"))
        ->first();
        $subAsuntoold = SubAsunto::select(['nombre'])
        ->where('id', $request->input("subAsunto"))
        ->first();

        $documentonombre = Parametro::select(['nombre'])
        ->where('id', $request->input("tipoDocumento"))
        ->first();
        //0.0) Preguntar si se registro un caso 
        //echo($subAsuntoold);
        // try {
        //     $contadorSolicitudes = tramiteusuario::where('ID_USUARIO_REG', DB::raw("'" . $numeroDocumento . "'"))
        //         ->where('ESTADO_TRAMITE', DB::raw("'Remitido'"))
        //         ->where('TEXTO01', DB::raw("'" . $primerNombre . "'"))
        //         ->where('TEXTO02', DB::raw("'" . $segundoNombre . "'"))
        //         ->where('TEXTO03', DB::raw("'" . $primerApellido . "'"))
        //         ->where('TEXTO04', DB::raw("'" . $segundoApellido . "'"))
        //         ->where('TEXTO05', DB::raw("'" . $primerTelefono . "'"))
        //         ->where('NUMERO05', DB::raw("'" . $asuntoold->nombre . "'"))
        //         ->where('NUMERO06', DB::raw("'" . $subAsuntoold->nombre . "'"))
        //         ->where('TEXTO21', DB::raw("'" . $detalle . "'"))
        //         ->count();
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return '|0| 0.0 Problema al indentificaRRr la cantidad de solicitudes realizada [TRAM_USU] <br>' . $e->getMessage();
        // }

        // if ($contadorSolicitudes >= 1) {
        //     DB::commit();
        //     return '|1|El registro finalizo de forma correcta <br> Por favor verifique su correo electronico para mas información.';
        // }


        try {

            $user = binconsecutivo::where('vigencia', $vigencia)->orderBy('secuencial', 'DESC')->first();
          
            $numSolicitud = $user->secuencial + 1;
            
        } catch (\Exception $e) {
            DB::rollback();
            return '|0| 0.1) Problema al extraer el numero de solicitud asignado por el sistema' . $e->getMessage();
        }

       // 0.2) ACTUALIZAR EL REGISTRO EN BINCONSECUTIVO
        try {

            binconsecutivo::where('vigencia', $vigencia)
                ->update(['SECUENCIAL' => $numSolicitud]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 0.2) Problema al actualizar el numero asignado por el sistema' . $e->getMessage();
        }
  

        //Metodo para traer el valor minimo del contador de los usuarios referentes

        $Contadorminimo =ConciReferente::min('contador');


        //Se toma en cuenta el valor minimo y se compara con los demas registros
        $datosminimos = ConciReferente::select('consec','contador','depend_codigo')->where('estado', 1)
        ->where('contador', $Contadorminimo)
        ->get();

        //En este metodo se hace un sorteo del listado en el array y luego toma el primero valor de forma aleatoria

        $Solicitanteminimo= $datosminimos->shuffle();

        $datosSolicitante= $Solicitanteminimo->first();
            
            
 
            $depAsignada = $datosSolicitante->depend_codigo;
            $consecResponsable = $datosSolicitante->consec;
            $contador = $datosSolicitante->contador + 1;
   
        //1.a) Registrar informacion en tramiteusuario Local
        try {
            $code = random_int(10000, 99999);
            ModelsTramiteusuario::insert(
                [
                    'num_solicitud' => $numSolicitud,
                    'id_tramite' => $idTramite,
                    'id_usuario_reg' => $numeroDocumento,
                    'id_usuario_adm' => $datosSolicitante->consec,
                    'fec_solicitud_tramite' => DB::raw("TO_DATE('" . $fechaRegistro . "','DD/MM/YYYY HH24:MI:SS')"),
                    'estado_tramite' => DB::raw("'Remitido'"),
                    'vigencia' => $vigencia,
                    'oido_codigo' => 0,
                     'primerNombre' => DB::raw("'$primerNombre'"),
                     'segundoNombre' => DB::raw("'$segundoNombre'"),
                     'primerApellido' => DB::raw("'$primerApellido'"),
                     'segundoApellido' => DB::raw("'$segundoApellido'"),
                     'primerTelefono' => DB::raw("'$primerTelefono'"),
                     'segundoTelefono' => DB::raw("'$segundoTelefono'"),
                     'email' => DB::raw("'$email'"),
                     'direccion' => DB::raw("'$direccion'"),
                     'localidad' => DB::raw("$localidad"),
                     'tipoSolicitud' => $tipoSolicitud,
                     'tipoDocApoderado' => DB::raw("'$tipoDocApoderado'"),
                     'numDocApoderado' => DB::raw("'$numDocApoderado'"),
                    'primerNombreApoderado' => DB::raw("'$primerNombreApoderado'"),
                    'segundoNombreApoderado' => DB::raw("'$segundoNombreApoderado'"),
                    'primerApellidoApoderado' => DB::raw("'$primerApellidoApoderado'"),
                    'segundoApellidoApoderado' => DB::raw("'$segundoApellidoApoderado'"),
                    'tarjetaProfesional' => DB::raw("'$tarjetaProfesional'"),
                    'primerTelefonoApoderado' => DB::raw("'$primerTelefonoApoderado'"),
                    'segundoTelefonoApoderado' => DB::raw("'$segundoTelefonoApoderado'"),
                    'direccionapoderado' => DB::raw("'$direccionapoderado'"),
                    'emailApoderado' => DB::raw("'$emailApoderado'"),
                    'tipoAudiencia' => $tipoAudiencia,
                    'sedePrincipal' => $sedePrincipal,
                    'sedeSecundaria' => $sedeSecundaria,
                    'asunto' => $asunto,
                    'subAsunto' => $subAsunto,
                    'tipoDocumento' => $tipoDocumento,
                    'detalle' => DB::raw("'$detalle'"),
                    'cuantia' => $cuantia,
                    'code' => DB::raw("'$code'"),
                    'fechanacimiento' => $fechanacimiento,
                    'rangoedad' => $rangoedad,
                    'escolaridad' => $escolaridad,
                    'nacionalidad' => DB::raw("'$nacionalidad'"),
                    'sexo' => $sexo,
                    'genero' => DB::raw("'$genero'"),
                    'orientacion' => DB::raw("'$orientacion'"),
                    'grupoafectado' => DB::raw("'$grupoafectado'"),
                    ]
            );
        } catch (\Exception $e) {
            DB::rollback();
            return '|0| Problema al Insertar la informacion al sistema TRAMITEUSUARIO NUEVO ' . $e->getMessage();
        }
        //1.b) Registrar informacion en tramiteusuario SINPROC
        try {
           
            $nombre= $primerNombre . ' ' . $segundoNombre ;
            $apellido=$primerApellido . ' ' . $segundoApellido ;

            //administracion copia correo
            tramiteusuario::insert(
                [
                'NUM_SOLICITUD' => $numSolicitud,
                'ID_TRAMITE' => $idTramite,
                'ID_USUARIO_REG' => $numeroDocumento,
                'ID_USUARIO_ADM' => $datosSolicitante->consec,
                'FEC_SOLICITUD_TRAMITE' => DB::raw("TO_DATE('" . $fechaRegistro . "','DD/MM/YYYY HH24:MI:SS')"),
                'ESTADO_TRAMITE' => DB::raw("'Remitido'"),
                'VIGENCIA' => $vigencia,
                'OIDO_CODIGO' => 0,
                'TEXTO01' => DB::raw("'$nombre'"),
                'TEXTO02' => DB::raw("'$apellido'"),
                'TEXTO03' => DB::raw("'$email'"),
                'TEXTO05' => DB::raw("'$localidad'"),
                'TEXTO06' => DB::raw("'$departamento'"),
                'NUMERO40' => $municipio,
                'TEXTO20' => DB::raw("'$direccion'"),
                'TEXTO31' => DB::raw("'$primerTelefono'"),
                'TEXTO29' => DB::raw("'$tipoDocumento'"),
                'NUMERO01' => $numeroDocumento,
                'NUMERO04' => $tipoSolicitud,
                'TEXTO10' => DB::raw("'$tipoDocApoderado'"),
                'TEXTO11' => DB::raw("'$numDocApoderado'"),
                'TEXTO12' => DB::raw("'$primerNombreApoderado'"),
                'TEXTO13' => DB::raw("'$segundoNombreApoderado'"),
                'TEXTO14' => DB::raw("'$primerApellidoApoderado'"),
                'TEXTO15' => DB::raw("'$segundoApellidoApoderado'"),
                'TEXTO16' => DB::raw("'$tarjetaProfesional'"),
                'TEXTO17' => DB::raw("'$primerTelefonoApoderado'"),
                'TEXTO18' => DB::raw("'$segundoTelefonoApoderado'"),
                'TEXTO21' => DB::raw("'$direccionapoderado'"),
                'TEXTO19' => DB::raw("'$emailApoderado'"),
                'TEXTO24' => DB::raw("'$sexo'"),
                'TEXTO22' => DB::raw("'$genero'"),
                'TEXTO25' => DB::raw("'$orientacion'"),
                'NUMERO02' => $tipoAudiencia,
                'NUMERO03' => $sedePrincipal,
                'NUMERO04' => $sedeSecundaria,
                'NUMERO05' => $asunto,
                'NUMERO06' => $subAsunto,
                'NUMERO07' => $tipoDocumento,
                'TEXTO08' => DB::raw("'$detalle'"),
                'NUMERO03' => $cuantia,
                ]
            );
        } catch (\Exception $e) {
            DB::rollback();
            return '|0| Problema al Insertar la informacion al sistema TRAMITEUSUARIO SIN ' . $e->getMessage();
        }
        // try {
        //     $files=[];
        //     $descripcion=[];
        //     foreach($request->input("descripcion")as $key =>$file){
        //             $descripcion[] = $file;
        //         // $nombreOriginalFile = $value->getClientOriginalName();
        //         // $rutaFinalFile = Storage::disk('local')->put("", $value);
        //     }


        //     foreach($request->file("document") as $key =>$file){
        //         $rutaFinalFile = Storage::disk('local')->put("", $file);
        //         $files[]['name'] =$descripcion[$key];
        //         $nombreOriginalFile = $file->getClientOriginalName();
        //         Soportecon::create(['NUM_SOLICITUD' => $numSolicitud, 'descripcion' => $descripcion[$key], 'rutaFinalFile' => $rutaFinalFile,'nombreOriginalFile' => $nombreOriginalFile]);
        //     }
        //     //print_r($files);

        // }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 0.0) Problema al anexar el soporte en el sistema' . $e->getMessage();
        }


                //2) Registro del usuario en USUARIO_ROL
                $depeUsuario = 389;
                $estadoUsr = 'I';
                $tipoUsr = 'US';
                $nombresUsr = $primerNombre . ' ' . $segundoNombre;
                $apellidosUsr = $primerApellido . ' ' . $segundoApellido;
                $consec = '';
              
                //2.1) Extraer consecutivo
                try {
                    $user = DB::connection('oracleexterna')->table('USUARIO_ROL')->max('consec');
                    $consec = ($user) + 1;
          
                } catch (\Exception $e) {
                    DB::rollback();
                    return '|0| 4.1) Problema al extraer el consecutivo USR_ROL' . $e->getMessage();
                }
                //2.2) Preguntar si el usuario existe o no
                try {
                    $contadorUsuarioSol = DB::connection('oracleexterna')->table('USUARIO_ROL')
                        ->where('cedula', DB::raw("'" . $numeroDocumento . "'"))
                        ->count();
                  
                } catch (\Exception $e) {
                    DB::rollback();
                    return '|0| 4.2 Problema al indentificar el estodo del solicitante [USR_ROL] <br>' . $e->getMessage();
                }
                if ($contadorUsuarioSol >= 1) {
                    //2.2.1) Actualizar dependencai
                    
                    try {
                        $usuarioreg = DB::table('USUARIO_ROL')
                            ->where('cedula', DB::raw("'" . $numeroDocumento . "'"))
                            ->first();
                            $consec = ($usuarioreg->consec);
                       
                    } catch (\Exception $e) {
                        DB::rollback();
                        return '|0| 4.2.1 Problema al actualizar el estado del solicitante [USR_ROL] <br>' . $e->getMessage();
                    }
                }
                
                else {
                    //2.2.2) Insertar datos
                    
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

        //3) Registrar datos en tramiterespuesta

        //3.0) Extraer consecutivo de tramiterespuesta
        try {
            $user = tramiterespuesta::max('CONSECUTIVO');
            $consecutivo = ($user) + rand(1, 3);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0| 2.0) Problema al extraer el consecutivo TR' . $e->getMessage();
        }

 
        //3.0.a) INSERT DEL PASO 0 Prod
        try {
            ModelsTramiterespuesta::insert([
                [
                    'NUM_SOLICITUD' => $numSolicitud, 'ID_TRAMITE' => $idTramite, 'NUM_PASO' => 0,
                    'FEC_RESPUESTA' => DB::raw("sysdate"),
                    'TEX_RESPUESTA' => DB::raw("'" . $msg . "'"), 'ID_USU_ADM_CONTESTA' => $consec,
                    'ID_USU_ADM' => $consecResponsable, 'ESTADO_TRAMITE' => DB::raw("'Remitido'"),
                    'CONSECUTIVO' => $consecutivo, 'VIGENCIA' => $vigencia,
                    'ID_DEPENDENCIA_REG' => $depAsignada, 'ID_DEPENDENCIA_ASIG' => $depAsignada
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0| 2.2) Problema al Insertar la informacion al sistema TRAMITERESPUESTA  ' . $e->getMessage();
        }

        //3.0.b) INSERT DEL PASO Sinproc
        try {
            tramiterespuesta::insert([
                [
                    'NUM_SOLICITUD' => $numSolicitud, 'ID_TRAMITE' => $idTramite, 'NUM_PASO' => 0,
                    'FEC_RESPUESTA' => DB::raw("sysdate"),
                    'TEX_RESPUESTA' => DB::raw("'" . $msg . "'"), 'ID_USU_ADM_CONTESTA' => $numeroDocumento,
                    'ID_USU_ADM' => $consecResponsable, 'ESTADO_TRAMITE' => DB::raw("'Remitido'"),
                    'CONSECUTIVO' => $consecutivo, 'VIGENCIA' => $vigencia,
                    'ID_DEPENDENCIA_REG' => 9999, 'ID_DEPENDENCIA_ASIG' => $depAsignada
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return '|0| 2.2) Problema al Insertar la informacion al sistema TRAMITERESPUESTA SINPROC ' . $e->getMessage();
        }

        //3.1.1) actualziar datos del funcionario asignado
        try {
            
            tabrepartoweb::where('CONSEC', $consecResponsable)
                ->update(['contador' => $contador]);
 
           $test= ConciReferente::where('CONSEC', $consecResponsable)
           ->update(['contador' => $contador]);
           
        }
        catch (\Exception $e) {
            DB::rollback();
            return '|0| 2.1.1) Problema al actualizar los datos del funcionario responsable TAB_REPARTO_WEB' . $e->getMessage();
        }
        print_r($nombreConvocados);
        $i = 0;
        foreach ($nombreConvocados as $quan) {
            if ($quan != null) {
                try {
                    DB::table('conci_convocantes')->insert([
                        'NUM_SOLICITUD' => $numSolicitud,
                        'nomConvocante' => DB::raw("'" . $quan . "'"),
                        'apeconvocante' => DB::raw("'" . $apellidoConvocados[$i] . "'"),
                        'emailConvocante' => DB::raw("'" . $emailConvocados[$i] . "'"),
                    ]);
                }
                catch (\Exception $e) {
                    DB::rollback();
                    return '|0| 4.2.7) Problema al insertar los datos de los convocados. [TAB_INVOLUCRADO_WEB]' . $e->getMessage();
                }
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

        //4) Envio del email al usuario solicitante verificar si existe

        try {
            $contadorRegistro = ModelsTramiteusuario::where('NUM_SOLICITUD', DB::raw("'" . $numSolicitud . "'"))
                ->where('ID_TRAMITE', DB::raw("'" . $idTramite . "'"))
                ->count();
            print_r($contadorRegistro);
            echo $contadorRegistro;
        } catch (\Exception $e) {
            DB::rollback();
            return '|0| 3.1.0 Problema al indentificar la cantidad de solicitudes realizada [TRAM_USU] <br> ' . $e->getMessage();
        }


        // 4.1 Se asegura que la variable tenga un valor en $emailapoderado
        $nombrecompleto = $primerNombre . ' ' . $segundoNombre . ' ' . $primerApellido  . ' ' . $segundoApellido;
        $dato = ModelsTramiteusuario::where('num_solicitud', $numSolicitud)->first();
        $apoderado = $dato->primernombreapoderado . ' ' . $dato->segundonombreapoderado . ' ' . $dato->primerapellidoapoderado  . ' ' . $dato->segundoapellidoapoderado;
        $asuntos = Subdescripcion::where('subasu_id', $dato->subasunto)
            ->where('sis_esta_id', 1)
            ->orderBy('id')
            ->get();
        
            $correos=ConciReferente::where('correo', 1)
            ->get();
            $correosactivos=[];
            foreach ($correos as $activo) {
                $correosactivos[] = $activo->email;
            }


        trim($emailApoderado);
        $data['emailApoderado'] = $emailApoderado;

        if ($contadorRegistro >= 1) {
            try {
                $subject = 'Solicitud conciliaciones Web  - Personería de Bogotá D.C.';
                $data = array(
                    'email' => $email,
                    'asuntos' => $asuntos,
                    'nombrecompleto' => $nombrecompleto,
                    'subject' => $subject,
                    'tiposolicitud' => $dato->tiposolicitud,
                    'numSolicitud' => $numSolicitud,
                    'fechaRegistro' => explode(' ',$fechaRegistroA)[0],
                    'llaveingreso' => $code,
                    'emailApoderado' => $data['emailApoderado'],
                    'apoderado' => $apoderado,
                    'correosactivos' => $correosactivos
                );

                //Usuario asignado puede tener la opcion copia de correo activo, sin importar el estado que se encuentre



                Mail::send('frmWeb.email.registroSolicitudnew', $data, function ($message) use ($data) {
                    $message->from('master@personeriabogota.gov.co', 'Solicitud conciliaciones Web - Personería de Bogotá D.C.');
                    $message->to($data['email']);
                    if (isset($data['emailApoderado']) && !empty($data['emailApoderado'])) {
                        $message->cc($data['emailApoderado']);
                    }
                    // $message->bcc('jaruedag@personeriabogota.gov.co');
                    // $message->bcc('jamumi14@gmail.com');
                    foreach ($data['correosactivos'] as $key => $enviar) {
                        $message->bcc($enviar);
                    }
   
                  
                    $message->subject($data['subject']);
                });
            } catch (\Exception $e) {
                return '|0| 4.0) Problema al enviar el correo de confirmacion: </br>' . $e->getMessage();
            }
            DB::commit();
        } else {
            return '|0| 4.0) No es posible enviar el correo electronico ya que no se registraron los datos en el sistema </br>';
        }

        DB::commit();
        //return '|1|El registro finalizo de forma correcta <br> su numero de solicitud es: <strong>' . $numSolicitud . '</strong> <br> Por favor verifique su correo electronico para mas información.';
        return '|1|Señor usuario, <br> Su número de solicitud es <strong>' . $numSolicitud . '.</strong> <br> Se informa que se ha enviado un mensaje a la dirección de correo 
        electrónico que proporcionó en la <strong>solicitud de conciliación</strong> en línea, el cual contiene las instrucciones para adjuntar los soportes correspondientes, teniendo en cuenta la temática que seleccionó y de esta forma finalizar este proceso..';
    }

    // Retornar vista con información del funcionario a atualizar
    public function actualizarDato(Request $request)
    {
        $numSolicitud = $request->input("num_solicitud");
        //0) Verificar que caso exista y con estado 1 de actualización
        ddd($numSolicitud);
        try {
            $contadorSolicitudActualizar = ModelsTramiteusuario::where('NUM_SOLICITUD', 37)
                ->where('ID_TRAMITE', 330)
                ->where('NUMERO10', 1)
                ->count();
        } catch (\Exception $e) {
            DB::rollback();
            return ((string)\View::make("frmWeb.pagina404"));
            //return '|0| 0.1) Problema al verificar el estado de la solicitud'.$e->getMessage();
        }

        if ($contadorSolicitudActualizar == 0) {
            DB::rollback();
            return ((string)\View::make("frmWeb.pagina404"));
            //return '|0| 0.1) En este momento no se requiere actualizar ninguna información.';
        } else {
            //1) Extraer infromacion registrada por el funcionario al solicitante
            try {
                $detalleSolicitud = DB::table('ETAPA_ACTUACION_DOCUMENTO')
                    ->where('NUM_SOLICITUD', $numSolicitud)
                    ->where('ACTUAC_CODIGO', 2588)
                    ->orderBy('CONSECUTIVO', 'desc')
                    ->first();

                $nombreDocumento = $detalleSolicitud->nombre_documento;
                $fechaRegistro = $detalleSolicitud->fecha_registro;
            } catch (\Exception $e) {
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
            } catch (\Exception $e) {
                DB::rollback();
                return '|0| 0.0) Problema al anexar el soporte en el sistema </br>' . $e->getMessage();
            }
        } else if (!empty($request->file("document1"))) {
            try {
                $document1 = $request->file("document1");
                $nombreOriginalFile = $request->file("document1")->getClientOriginalName();
                $rutaFinalFile = Storage::disk('local')->put("", $document1);
            } catch (\Exception $e) {
                DB::rollback();
                return '|0| 0.0) Problema al anexar el soporte en el sistema' . $e->getMessage();
            }
        } else if ($request->input("detalle") != '') {
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
        } catch (\Exception $e) {
            DB::rollback();
            return '|0| 1.0) Problema al extraer el consecutivo TRAMITERESPUESTA ' . $e->getMessage();
        }

        //1.1) Estrael el consecutivo de la lista de docuemntos
        try {
            $contadorSolicitudActualizar = DB::table('ETAPA_ACTUACION_DOCUMENTO')
                ->where('TRARES_CONSECUTIVO', $consecutivo)
                ->count();
            $contadorSolicitudActualizar = $contadorSolicitudActualizar + 1;
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
            DB::rollback();
            return '|0| 1.0) Problema al extraer los datos del funcionario TRAMITEUSUARIO ' . $e->getMessage();
        }

        try {
            $datosFunc = DB::table('USUARIO_ROL')
                ->where('CEDULA', DB::raw("'" . $ccUsr . "'"))
                ->first();
            $consecUSr = $datosFunc->consec;
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
            DB::rollback();
            return '|0| 1.2) Problema al Insertar la informacion al sistema ETAPA_ACTUACION_DOCUMENTO ' . $e->getMessage();
        }

        // 1.4) EXTRAER CONSECUTIVO DE EXPEDEINTE DIGITAL
        try {
            $consecutivoSinproc = DB::table('EXPEDIENTE_DIGITAL')->max('CONSECUTIVO_EXPEDIENTE');
            $consecutivoSinproc = $consecutivoSinproc + 1;
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
            DB::rollback();
            return '|0| 0.2) Problema al actualizar el numero asignado por el sistema' . $e->getMessage();
        }

        DB::commit();
        return '|1|El registro finalizó de forma correcta. <br> La información registrada será validada al interior de la Personería de Bogotá';
    }
    //Descargar archivo word
    public function descargaWord()
    {
        $test=ConciDocumento::orderBy('id', 'DESC')->first();
        
       
        return Storage::download($test->rutafinalfile);
    }


//Funcion de consulta de solicitud
    public function autosearch(Request $request)
    {
        if ($request->ajax()) {
           
            $data = ModelsTramiteusuario::where('num_solicitud', $request->num_solicitud)->where('CODE', $request->codigo)->first();
            
            //se verifica el estado de documento
            $output = '';
            if ($data) {
                if($data->estadodoc==''){
                    
                
                $output = '<br><div class="row justify-content-md-center">';
          
                    $id = $data->num_solicitud;
                    $output .= '<div class="col-md-4">
                    
                    <a class="btn btn-outline-secondary" data-bs-toggle="modal" id="mediumButton" data-target="#mediumModal" data-attr="' . route('desistir', ['id' => $id]) . '" > Desistimiento del proceso    <i class="fa-regular fa-file-excel"></i></a>
                    </div>
                    <div class="col-md-4">
                    <a href="' . route('adjuntar', ['id' => $id]) . '" class="btn btn-outline-success">Adjuntar Documentos  <i class="fas fa-folder-plus"></i></a> 
                    </div>
                    ';
              
                $output .= '</div>';
                //Validacion de estado "adjunto", devuelve mensaje y no deja ingresar al formulario de adjuntos
            } else if($data->estadodoc=='adjunto') {
             
                $output .= '<br><p style="width:90%;margin:auto;" class="alert alert-success"><i class="fa-regular fa-circle-check fa-2xl"></i>' . '<span style="padding:8px;font-size: 1.2rem;"> El proceso de adjuntar documentos finalizó el día '.date("d-m-Y", strtotime($data->updated_at)) . '</span></p>';
                //Validacion de estado "Cancelado", devuelve mensaje y no deja ingresar al formulario de adjuntos
            }else if($data->estadodoc=='Cancelado') {
                $output .= '<br><p style="width:90%;margin:auto;" class="alert alert-warning"><i class="fa-solid fa-triangle-exclamation fa-2xl"></i>' . '<span style="padding:8px;font-size: 1.2rem;"> Se realizo desistimiento a la Solicitud de Conciliación ' . '</span></p>';
            }
            return $output;
        }else{
            $output .= '<br><p style="width:90%;margin:auto;" class="alert alert-warning"> <i class="fa-solid fa-triangle-exclamation fa-2xl"></i>' . '<span style="padding:8px;font-size: 1.2rem;">  No se encuentra información' . ' </span>   </p>';
            return $output;
        }
    }
        return view('frmWeb.autosearch');
    }
 //Metodo para la vista del formulario adjunts
    public function adjuntararchivos($id)
    {

        //Cargo de los datos de solicitud
        $dato = ModelsTramiteusuario::where('num_solicitud', $id)->first();
        $tipodedocumento=Parametro::where('id', $dato->tipodocumento)->first()->nombre;
        $tiposolicitud= $dato->tiposolicitud;
        $nombrecompleto = $dato->primernombre . ' ' . $dato->segundonombre . ' ' . $dato->primerapellido  . ' ' . $dato->segundoapellido;
        $fecha = $dato->fec_solicitud_tramite;
        $newDate = date("d-m-Y", strtotime($fecha));  
        
        $tiposolicitud= $dato->tiposolicitud;
        $tipodedocapoderado='';
        if($tiposolicitud==1){
            $tipodedocapoderado=Parametro::where('id', $dato->tipodocapoderado)->first()->nombre;
        }
        $nombrecompleto = $dato->primernombre . ' ' . $dato->segundonombre . ' ' . $dato->primerapellido  . ' ' . $dato->segundoapellido;
        $apoderado = $dato->primernombreapoderado . ' ' . $dato->segundonombreapoderado . ' ' . $dato->primerapellidoapoderado  . ' ' . $dato->segundoapellidoapoderado;

        $numero=number_format($dato->cuantia,0,'.','.');
        $detalleAbc = Subdescripcion::where('subasu_id', $dato->subasunto)
            ->where('sis_esta_id', 1)
            ->orderBy('id')
            ->get();
        $convocates = Convocante::where('num_solicitud', $id)
            ->orderBy('id')
            ->get();
            
        //INFORMACION RETORNADA EN LA VISTA
        //$conteo= count($detalleAbc)-1;

        $data = array(
            "detalleAbc" => $detalleAbc,
            "convocates" => $convocates
        );
        return view('frmWeb.card.adjuntar', compact('dato', 'data', 'nombrecompleto','tiposolicitud','numero','newDate','tipodedocumento','apoderado','tipodedocapoderado'));

    }




 //Modal de desestimiento   
    public function Desistir($id)
    {
        $dato = ModelsTramiteusuario::where('num_solicitud', $id)->first();
        $newDate = date("d-m-Y", strtotime($dato->fec_solicitud_tramite));  
        return view('frmWeb.card.desistimiento', compact('dato','id','newDate'));
    }


//Funcion para el cambio de estado de la conciliacion
    public function Cambioestado(Request $request, $id)
    {
        $detalle = $request->input("desistir");
        
        $dato = ModelsTramiteusuario::where('num_solicitud', $id)->first();
        $fecha = $dato->fec_solicitud_tramite;
        $newDate = date("d-m-Y", strtotime($fecha));  
        $nombrecompleto = $dato->primernombre . ' ' . $dato->segundonombre . ' ' . $dato->primerapellido  . ' ' . $dato->segundoapellido;
        $modelo = ModelsTramiteusuario::where('num_solicitud', $id)->update(['estado_tramite' => $detalle,'estadodoc'=>'Cancelado']);
        if ($detalle == 'Cancelado') {

  
            $apoderado = $dato->primernombreapoderado . ' ' . $dato->segundonombreapoderado . ' ' . $dato->primerapellidoapoderado  . ' ' . $dato->segundoapellidoapoderado;
            
            $detalleAbc = Subdescripcion::where('subasu_id', $dato->subasunto)
                ->where('sis_esta_id', 1)
                ->orderBy('id')
                ->get();
    
        
    
            //Correo de confirmación de desistimiento
            $conteo= count($detalleAbc)-1;
            try {
                $subject = 'Solicitud conciliaciones Web  - Personería de Bogotá D.C.';
                $data = array(
                    'email' => $dato->email,
                    'asuntos' => $dato->asuntos->nombre,
                    'nombrecompleto' => $nombrecompleto,
                    'subject' => $subject,
                    'numSolicitud' => $id,
                    'emailApoderado' => $dato->emailapoderado,
                    'apoderado' => $apoderado,
                    'fechaRegistro' => explode(' ',$fecha)[0],
                    'newDate' => $newDate,
                );
    
                Mail::send('frmWeb.email.desistir', $data, function ($message) use ($data) {
                    $message->from('master@personeriabogota.gov.co', 'Solicitud conciliaciones Web - Personería de Bogotá D.C.');
                    $message->to($data['email']);
                    if (isset($data['emailApoderado']) && !empty($data['emailApoderado'])) {
                        $message->cc($data['emailApoderado']);
                    }
                    // $message->bcc('jaruedag@personeriabogota.gov.co');
                    // $message->bcc('jamumi14@gmail.com');
                   // $message->attach('FORMATO_SOLICITUD_DE_CONCILIACION_V4');
                    // $message->bcc('ljmeza@personeriabogota.gov.co');
                    // $message->bcc('nylopez@personeriabogota.gov.co');
                    // $message->bcc('asarmiento@personeriabogota.gov.co');
                    $message->subject($data['subject']);
                });
            } catch (\Exception $e) {
                return '|0| 3.0) Problema al enviar el correo de confirmacion: </br>' . $e->getMessage();
            }


            //return redirect('https://www.personeriabogota.gov.co/');
            return '|1|Se confirma el Desistimiento a la Solicitud de Conciliación vía WEB No. <b> '.$id.'</b> registrada el día '.explode(' ',$fecha)[0];
        } else {
            return '|0| 3.0) test: </br>';
        }
    }


//Funcion de carga de documentos
    public function CargaArchivos(Request $request, $id)
    {
        //Se carga los datos del formulario 
        $dato = ModelsTramiteusuario::where('num_solicitud', $id)->first();
        //Se realiza validacion por request

        $input_data = $request->all();

        $validator = Validator::make(
            $input_data,
            [
                'document1.*' => 'required|max:10000'
                ],[
                    'document1.*.required' => 'Ingrese el documento',
                    'document1.*.max' => 'El tamaño permitido es de 10MB',
                ]
       
        );


        $detalleAbc = Subdescripcion::where('subasu_id', $dato->subasunto)
        ->where('sis_esta_id', 1)
        ->orderBy('id')
        ->get();
    //INFORMACION RETORNADA EN LA VISTA
    //$conteo= count($detalleAbc)-1;

             $descripcion = [];
             foreach ($detalleAbc as $key => $file) {
                $descripcion[] = $file->descripcion->nombre;
            
                // $nombreOriginalFile = $value->getClientOriginalName();
                // $rutaFinalFile = Storage::disk('local')->put("", $value);
            }
            
            $descripcion[] = 'Documentos que complementen su solicitud';
            if($dato->tiposolicitud==1){
                $descripcion[] = 'Poder especial para conciliar dirigido al centro de conciliación de la personería de Bogota D.C.';
            }
           

            //Validacion de datos recibidos por request
        if ($validator->fails()) {
            $messages = $validator->messages();
     
            return Redirect::back()->withErrors($validator);
        }

        //Carga de adjuntos
        try {
            $files = [];
            foreach ($request->file("document1") as $key => $file) {
 
               // $rutaFinalFile = Storage::put($id, $file);
          
      
                $files[]['name'] = $descripcion[$key];
                //estructura de nombre de archivo id -- nombreoriginal
                $nombreOriginalFile = $file->getClientOriginalName();
                $filePath = $file->storeAs('Documentos/'.$id, $nombreOriginalFile);
                $rutaFinalFile =$file->getRealPath();
                //echo $rutaFinalFile;
                
                $ddd = Soportecon::create(['NUM_SOLICITUD' => $id, 'descripcion' => $descripcion[$key], 'rutaFinalFile' => $filePath, 'nombreOriginalFile' =>$id.'--'. $nombreOriginalFile]);
  
            }

            
           
        } catch (\Exception $e) {
            DB::rollback();
            return '|0| 0.2) Problema al actualizar el numero asignado por el sistema' . $e->getMessage();
        }
        $solicitud = ModelsTramiteusuario::where('num_solicitud', $id)->update([
            'estadodoc' => 'adjunto'
         ]);
     


     
        $dato->fec_solicitud_tramite;
        $fecha = $dato->fec_solicitud_tramite;
        $newDate = date("d-m-Y", strtotime($fecha));  
        $nombrecompleto = $dato->primernombre . ' ' . $dato->segundonombre . ' ' . $dato->primerapellido  . ' ' . $dato->segundoapellido;
        $apoderado = $dato->primernombreapoderado . ' ' . $dato->segundonombreapoderado . ' ' . $dato->primerapellidoapoderado  . ' ' . $dato->segundoapellidoapoderado;
        $fechaRegistro = new DateTime(Carbon::now());
        
        $fechaRegistro = $fechaRegistro->setTimezone(new DateTimeZone('America/Bogota'));
        $fechaRegistro = $fechaRegistro->format("d/m/Y h:m:s");
        
        $detalleAbc = Subdescripcion::where('subasu_id', $dato->subasunto)
            ->where('sis_esta_id', 1)
            ->orderBy('id')
            ->get();

        

        //Envio de correo confirmando la subida de los datos adjuntos
        $conteo= count($detalleAbc)-1;
        try {
            $subject = 'Solicitud conciliaciones Web  - Personería de Bogotá D.C.';
            $data = array(
                'email' => $dato->email,
                'asuntos' => $dato->asuntos->nombre,
                'nombrecompleto' => $nombrecompleto,
                'subject' => $subject,
                'numSolicitud' => $id,
                'emailApoderado' => $dato->emailapoderado,
                'apoderado' => $apoderado,
                'fechaRegistro' =>$fechaRegistro,
            );

            Mail::send('frmWeb.email.adjuntoarchivo', $data, function ($message) use ($data) {
                $message->from('master@personeriabogota.gov.co', 'Solicitud conciliaciones Web - Personería de Bogotá D.C.');
                $message->to($data['email']);
                if (isset($data['emailApoderado']) && !empty($data['emailApoderado'])) {
                    $message->cc($data['emailApoderado']);
                }
                // $message->bcc('jaruedag@personeriabogota.gov.co');
                // $message->bcc('jamumi14@gmail.com');
                $message->subject($data['subject']);
            });
        } catch (\Exception $e) {
            return '|0| 3.0) Problema al enviar el correo de confirmacion: </br>' . $e->getMessage();
        }
        //Mensaje de comprobacion de registro de los datos adjuntos
        return '|1|Con él envió de los soportes se da por finalizado el Registro de la Solicitud de Conciliación WEB No. <b> '.$id.'</b> del '.$newDate.'. 
        La información relacionada y sus anexos serán revisados por los funcionarios al interior de la Personería de Bogotá D.C., quienes próximamente lo contactarán por medio de los correos electrónicos registrados';
        
        DB::commit();
        


        
    }

    public function validateEmail(Request $request)
    {
        $email = $request->input('email');
        
        $user = ConciCorreoinv::where('email', $email)->first();

        if ($user) {
            return response()->json(['exists' => true,
                                    'valor' => true]);
        }

        return response()->json(['exists' => false,
        'valor' => false]);
    }


  
}

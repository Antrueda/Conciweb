<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Convocante;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Soportecon;
use App\Models\Subdescripcion;
//Models
Use App\Models\Tramite;
use App\Models\Tramiterespuesta;
use App\Models\Tramiteusuario;
use Carbon\Carbon;
use Dompdf\Dompdf;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\View;

use function PHPUnit\Framework\isNull;

class DocumentsController extends Controller
{



    public function index()
    {
        $documentos = Soportecon::all();
        return response()->json($documentos);
    }

//Metodo post
    public function getSoporte(Request $request){


        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:conci_soportecons,id',
        ]);
 
        if ($validator->fails()) {
            return response([
                'message' => 'El SINPROC ingresado no existe',
            ], 400);
        }
 
        // api post...
        $validated = $validator->validated();
        $tramite = Soportecon::where('id', $validated['id'])->firstOrFail();
        if($tramite->rutafinalfile != null){
            return response()->download(Storage::path($tramite->rutafinalfile));
        } else{
            return response([
                'message' => 'sinproc existe pero NO TIENE ADJUNTO SDP',
            ], 404);
        }
    }

//Primer test de documentos
    public function getDocuments($id,$vigencia){

      // trae la información del documento...
          $tramite = Soportecon::where('num_solicitud', $id)->get();
    
          $dato = Tramiteusuario::where('num_solicitud', $id)->where('vigencia',$vigencia)->first();
          $fecha = Tramiteusuario::where('num_solicitud', $id)->where('vigencia',$vigencia)->first()->fec_solicitud_tramite;
          $newDate = Carbon::parse($fecha)->format('d/m/Y H:i:s');  
          $tipodedocumento=Parametro::where('id', $dato->tipodocumento)->first()->nombre;
                 
          $tiposolicitud= $dato->tiposolicitud;
          $tipodedocapoderado='';
          if($tiposolicitud==1){
              $tipodedocapoderado=Parametro::where('id', $dato->tipodocapoderado)->first()->nombre;
          }
        $nombrecompleto = $dato->primernombre . ' ' . $dato->segundonombre . ' ' . $dato->primerapellido  . ' ' . $dato->segundoapellido;
          $apoderado = $dato->primernombreapoderado . ' ' . $dato->segundonombreapoderado . ' ' . $dato->primerapellidoapoderado  . ' ' . $dato->segundoapellidoapoderado;

          $convocates = Convocante::where('num_solicitud', $id)
          ->orderBy('id')
          ->get();
          $numero=number_format($dato->cuantia,0,'.','.');
          $detalleAbc = Subdescripcion::where('subasu_id', $dato->subasunto)
              ->where('sis_esta_id', 1)
              ->orderBy('id')
              ->get();
          //INFORMACION RETORNADA EN LA VISTA
          //$conteo= count($detalleAbc)-1;
  
          $data = array(
              "detalleAbc" => $detalleAbc,
              "convocates" => $convocates
          );
      
        if(!$tramite->isEmpty()){
            return view('archivos', compact('tramite','dato', 'data', 'nombrecompleto','tiposolicitud','numero','newDate','tipodedocumento','tipodedocapoderado','apoderado'));
         
        } else{
            return view('administracion.incompleto',compact('tramite','dato', 'data', 'nombrecompleto','tiposolicitud','numero','newDate','tipodedocumento','tipodedocapoderado','apoderado'));
        }
    }


    public function modalValidacion($id,Request $request){
        //dd($id);
        $solicitud=$id;
        
        if ($request->ajax()) {
           
            $data = Tramiteusuario::where('num_solicitud', $request->num_solicitud)->where('CODE', $request->codigo)->first();
            
            //se verifica el estado de documento
            $output = '';
            if ($data) {
           if($data->estadodoc=='Finalizado Adjuntos') {
            $output = '<br><div class="row justify-content-md-center">';
                $output .= '            <div class="col-md-4">
                <a href="' . route('getDocumentsUsuario', ['id' => $solicitud,$data->vigencia]) . '" class="btn btn-outline-success pt-2">Ver Documentos  <i class="fas fa-folder-plus ms-2"></i></a>         </div>';
              
                //Validacion de estado "Cancelado", devuelve mensaje y no deja ingresar al formulario de adjuntos
            }else  {
                $output .= '<br><p style="width:90%;margin:auto;" class="alert alert-warning"><i class="fa-solid fa-triangle-exclamation fa-2xl"></i>' . '<span style="padding:8px;font-size: 1.2rem;"> La información digitada no es valida ' . '</span></p>';
            }
            return $output;
        }else{
            $output .= '<br><p style="width:90%;margin:auto;" class="alert alert-warning"> <i class="fa-solid fa-triangle-exclamation fa-2xl"></i>' . '<span style="padding:8px;font-size: 1.2rem;">  No se encuentra información' . ' </span>   </p>';
            return $output;
        }
    }
        return view('Api.modalvalidar', compact('solicitud'));
    }
        

    

    public function getDocumentsUsuario($id,$vigencia){

        // trae la información del documento...
            $tramite = Soportecon::where('num_solicitud', $id)->where('vigencia',$vigencia)->get();
      
            $dato = Tramiteusuario::where('num_solicitud', $id)->where('vigencia',$vigencia)->first();
            $fecha = Tramiteusuario::where('num_solicitud', $id)->where('vigencia',$vigencia)->first()->fec_solicitud_tramite;
            $newDate = Carbon::parse($fecha)->format('d/m/Y H:i:s');  
            $tipodedocumento=Parametro::where('id', $dato->tipodocumento)->first()->nombre;
                   
            $tiposolicitud= $dato->tiposolicitud;
            $tipodedocapoderado='';
            if($tiposolicitud==1){
                $tipodedocapoderado=Parametro::where('id', $dato->tipodocapoderado)->first()->nombre;
            }
          $nombrecompleto = $dato->primernombre . ' ' . $dato->segundonombre . ' ' . $dato->primerapellido  . ' ' . $dato->segundoapellido;
            $apoderado = $dato->primernombreapoderado . ' ' . $dato->segundonombreapoderado . ' ' . $dato->primerapellidoapoderado  . ' ' . $dato->segundoapellidoapoderado;
  
            $convocates = Convocante::where('num_solicitud', $id)
            ->orderBy('id')
            ->get();
            $numero=number_format($dato->cuantia,0,'.','.');
            $detalleAbc = Subdescripcion::where('subasu_id', $dato->subasunto)
                ->where('sis_esta_id', 1)
                ->orderBy('id')
                ->get();
            //INFORMACION RETORNADA EN LA VISTA
            //$conteo= count($detalleAbc)-1;
    
            $data = array(
                "detalleAbc" => $detalleAbc,
                "convocates" => $convocates
            );
        
          if(!$tramite->isEmpty()){
              return view('archivosuser', compact('tramite','dato', 'data', 'nombrecompleto','tiposolicitud','numero','newDate','tipodedocumento','tipodedocapoderado','apoderado'));
           
          } else{
              return view('administracion.sinpermisos',compact('tramite','dato', 'data', 'nombrecompleto','tiposolicitud','numero','newDate','tipodedocumento','tipodedocapoderado','apoderado'));
          }
      }


    public function imprimir($id,$vigencia)
    {
        //traer informacion de administracion formato pdf certifivados
        $tramite = Soportecon::where('num_solicitud', $id)->where('vigencia',$vigencia)->get();
        $dato = Tramiteusuario::where('num_solicitud', $id)->where('vigencia',$vigencia)->first();
        $fecha = Tramiteusuario::where('num_solicitud', $id)->first()->fec_solicitud_tramite;
        $newDate = Carbon::parse($fecha)->format('d/m/Y H:i:s'); 
        $tipodedocumento=Parametro::where('id', $dato->tipodocumento)->first()->nombre;
        $fechaactual=Carbon::now();   
        $nuevafecha = now();
        $nuevafecha=Carbon::parse($nuevafecha)->format('H:i:s A');
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($fechaactual);
        
        $mes = $meses[($fecha->format('n')) - 1];
        $fechaactual= $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y').' - '. $nuevafecha;   
        $tiposolicitud= $dato->tiposolicitud;
        $tipodedocapoderado='';
        if($tiposolicitud==1){
            $tipodedocapoderado=Parametro::where('id', $dato->tipodocapoderado)->first()->nombre;
        }
      $nombrecompleto = $dato->primernombre . ' ' . $dato->segundonombre . ' ' . $dato->primerapellido  . ' ' . $dato->segundoapellido;
        $apoderado = $dato->primernombreapoderado . ' ' . $dato->segundonombreapoderado . ' ' . $dato->primerapellidoapoderado  . ' ' . $dato->segundoapellidoapoderado;

        $convocates = Convocante::where('num_solicitud', $id)
        ->orderBy('id')
        ->get();
        $numero=number_format($dato->cuantia,0,'.','.');
        $detalleAbc = Subdescripcion::where('subasu_id', $dato->subasunto)
            ->where('sis_esta_id', 1)
            ->orderBy('id')
            ->get();
        //INFORMACION RETORNADA EN LA VISTA
        //$conteo= count($detalleAbc)-1;

        $data = array(
            "detalleAbc" => $detalleAbc,
            "convocates" => $convocates,
            "nombrecompleto" => $nombrecompleto,
            "apoderado" => $apoderado,
            "tiposolicitud" => $tiposolicitud,
            "tipodedocumento" => $tipodedocumento,
            "dato" => $dato,
            "newDate" => $newDate,
            "numero" => $numero,
            "tramite" => $tramite,
            "fechaactual" => $fechaactual,
            "tipodedocapoderado" => $tipodedocapoderado,
        );
        // dd($data);

        $context = stream_context_create(array(
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ));

        $pdf = new Dompdf();
        $pdf->setHttpContext($context);
        $options = $pdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $options->setIsPhpEnabled(true);
        $pdf->setOptions($options);

        $pdf->loadHtml(View::make('ordinario', ['data' => $data])->render());
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'archivo.pdf');
    }


    //API Funcional, cargue de datos de la solicitud e ingreso por un token(key)
    public function getDocumentos(){

        $key = urldecode($_GET['key']);
        $key = str_replace(" ", "+", $key);
        $acceso = $this->data($key);
    
       
        // trae la información del documento...
          $tramite = Soportecon::where('num_solicitud', $acceso[3])->where('vigencia',$acceso[4])->get();
          
          $dato = Tramiteusuario::where('num_solicitud', $acceso[3])->where('vigencia',$acceso[4])->first();
          $fecha = Tramiteusuario::where('num_solicitud', $acceso[3])->first()->fec_solicitud_tramite;
          $newDate =    $newDate = Carbon::parse($fecha)->format('d/m/Y H:i:s'); 
          $tipodedocumento=Parametro::where('id', $dato->tipodocumento)->first()->nombre;
                 
          $tiposolicitud= $dato->tiposolicitud;
          $tipodedocapoderado='';
          if($tiposolicitud==1){
              $tipodedocapoderado=Parametro::where('id', $dato->tipodocapoderado)->first()->nombre;
          }
        $nombrecompleto = $dato->primernombre . ' ' . $dato->segundonombre . ' ' . $dato->primerapellido  . ' ' . $dato->segundoapellido;
          $apoderado = $dato->primernombreapoderado . ' ' . $dato->segundonombreapoderado . ' ' . $dato->primerapellidoapoderado  . ' ' . $dato->segundoapellidoapoderado;

          $convocates = Convocante::where('num_solicitud', $acceso[3])
          ->orderBy('id')
          ->get();
          $numero=number_format($dato->cuantia,0,'.','.');
          $detalleAbc = Subdescripcion::where('subasu_id', $dato->subasunto)
              ->where('sis_esta_id', 1)
              ->orderBy('id')
              ->get();
          //INFORMACION RETORNADA EN LA VISTA
          //$conteo= count($detalleAbc)-1;
  
          $data = array(
              "detalleAbc" => $detalleAbc,
              "convocates" => $convocates
          );
      
        if(!$tramite->isEmpty()){
            return view('archivos', compact('tramite','dato', 'data', 'nombrecompleto','tiposolicitud','numero','newDate','tipodedocumento','tipodedocapoderado','apoderado'));
         
        } else{
            return view('administracion.incompleto',compact('tramite','dato', 'data', 'nombrecompleto','tiposolicitud','numero','newDate','tipodedocumento','tipodedocapoderado','apoderado'));
        }
    }

    public function sinpermisos()
    {
        
        return view('administracion.sinpermisos');
    }

    public function incompleto()
    {

        return view('administracion.incompleto');
    }

    public function Soportetic()
    {

        return view('administracion.soportetic');
    }


        // public function descargar($id)
        // {
        //     $archivo = Soportecon::where('id', $id)->first();

        //     // Lógica adicional si es necesario (por ejemplo, validar permisos, comprobar existencia de archivo, etc.)

        //     return response()->download(Storage::path($archivo->rutafinalfile));
        // }
    //Descargue de documento
        public function download($id)
        {
            $documento = Soportecon::findOrFail($id);
            
            if (Storage::fileExists($documento->rutafinalfile)) {
                // Genera el encabezado para forzar la descarga del archivo
   
                return Storage::download($documento->rutafinalfile);
            } else 
            if (Storage::disk('public')->exists($documento->rutafinalfile)) {
                // Maneja el caso en el que el archivo no existe
        
                return response()->download(storage_path('app/public/' . $documento->rutafinalfile));
            } else 
            if (!isNull($documento->rutastorage)||Storage::disk('public')->exists($documento->rutastorage)) {
        
                // Maneja el caso en el que el archivo no existe
                return response()->download(storage_path('app/public/' . $documento->rutastorage));
             
            }else{
                return view('administracion.soportetic',compact('documento'));
            }

        }
    
        // public function show($id)
        // {
        //     $client = new Client([
        //         'base_uri' => 'http://concil',
        //     ]);
    
        //     $headers['Authorization'] = '3ctQPJC3OHuKj9GzmhRx7pqV6lD3I310';
    
    
        //     $response = $client->request('GET', '/api/documentos/17/download', ['form_params' => [], 'headers' => $headers]);
            
        //     return $response;
          
        // }

        //return response()->json($tramite);



        public function data($key)
        {
            //Configuración del algoritmo de encriptación
            //Esta cadena, debe ser larga y unica nadie mas debe conocerla. Fue la cadea empleda en la encripción por lo tanto no se puede variar
            $clave = 'Modelo de encriptación de los datos requeridos de SINPROC para consultarlos en otros módulos misionales de la Personería de Bogotá D.C. ';
            $clave .= 'Fuente Dirección TIC';
            //Metodo de encriptación
            $method = 'aes-256-cbc';
            // Puedes generar una diferente usando la funcion $getIV()
            $iv = "_@_C9fBxl1EWtYjL";
            /*
    
            
         Desencripta el texto recibido
         */
            $desencriptar = function ($valor) use ($method, $clave, $iv) {
                $encrypted_data = base64_decode($valor);
                return openssl_decrypt($valor, $method, $clave, 0, $iv);
            };
            $encriptar = function ($valor) use ($method, $clave, $iv) {
                return @openssl_encrypt($valor, $method, $clave, 0, $iv);
            };
    
            $dato_desencriptado = $desencriptar($key);
            $data = explode("_@@_", $dato_desencriptado);
    
    
            return $data;
        }



    


    
}

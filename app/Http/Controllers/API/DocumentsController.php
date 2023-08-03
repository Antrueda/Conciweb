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
use Dompdf\Dompdf;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\View;

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
    public function getDocuments($id){

      // trae la información del documento...
          $tramite = Soportecon::where('num_solicitud', $id)->get();
          
          $dato = Tramiteusuario::where('num_solicitud', $id)->where('vigencia',2023)->first();
          $fecha = Tramiteusuario::where('num_solicitud', $id)->first()->fec_solicitud_tramite;
          $newDate = date("d-m-Y", strtotime($fecha));  
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


    public function imprimir($id)
    {
        //traer informacion de administracion formato pdf certifivados
        $tramite = Soportecon::where('num_solicitud', $id)->get();
        $dato = Tramiteusuario::where('num_solicitud', $id)->where('vigencia',2023)->first();
        $fecha = Tramiteusuario::where('num_solicitud', $id)->first()->fec_solicitud_tramite;
        $newDate = date("d-m-Y", strtotime($fecha));  
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
            "convocates" => $convocates,
            "nombrecompleto" => $nombrecompleto,
            "apoderado" => $apoderado,
            "tiposolicitud" => $tiposolicitud,
            "tipodedocumento" => $tipodedocumento,
            "dato" => $dato,
            "newDate" => $newDate,
            "numero" => $numero,
            "tramite" => $tramite,
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
          $tramite = Soportecon::where('num_solicitud', $acceso[3])->get();
          
          $dato = Tramiteusuario::where('num_solicitud', $acceso[3])->where('vigencia',$acceso[4])->first();
          $fecha = Tramiteusuario::where('num_solicitud', $acceso[3])->first()->fec_solicitud_tramite;
          $newDate = date("d-m-Y", strtotime($fecha));  
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
    
            return Storage::download($documento->rutafinalfile);
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

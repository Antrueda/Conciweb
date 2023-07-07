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
use GuzzleHttp\Client;

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
 
        // Retrieve the validated input...
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

//Primer test
    public function getDocuments(Request $request){

        $validator = Validator::make($request->all(), [
            'num_solicitud' => 'required|numeric|exists:conci_soportecons,num_solicitud',
        ]);
 
        if ($validator->fails()) {
            return response([
                'message' => 'El SINPROC ingresado no existe',
            ], 400);
        }
 
        // Retrieve the validated input...
        $validated = $validator->validated();
        $tramite = Soportecon::where('num_solicitud', $validated['num_solicitud'])->get();

        if($tramite != null){
            //return view('archivos', compact('tramite'));
            return response()->json($tramite);
        } else{
            return response([
                'message' => 'sinproc existe pero NO TIENE ADJUNTO SDP',
            ], 404);
        }
    }


    //API Funcional
    public function getDocumentos(){

        //
        $key = base64_decode($_GET['key']);
        $acceso = $this->data($key);
        //dd($acceso);
        // Retrieve the validated input...
          $tramite = Soportecon::where('num_solicitud', $acceso[3])->get();
          $dato = Tramiteusuario::where('num_solicitud', $acceso[3])->where('vigencia',$acceso[4])->first();
          $fecha = Tramiteusuario::where('num_solicitud', $acceso[3])->first()->fec_solicitud_tramite;
          $newDate = date("d-m-Y", strtotime($fecha));  
          $tipodedocumento=Parametro::where('id', $dato->tipodocumento)->first()->nombre;
          $tipodedocapoderado=Parametro::where('id', $dato->tipodocapoderado)->first()->nombre;
          $tiposolicitud= $dato->tiposolicitud;
          //dd( $tiposolicitud);
          $nombrecompleto = $dato->primernombre . ' ' . $dato->segundonombre . ' ' . $dato->primerapellido  . ' ' . $dato->segundoapellido;
          $apoderado = $dato->primernombreapoderado . ' ' . $dato->segundonombreapoderado . ' ' . $dato->primerapellidoapoderado  . ' ' . $dato->segundoapellidoapoderado;
          //ddd($dato);

          $convocates = Convocante::where('num_solicitud', $acceso[3])
          ->orderBy('id')
          ->get();
            //dd($convocates);
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

        if($tramite != null){
            return view('archivos', compact('tramite','dato', 'data', 'nombrecompleto','tiposolicitud','numero','newDate','tipodedocumento','tipodedocapoderado','apoderado'));
            //return response()->json($tramite);
        } else{
            return response([
                'message' => 'sinproc existe pero NO TIENE ADJUNTO SDP',
            ], 404);
        }
    }

    public function sinpermisos()
    {
        
        return view('administracion.sinpermisos');
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

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Soportecon;


//Models
Use App\Models\Tramite;
use GuzzleHttp\Client;

class DocumentsController extends Controller
{



    public function index()
    {
        $documentos = Soportecon::all();
        return response()->json($documentos);
    }


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


    public function getDocumentos($id){

   
        // Retrieve the validated input...
          $tramite = Soportecon::where('num_solicitud', $id)->get();

        if($tramite != null){
            return view('archivos', compact('tramite'));
            //return response()->json($tramite);
        } else{
            return response([
                'message' => 'sinproc existe pero NO TIENE ADJUNTO SDP',
            ], 404);
        }
    }

        public function descargar($id)
        {
            $archivo = Soportecon::where('id', $id)->first();

            // Lógica adicional si es necesario (por ejemplo, validar permisos, comprobar existencia de archivo, etc.)

            return response()->download(Storage::path($archivo->rutafinalfile));
        }

        public function download($id)
        {
            $documento = Soportecon::findOrFail($id);
    
            return Storage::download($documento->rutafinalfile);
        }
    
        public function show($id)
        {
            $client = new Client([
                'base_uri' => 'http://concil',
            ]);
    
            $headers['Authorization'] = '3ctQPJC3OHuKj9GzmhRx7pqV6lD3I310';
    
    
            $response = $client->request('GET', '/api/documentos/17/download', ['form_params' => [], 'headers' => $headers]);
            
            return $response;
          
        }

        //return response()->json($tramite);







    


    // public function getDerechoPeticion($id_sinproc){
    //     $request = ['id_sinproc' => $id_sinproc];

    //     $validator = Validator::make($request, [
    //         'id_sinproc' => 'required|numeric|exists:tramites,id_sinproc',
    //     ]);
 
    //     if ($validator->fails()) {
    //         return response([
    //             'message' => 'El SINPROC ingresado no existe',
    //         ], 400);
    //     }
 
    //     // Retrieve the validated input...
    //     $validated = $validator->validated();
    //     $tramite = Tramite::where('id_sinproc', $validated['id_sinproc'])->first();
    //     if($tramite->ruta_dp != null){
    //         return response()->download(Storage::path($tramite->ruta_dp));
    //     } else{
    //         return response([
    //             'message' => 'sinproc existe pero NO TIENE ADJUNTO SDP',
    //         ], 404);
    //     }
    // }
}

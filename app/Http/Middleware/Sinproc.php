<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Sinproc
{
 
    //Wnp5TEVrTlc0U05jVzcreU1CWnVjcVhjUWJpMzF2T1k5dXNVUjd6WEl5czlkVkFPcUE0NjlrWUVDYlc4ZmFvWA==
    public function handle(Request $request, Closure $next, ...$guards)
    {

        if (!isset($_GET['key'])) {
            return redirect()->route('sinpermisos');
        }

        $key = urldecode($_GET['key']);
        $key = str_replace(" ", "+", $key);
        $keyIgual = rtrim($key, "=");

        if ($key != $keyIgual) {
            return redirect()->route('sinpermisos');
        }


        $key = urldecode($_GET['key']);
        $key = str_replace(" ", "+", $key);
        $acceso = $this->data($key);
        //dd($acceso);
        if (count($acceso) == 5) {
            $user = User::where('consec', $acceso[1])
                ->where('cedula', $acceso[0])
                ->where('tipo', 'FU')
                ->where('estado', 'A')
                ->first();
        } else {
              return redirect()->route('sinpermisos');
        }
 
        //dd($user->roles);
        if ($user != null) {
            //valido que ya tenga un rol asignado
            return $next($request);
        } else {
            // validation not successful, send back to form
            return redirect()->route('sinpermisos');
        }
    }



    


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
       // dd($encriptar('52283026_@@_79802309_@@_2') );
        
        $dato_desencriptado = $desencriptar($key);
        $data = explode("_@@_", $dato_desencriptado);


        return $data;
    }




    
}


    



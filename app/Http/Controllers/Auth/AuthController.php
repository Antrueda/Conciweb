<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginView()
    {
        return view('login/main', [
            'theme' => 'light',
            'page_name' => 'auth-login',
            'layout' => 'login'
        ]);
    }


    public function login(Request $request)
    {
        //Login desde SINPROC se envia semilla encryptada y luego a json encode en variable key con tres variables 
        if (!isset($_GET['key'])) {
            return redirect('/validation/103');
        }
        
        $key = base64_decode($_GET['key']);
 
        //enviamos key a data funcion encargada de desencryptar la semilla
        $acceso = $this->data($key);
        //dd($acceso);
        if (count($acceso) == 3) {
            $user = User::where('consec', $acceso[0])
                ->where('cedula', $acceso[1])
                ->where('tipo', 'FU')
                ->where('estado', 'A')
                ->first();
        } else {
            return redirect('/validation/104');
        }
 
       // ddd($user->roles);
        if ($user != null) {
            //valido que ya tenga un rol asignado
            if (count($user->roles) > 0) {
                Auth::login($user);
                return redirect()->route('home');
                exit;
            } else {
                return redirect('/unautorized');
            }
        } else {
            // validation not successful, send back to form
            return redirect('/validation/105');
        }
    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        \Auth::logout();
        return view('administracion.viewlogout');
    }

    //funcion encargada de desencryptar la semilla
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

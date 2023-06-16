<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Estadoform;
use App\Models\Sistema\SisEsta;
use Illuminate\Support\Facades\Validator;

class AdministracionController extends Controller{
    public function __construct(){

        $this->opciones['permisox']='salario';

    }

    public function index(){

        return view('administracion.administracion');
    }

  
}

<?php

namespace App\Http\Controllers\Administracion\AsuntoAdmin;

use App\Http\Controllers\Controller;
use App\Traits\Administracion\Asunto\Modulo\DataTablesModuloTrait;
use App\Traits\Administracion\Asunto\Modulo\ParametrizarModuloTrait;
use App\Traits\Administracion\Asunto\Modulo\VistasModuloTrait;
use App\Traits\Administracion\Asunto\PestaniasTrait;

class AsuntoModuloController extends Controller
{
    use ParametrizarModuloTrait; // trait donde se inicializan las opciones de configuracion
    use DataTablesModuloTrait; // trait donde se arman las datatables que se van a utilizar
    use VistasModuloTrait; // trait que arma la logica para lo metodos: crud
    use PestaniasTrait; // trit que construye las pestañas que va a tener el modulo con respectiva logica
    public function __construct()
    {
        $this->opciones['permmidd'] = 'asuntomodulo';
        $this->opciones['permisox'] = 'asuntomodulo';
        $this->opciones['routxxxx'] = 'asuntomodulo';
        $this->getOpciones();
        $this->middleware($this->getMware());
    }

    public function index()
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->getTablas($this->opciones)]);
    }
}

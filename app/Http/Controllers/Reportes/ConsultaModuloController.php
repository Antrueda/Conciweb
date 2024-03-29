<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use App\Traits\TextoAdmin\Modulo\DataTablesModuloTrait;
use App\Traits\TextoAdmin\Modulo\ParametrizarModuloTrait;
use App\Traits\TextoAdmin\Modulo\VistasModuloTrait;
use App\Traits\TextoAdmin\PestaniasTrait;

class ConsultaModuloController extends Controller
{
    use ParametrizarModuloTrait; // trait donde se inicializan las opciones de configuracion
    use DataTablesModuloTrait; // trait donde se arman las datatables que se van a utilizar
    use VistasModuloTrait; // trait que arma la logica para lo metodos: crud
    use PestaniasTrait; // trit que construye las pestañas que va a tener el modulo con respectiva logica
    public function __construct()
    {
        $this->opciones['permmidd'] = 'consultamodulo';
        $this->opciones['permisox'] = 'consultamodulo';
        $this->opciones['routxxxx'] = 'consultamodulo';
        $this->getOpciones();
        $this->middleware($this->getMware());
    }

    public function index()
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->getTablas($this->opciones)]);
    }
}

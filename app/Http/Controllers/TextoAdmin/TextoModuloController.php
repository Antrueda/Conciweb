<?php

namespace App\Http\Controllers\TextoAdmin;

use App\Http\Controllers\Controller;
use App\Traits\TextoAdmin\Modulo\DataTablesModuloTrait;
use App\Traits\TextoAdmin\Modulo\ParametrizarModuloTrait;
use App\Traits\TextoAdmin\Modulo\VistasModuloTrait;
use App\Traits\TextoAdmin\PestaniasTrait;

class TextoModuloController extends Controller
{
    use ParametrizarModuloTrait; // trait donde se inicializan las opciones de configuracion
    use DataTablesModuloTrait; // trait donde se arman las datatables que se van a utilizar
    use VistasModuloTrait; // trait que arma la logica para lo metodos: crud
    use PestaniasTrait; // trit que construye las pestañas que va a tener el modulo con respectiva logica
    public function __construct()
    {
        $this->opciones['permmidd'] = 'textosadmin';
        $this->opciones['permisox'] = 'textosadmin';
        $this->opciones['routxxxx'] = 'textosadmin';
        $this->getOpciones();
        $this->middleware($this->getMware());
    }

    public function index()
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->getTablas($this->opciones)]);
    }
}

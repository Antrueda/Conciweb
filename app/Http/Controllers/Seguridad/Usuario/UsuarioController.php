<?php

namespace App\Http\Controllers\Seguridad\Usuario;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Seguridad\SeguridadConsultasTrait;
use App\Traits\Seguridad\SeguridadDatatableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\Seguridad\Usuario\RolesTrait;
use App\Traits\Seguridad\Usuario\CrudTrait;
use App\Traits\Seguridad\Usuario\DataTablesTrait;
use App\Traits\Seguridad\Usuario\ParametrizarTrait;
use App\Traits\Seguridad\Usuario\VistasTrait;
use App\Traits\Seguridad\Usuario\PestaniasTrait;


class UsuarioController extends Controller
{

    //use SeguridadDatatableTrait;
    use SeguridadConsultasTrait;
    use CrudTrait; // trait donde se hace el crud de localidades
    use ParametrizarTrait; // trait donde se inicializan las opciones de configuracion
    use DataTablesTrait; // trait donde se arman las datatables que se van a utilizar
    use VistasTrait; // trait que arma la logica para lo metodos: crud
    use PestaniasTrait; // trit que construye las pestañas que va a tener el modulo con respectiva logica
    

    public function __construct()
    {     
        $this->opciones['permisox'] = 'usuario';
        $this->opciones['routxxxx'] = 'usuario';
        $this->getOpciones();
        $this->middleware($this->getMware());
    }

    public function index()
    {
        
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->getTablas($this->opciones)]);
    }
    
    public function edit(User $modeloxx)
    {
        $this->pestanix[1]['dataxxxx'] = [true, $modeloxx->id];
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        $this->getBotones(['leer', [$this->opciones['routxxxx'], [$modeloxx]], 2, 'VOLVER A USUARIOS', 'btn btn-sm btn-success']);
        return $this->view($this->getBotones(['crear', [$this->opciones['routxxxx'], [$modeloxx]], 2, 'CREAR NUEVO TEXTO', 'btn btn-sm btn-success'])
            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['editar', 'formulario'],'padrexxx'=>$modeloxx]
        );
    }











}

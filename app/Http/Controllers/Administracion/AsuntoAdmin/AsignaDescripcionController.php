<?php

namespace App\Http\Controllers\Administracion\AsuntoAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AsuntoAdmin\AsignaAsuntoRequest;
use App\Http\Requests\AsuntoAdmin\AsignaDescripcionRequest;
use App\Http\Requests\AsuntoAdmin\SubAsuntoRequest;
use App\Models\ASubasunto;
use App\Models\Subdescripcion;
use App\Traits\Administracion\Asunto\AsignaDescripcion\CrudTrait;
use App\Traits\Administracion\Asunto\AsignaDescripcion\DataTablesTrait;
use App\Traits\Administracion\Asunto\AsignaDescripcion\ParametrizarTrait;
use App\Traits\Administracion\Asunto\AsignaDescripcion\VistasTrait;
use App\Traits\Administracion\Asunto\ListadosTrait;
use App\Traits\Administracion\Asunto\PestaniasTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * FOS Tipo de seguimiento
 */
class AsignaDescripcionController extends Controller
{

    use ListadosTrait; // trait que arma las consultas para las datatables
    use CrudTrait; // trait donde se hace el crud de localidades
    use ParametrizarTrait; // trait donde se inicializan las opciones de configuracion
    use DataTablesTrait; // trait donde se arman las datatables que se van a utilizar
    use VistasTrait; // trait que arma la logica para lo metodos: crud
    use PestaniasTrait; // trit que construye las pestañas que va a tener el modulo con respectiva logica
    public function __construct()
    {
        $this->opciones['permisox'] = 'asignadescri';
        $this->opciones['routxxxx'] = 'asignadescri';
        $this->getOpciones();
        $this->middleware($this->getMware());
    }

    public function index()
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);

        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->getTablas($this->opciones)]);
    }


    public function create()
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view(
            $this->getBotones(['crear', [], 1, 'GUARDAR', 'btn btn-sm btn-success']),
            ['modeloxx' => '', 'accionxx' => ['crear', 'formulario']]
        );
    }
    public function store(AsignaDescripcionRequest $request)
    {
        
        return $this->setSubDescripcion([
            'requestx' => $request,
            'modeloxx' => '',
            'infoxxxx' => 'Asunto creado con éxito',
            'routxxxx' => $this->opciones['routxxxx'] . '.editar'
        ]);
    }


    public function show(Subdescripcion $modeloxx)
    {
        
         $this->opciones['pestania'] = $this->getPestanias($this->opciones);
         $this->getBotones(['leer', [$this->opciones['routxxxx'], [$modeloxx->id]], 2, 'VOLVER A SUBASUNTO', 'btn btn-sm btn-success']);
         $this->getBotones(['editar', [], 1, 'EDITAR', 'btn btn-sm btn-success']);
        $do=$this->getBotones(['crear', [$this->opciones['routxxxx'], [$modeloxx->id]], 2, 'CREAR SUBASUNTO', 'btn btn-sm btn-success']);

        return $this->view($do,
            ['modeloxx' => $modeloxx, 'accionxx' => ['ver', 'formulario'],'padrexxx'=>'']
        );
    }


    public function edit(Subdescripcion $modeloxx)
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        $this->getBotones(['leer', [$this->opciones['routxxxx'], [$modeloxx->sis_nnaj]], 2, 'VOLVER A SUBASUNTO', 'btn btn-sm btn-success']);
        $this->getBotones(['editar', [], 1, 'EDITAR', 'btn btn-sm btn-success']);
        return $this->view($this->getBotones(['crear', [$this->opciones['routxxxx'], [$modeloxx->sis_nnaj]], 2, 'CREAR NUEVO SUBASUNTO', 'btn btn-sm btn-success'])
            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['editar', 'formulario'],'padrexxx'=>$modeloxx->sis_nnaj]
        );
    }


    public function update(AsignaDescripcionRequest $request,  Subdescripcion $modeloxx)
    {
        return $this->setSubDescripcion([
            'requestx' => $request,
            'modeloxx' => $modeloxx,
            'infoxxxx' => 'Subasunto editado con éxito',
            'routxxxx' => $this->opciones['routxxxx'] . '.editar'
        ]);
    }

    public function inactivate(Subdescripcion $modeloxx)
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view(
            $this->getBotones(['borrar', [], 1, 'INACTIVAR', 'btn btn-sm btn-success'])            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['destroy', 'destroy'],'padrexxx'=>$modeloxx->sis_nnaj]
        );
    }


    public function destroy(Request $request, Subdescripcion $modeloxx)
    {

        $modeloxx->update(['sis_esta_id' => 2, ]);
        return redirect()
            ->route($this->opciones['permisox'], [$modeloxx->sis_nnaj_id])
            ->with('info', 'Subasunto inactivado correctamente');
    }

    public function obligar(Request $request, Subdescripcion $modeloxx)
    {
        if($modeloxx->obligatorio==1){
            $modeloxx->update(['obligatorio' => 0, ]);
        }else{
            $modeloxx->update(['obligatorio' => 1, ]);
        }
        
        return redirect()
            ->route($this->opciones['permisox'], [$modeloxx->sis_nnaj_id])
            ->with('info', 'Se ha cambiado la obligatoriedad');
    }

    public function activate(Subdescripcion $modeloxx)
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view(
            $this->getBotones(['activarx', [], 1, 'ACTIVAR', 'btn btn-sm btn-success'])            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['activar', 'activar'],'padrexxx'=>$modeloxx->sis_nnaj]
        );

    }
    public function activar(Request $request, Subdescripcion $modeloxx)
    {
        $modeloxx->update(['sis_esta_id' => 1,]);
        return redirect()
            ->route($this->opciones['permisox'], [$modeloxx->sis_nnaj_id])
            ->with('info', 'Subasunto activado correctamente');
    }
}

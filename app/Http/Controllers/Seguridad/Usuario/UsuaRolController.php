<?php

namespace App\Http\Controllers\Seguridad\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolUsuarioCrearRequest;
use App\Http\Requests\RolUsuarioEditarRequest;
use App\Models\Sistema\SisEsta;
use App\Models\User;
use App\Models\Usuario\RolUsuario;
use App\Traits\Seguridad\SeguridadConsultasTrait;
use App\Traits\Seguridad\UsuarioRol\PestaniasTrait;
use App\Traits\Seguridad\UsuarioRol\CrudTrait;
use App\Traits\Seguridad\UsuarioRol\DataTablesTrait;
use App\Traits\Seguridad\UsuarioRol\ParametrizarTrait;
use App\Traits\Seguridad\UsuarioRol\VistasTrait;
use Illuminate\Http\Request;


class UsuaRolController extends Controller
{
    use SeguridadConsultasTrait;
    use CrudTrait; // trait donde se hace el crud de localidades
    use ParametrizarTrait; // trait donde se inicializan las opciones de configuracion
    use DataTablesTrait; // trait donde se arman las datatables que se van a utilizar
    use VistasTrait; // trait que arma la logica para lo metodos: crud
    use PestaniasTrait; // trit que construye las pestañas que va a tener el modulo con respectiva logica

    public function __construct()
    {     
        $this->opciones['permisox'] = 'roleusua';
        $this->opciones['routxxxx'] = 'roleusua';
        $this->getOpciones();
        $this->middleware($this->getMware());
    }

    public function index(User $padrexxx)
    {

        $this->opciones['parametr']=$padrexxx;
        
        $this->opciones['padrexxx']=$padrexxx;
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->getTablas($this->opciones),'padrexxx'=>$padrexxx]);
    }
    
    public function edit(RolUsuario $modeloxx)
    {
        $this->pestanix[1]['dataxxxx'] = [true, $modeloxx->id];
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        $this->getBotones(['leer', [$this->opciones['routxxxx'], [$modeloxx]], 2, 'VOLVER A USUARIOS', 'btn btn-sm btn-primary']);
        return $this->view($this->getBotones(['crear', [$this->opciones['routxxxx'], [$modeloxx]], 2, 'CREAR NUEVO TEXTO', 'btn btn-sm btn-primary'])
            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['editar', 'formulario'],'padrexxx'=>$modeloxx]
        );
    }

    public function create(User $padrexxx)
    {
        $this->opciones['parametr']=$padrexxx;
        
        $this->opciones['padrexxx']=$padrexxx;
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view($this->getBotones(['crear', [], 1, 'GUARDAR TEXTO', 'btn btn-sm btn-primary']),
            ['modeloxx' => '', 'accionxx' => ['crear', 'formulario'],'padrexxx'=>$padrexxx]
        );
    }
    public function store(RolUsuarioCrearRequest $request)
    {
        
        return $this->setRolUsuario([
            'requestx' => $request,
            'modeloxx' => '',
            'infoxxxx' =>'Texto creado con éxito',
            'routxxxx' => $this->opciones['routxxxx'] . '.editar'
        ]);
    }
        
    public function show(RolUsuario $modeloxx)
    {
        
         $this->opciones['pestania'] = $this->getPestanias($this->opciones);
         $this->getBotones(['leer', [$this->opciones['routxxxx'], [$modeloxx->id]], 2, 'VOLVER A TIPO DE SEGUIMIENTO', 'btn btn-sm btn-primary']);
         $this->getBotones(['editar', [], 1, 'EDITAR DOCUMENTO', 'btn btn-sm btn-primary']);
        $do=$this->getBotones(['crear', [$this->opciones['routxxxx'], [$modeloxx->id]], 2, 'CREAR TIPO SEGUIMIENTO', 'btn btn-sm btn-primary']);

        return $this->view($do,
            ['modeloxx' => $modeloxx, 'accionxx' => ['ver', 'formulario'],'padrexxx'=>'']
        );
    }


    public function update(RolUsuarioEditarRequest $request,  RolUsuario $modeloxx)
    {
        return $this->setRolUsuario([
            'requestx' => $request,
            'modeloxx' => $modeloxx,
            'infoxxxx' => 'Texto editado con éxito',
            'routxxxx' => $this->opciones['routxxxx'] . '.editar'
        ]);
    }

    public function inactivate(RolUsuario $modeloxx)
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view(
            $this->getBotones(['borrar', [], 1, 'INACTIVAR TEXTO', 'btn btn-sm btn-primary'])            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['destroy', 'destroy'],'padrexxx'=>$modeloxx->sis_nnaj]
        );
    }


    public function destroy(Request $request, RolUsuario $modeloxx)
    {

        $modeloxx->update(['sis_esta_id' => 2, 'user_edita_id' => Auth::user()->id]);
        return redirect()
            ->route($this->opciones['permisox'], [$modeloxx->sis_nnaj_id])
            ->with('info', 'Texto inactivado correctamente');
    }

    public function activate(RolUsuario $modeloxx)
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view(
            $this->getBotones(['activarx', [], 1, 'ACTIVAR TEXTO', 'btn btn-sm btn-primary'])            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['activar', 'activar'],'padrexxx'=>$modeloxx->sis_nnaj]
        );

    }
    public function activar(Request $request, RolUsuario $modeloxx)
    {
        $modeloxx->update(['sis_esta_id' => 1, 'user_edita_id' => Auth::user()->id]);
        return redirect()
            ->route($this->opciones['permisox'], [$modeloxx->sis_nnaj_id])
            ->with('info', 'Texto activado correctamente');
    }

    // private function view($dataxxxx)
    // {
    //     $this->opciones['usuariox'] = $dataxxxx['padrexxx'];
    //     $this->opciones['tituhead'] = $dataxxxx['padrexxx']->name;
    //     $selectxx = 0;

    //     $this->opciones['userxxxx'] = [$dataxxxx['padrexxx']->cedula => $dataxxxx['padrexxx']->nombre .' '. $dataxxxx['padrexxx']->apellido];
    //     $this->opciones['parametr'] = [$dataxxxx['padrexxx']->cedula];
    //     $this->opciones['botoform'][0]['routingx'][1] = [$dataxxxx['padrexxx']->cedula];
    //     $this->opciones['estadoxx'] = SisEsta::combo(['cabecera' => true, 'esajaxxx' => false]);
    //     $this->opciones['accionxx'] = $dataxxxx['accionxx'];
    //     // indica si se esta actualizando o viendo
    //     if ($dataxxxx['modeloxx'] != '') {
    //         $this->opciones['modeloxx'] = $dataxxxx['modeloxx'];
    //         $selectxx = $dataxxxx['modeloxx']->sis_servicio_id;
    //         if (auth()->user()->can($this->opciones['permisox'] . '-crear')) {
    //             $this->opciones['botoform'][] =
    //                 [
    //                     'mostrars' => true, 'accionxx' => '', 'routingx' => [$this->opciones['routxxxx'] . '.nuevo', [$dataxxxx['padrexxx']->id]],
    //                     'formhref' => 2, 'tituloxx' => 'IR A CREAR NUEVO REGISTRO', 'clasexxx' => 'btn btn-sm btn-primary'
    //                 ];
    //         }

    //         $this->opciones['fechcrea'] = $dataxxxx['modeloxx']->created_at;
    //         $this->opciones['fechedit'] = $dataxxxx['modeloxx']->updated_at;

    //     }
    //     $this->opciones['rolesxxx'] = RolUsuario::getUsuarioRoles([
    //         'padrexxx' => $dataxxxx['padrexxx']->cedula,
    //         'cabecera' => true,
    //         'ajaxxxxx' => false,
    //         'selectxx' => $selectxx
    //     ]);
    //     return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->opciones]);
    // }

}

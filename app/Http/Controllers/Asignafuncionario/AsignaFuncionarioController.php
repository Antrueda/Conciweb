<?php

namespace App\Http\Controllers\Asignafuncionario;

use App\Http\Controllers\Controller;

use App\Http\Requests\TextoAdmin\TextoCrearRequest;
use App\Http\Requests\TextoAdmin\TextoEditarRequest;
use App\Models\ConciReferente;
use App\Models\Texto;
use App\Models\Tramite;
use App\Models\Tramiteusuario;
use App\Models\User;
use App\Traits\AsignarUsuario\Asignar\CrudTrait;
use App\Traits\AsignarUsuario\Asignar\DataTablesTrait;
use App\Traits\AsignarUsuario\Asignar\ParametrizarTrait;
use App\Traits\AsignarUsuario\Asignar\VistasTrait;
use App\Traits\AsignarUsuario\ListadosTrait;
use App\Traits\AsignarUsuario\PestaniasTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * FOS Tipo de seguimiento
 */
class AsignaFuncionarioController extends Controller
{

    use ListadosTrait; // trait que arma las consultas para las datatables
    use CrudTrait; // trait donde se hace el crud de localidades
    use ParametrizarTrait; // trait donde se inicializan las opciones de configuracion
    use DataTablesTrait; // trait donde se arman las datatables que se van a utilizar
    use VistasTrait; // trait que arma la logica para lo metodos: crud
    use PestaniasTrait; // trit que construye las pestañas que va a tener el modulo con respectiva logica
    public function __construct()
    {
        $this->opciones['permisox'] = 'asignafun';
        $this->opciones['routxxxx'] = 'asignafun';
        $this->getOpciones();
        $this->middleware($this->getMware());
    }

    public function index()
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        $correos=ConciReferente::where('correo', 1)
        ->get();
        $correosactivos=[];
        foreach ($correos as $activo) {
            $correosactivos[] = $activo->email;
        }


        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->getTablas($this->opciones)]);
    }


    public function search(Request $request)
    {
        //ddd($request);
        if ($request->ajax()) {

            $data = User::where('CEDULA', $request->cedula)->get();


            $output = '';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                foreach ($data as $row) {
                    $id = $row->cedula;
                    $output .= '
                   
                    <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Cedula</th>
                          <th scope="col">'.$row->cedula.'</th>
                        </tr>
                        <tr>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">'.$row->nombre.' '.$row->apellido.'</th>
                      </tr>
                      <tr>
                      <th scope="col">Correo</th>
                      <th scope="col">'.$row->email.'</th>
                    </tr>
                      <tr>
                      <th scope="col">Estado</th>
                      <th scope="col">'.$row->estado.'</th>
                    </tr>
                      </thead>
                    
                    </table>
                  </div>


                    
                    <a class="btn btn-success" data-bs-toggle="modal" id="mediumButton" data-target="#mediumModal" data-attr="' . route('asignafun.agregar', ['id' => $id]) . '" style="color:white">Agregar Usuario   <i class="fas fa-minus-square"></i></a>
                    ';
                }
                $output .= '</ul>';
            } else {
                $output .= '<li class="list-group-item">' . 'No se encuentra usuario' . '</li>';
            }
            return $output;
        }
        return view('AsignaUsuario.Asignar.Formulario.autosearch');
    }


    public function modalagregar($id)
    {
        $dato = User::where('cedula', $id)->first();

        return view('AsignaUsuario.Asignar.Formulario.agregar', compact('dato'));
    }


//Funcion para el cambio de estado de la conciliacion
    public function asignar(Request $request, $id)
    {
        $dato = User::where('cedula', $id)->first();

        $correo = $request->input("correo");
        $arrayxx =
                    [
                        "ccfuncionario" => $dato->cedula,
                        "contador" =>  0,
                        "estado" =>  1,
                        "depend_codigo" =>  $dato->depend_codigo,
                        "consec" =>  $dato->consec,
                        "fechaing" =>  Carbon::today()->isoFormat('YYYY-MM-DD'),
                        "correo" =>  $correo,
                        "email" =>  $dato->email,
                        "fechafin" =>  '',
                    ];


        $modelo = ConciReferente::create($arrayxx);
        return redirect()->route('asignafun')->with('info', 'Registro actualizado con éxito');
        
    }


    public function edit(ConciReferente $modeloxx)
    {

        $this->opciones['userrolx'] = User::where('CEDULA', $modeloxx->ccfuncionario)->first();
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        $this->opciones['correose'] = [''=>'- Seleccione una opcion -',1=>'SI',0=>'NO'];
        $this->opciones['estadoxx'] = [''=>'- Seleccione una opcion -',1=>'ACTIVO',0=>'INACTIVO'];
        $this->getBotones(['leer', [$this->opciones['routxxxx'], [$modeloxx->ccfuncionario]], 2, 'VOLVER A USUARIOS', 'btn btn-sm btn-success']);
       
        return $this->view($this->getBotones(['editar', [], 1, 'EDITAR', 'btn btn-sm btn-success'])
            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['editar', 'formulario'],'padrexxx'=>$modeloxx->ccfuncionario]
        );
    }


    public function update(Request $request,  ConciReferente $modeloxx)
    {

        $correo = $request->input("correo");
        $estado = $request->input("estado");
        $fechafin='';
        if($estado==0){
            $fechafin=Carbon::today()->isoFormat('YYYY-MM-DD');
        }
          
        $modeloxx->update([ "ccfuncionario" => $modeloxx->ccfuncionario,
        "contador" =>  $modeloxx->contador,
        "estado" =>  $estado,
        "fechaing" =>  $modeloxx->fechaing,
        "depend_codigo" =>  $modeloxx->depend_codigo,
        "consec" =>  $modeloxx->consec,
        "correo" =>  $correo,
        "email" =>  $modeloxx->email,
        "fechafin" =>  $fechafin,]);
        
        return redirect()->route('asignafun')->with('info', 'Registro actualizado con éxito');

    }

    public function inactivate(Texto $modeloxx)
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view(
            $this->getBotones(['borrar', [], 1, 'INACTIVAR', 'btn btn-sm btn-primary'])            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['destroy', 'destroy'],'padrexxx'=>$modeloxx->sis_nnaj]
        );
    }


    public function destroy(Request $request, Tramiteusuario $modeloxx)
    {

        $modeloxx->update(['sis_esta_id' => 2, 'user_edita_id' => Auth::user()->id]);
        return redirect()
            ->route($this->opciones['permisox'], [$modeloxx->sis_nnaj_id])
            ->with('info', 'Usuario inactivado correctamente');
    }

    public function activate(Tramiteusuario $modeloxx)
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view(
            $this->getBotones(['activarx', [], 1, 'ACTIVAR', 'btn btn-sm btn-primary'])            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['activar', 'activar'],'padrexxx'=>$modeloxx->sis_nnaj]
        );

    }
    public function activar(Request $request, Tramiteusuario $modeloxx)
    {
        $modeloxx->update(['sis_esta_id' => 1, 'user_edita_id' => Auth::user()->id]);
        return redirect()
            ->route($this->opciones['permisox'], [$modeloxx->sis_nnaj_id])
            ->with('info', 'Usuario activado correctamente');
    }
}

<?php

namespace App\Http\Controllers\ConsultaConci;

use App\Http\Controllers\Controller;

use App\Http\Requests\TextoAdmin\TextoCrearRequest;
use App\Http\Requests\TextoAdmin\TextoEditarRequest;
use App\Models\Soportecon;
use App\Models\Subdescripcion;
use App\Models\Texto;
use App\Models\Tramiteusuario;
use App\Traits\ConsultaConci\Consulta\CrudTrait;
use App\Traits\ConsultaConci\Consulta\DataTablesTrait;
use App\Traits\ConsultaConci\Consulta\ParametrizarTrait;
use App\Traits\ConsultaConci\Consulta\VistasTrait;
use App\Traits\ConsultaConci\ListadosTrait;
use App\Traits\ConsultaConci\PestaniasTrait;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * FOS Tipo de seguimiento
 */
class ConsultaConciController extends Controller
{

    use ListadosTrait; // trait que arma las consultas para las datatables
    use CrudTrait; // trait donde se hace el crud de localidades
    use ParametrizarTrait; // trait donde se inicializan las opciones de configuracion
    use DataTablesTrait; // trait donde se arman las datatables que se van a utilizar
    use VistasTrait; // trait que arma la logica para lo metodos: crud
    use PestaniasTrait; // trit que construye las pestañas que va a tener el modulo con respectiva logica
    public function __construct()
    {
        $this->opciones['permisox'] = 'consultac';
        $this->opciones['routxxxx'] = 'consultac';
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
            $this->getBotones(['crear', [], 1, 'GUARDAR TEXTO', 'btn btn-sm btn-primary']),
            ['modeloxx' => '', 'accionxx' => ['crear', 'formulario']]
        );
    }
    public function store(TextoCrearRequest $request)
    {
        
        return $this->setTexto([
            'requestx' => $request,
            'modeloxx' => '',
            'infoxxxx' =>       'Texto creado con éxito',
            'routxxxx' => $this->opciones['routxxxx'] . '.editar'
        ]);
    }

    public function agregar($modeloxx)
    {
        
        $dato = Tramiteusuario::where('num_solicitud', $modeloxx)->first();
        $tiposolicitud= $dato->tiposolicitud;
        //dd( $tiposolicitud);
        $nombrecompleto = $dato->primernombre . ' ' . $dato->segundonombre . ' ' . $dato->primerapellido  . ' ' . $dato->segundoapellido;
        //ddd($dato);
        $detalleAbc = Subdescripcion::where('subasu_id', $dato->subasunto)
            ->where('sis_esta_id', 1)
            ->orderBy('id')
            ->get();

        $adjuntos=Soportecon::where('num_solicitud', $modeloxx)->get();
        //dd($adjuntos);
        $data = array(
            "detalleAbc" => $detalleAbc,
            "adjuntos" =>$adjuntos
        );
        return view('Consulta.Consulta.Formulario.agregar', compact('dato', 'data', 'nombrecompleto','tiposolicitud','adjuntos'));
    }

    public function archivo($id)
    {

        $adjuntos=Soportecon::where('id', $id)->first();
      
        $filepath = public_path("storage/".$adjuntos->rutafinalfile);
        return Response::download($filepath); 
    }

    public function show(Tramiteusuario $modeloxx)
    {
        return view('AsignaUsuario.Asignar.Formulario.autosearch');
        
    }


    public function edit(Tramiteusuario $modeloxx)
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        $this->getBotones(['leer', [$this->opciones['routxxxx'], [$modeloxx->sis_nnaj]], 2, 'VOLVER A TEXTO', 'btn btn-sm btn-primary']);
        $this->getBotones(['editar', [], 1, 'EDITAR TEXTO', 'btn btn-sm btn-primary']);
        return $this->view($this->getBotones(['crear', [$this->opciones['routxxxx'], [$modeloxx->sis_nnaj]], 2, 'CREAR NUEVO TEXTO', 'btn btn-sm btn-primary'])
            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['editar', 'formulario'],'padrexxx'=>$modeloxx->sis_nnaj]
        );
    }


    public function update(TextoEditarRequest $request,  Tramiteusuario $modeloxx)
    {
        return $this->setTexto([
            'requestx' => $request,
            'modeloxx' => $modeloxx,
            'infoxxxx' => 'Texto editado con éxito',
            'routxxxx' => $this->opciones['routxxxx'] . '.editar'
        ]);
    }

    public function inactivate(Texto $modeloxx)
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view(
            $this->getBotones(['borrar', [], 1, 'INACTIVAR TEXTO', 'btn btn-sm btn-primary'])            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['destroy', 'destroy'],'padrexxx'=>$modeloxx->sis_nnaj]
        );
    }


    public function destroy(Request $request, Tramiteusuario $modeloxx)
    {

        $modeloxx->update(['sis_esta_id' => 2, 'user_edita_id' => Auth::user()->id]);
        return redirect()
            ->route($this->opciones['permisox'], [$modeloxx->sis_nnaj_id])
            ->with('info', 'Texto inactivado correctamente');
    }

    public function activate(Tramiteusuario $modeloxx)
    {
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view(
            $this->getBotones(['activarx', [], 1, 'ACTIVAR TEXTO', 'btn btn-sm btn-primary'])            ,
            ['modeloxx' => $modeloxx, 'accionxx' => ['activar', 'activar'],'padrexxx'=>$modeloxx->sis_nnaj]
        );

    }
    public function activar(Request $request, Tramiteusuario $modeloxx)
    {
        $modeloxx->update(['sis_esta_id' => 1, 'user_edita_id' => Auth::user()->id]);
        return redirect()
            ->route($this->opciones['permisox'], [$modeloxx->sis_nnaj_id])
            ->with('info', 'Texto activado correctamente');
    }
}

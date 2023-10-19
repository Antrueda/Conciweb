<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\ConciReferente;
use App\Models\Soportecon;
use App\Models\Subdescripcion;
use App\Models\Texto;
use App\Models\Tramiteusuario;
use App\Traits\Reportes\Reportes\CrudTrait;
use App\Traits\Reportes\Reportes\DataTablesTrait;
use App\Traits\Reportes\Reportes\ParametrizarTrait;
use App\Traits\Reportes\Reportes\VistasTrait;
use App\Traits\Reportes\ListadosTrait;
use App\Traits\Reportes\PestaniasTrait;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

/**
 * FOS Tipo de seguimiento
 */
class ReportesConciController extends Controller
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
        $datosSolicitante = ConciReferente::where('estado', 1)
        ->orderBy('contador', 'desc')
        ->get();
        
        $random=[];
        foreach($datosSolicitante as $consec){
            
            $random[]=$consec->consec;
        }
        //dd($random);
        //dd($datosSolicitante);
        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->getTablas($this->opciones)]);



        // $query = Tramiteusuario::select('NUM_SOLICITUD', 'FEC_SOLICITUD_TRAMITE', 'UPDATED_AT','ESTADODOC')
        // ->whereNotNull('UPDATED_AT')
        // ->whereDate('FEC_SOLICITUD_TRAMITE', '>=', '2023-10-02')->get();
        // //dd($query);
        // return view('Reportes.Consulta.Formulario.index',compact('query'));
    
    }

    public function getData()
    {
        $query = Tramiteusuario::select('NUM_SOLICITUD', 'FEC_SOLICITUD_TRAMITE', 'UPDATED_AT','ESTADODOC')
            ->whereNotNull('UPDATED_AT')
            ->whereDate('FEC_SOLICITUD_TRAMITE', '>=', '2023-10-02');

        return datatables()->of($query)->make(true);
    }

    /*

    SELECT NUM_SOLICITUD,
       FEC_SOLICITUD_TRAMITE,
       UPDATED_AT,
       ESTADODOC,
        TRUNC((CAST(UPDATED_AT AS DATE) - FEC_SOLICITUD_TRAMITE)) AS dias_de_diferencia
FROM CONCI_TRAMITEUSUARIOS WHERE UPDATED_AT IS NOT NULL and FEC_SOLICITUD_TRAMITE >= TO_DATE('02-10-2023', 'DD-MM-YYYY');


    */

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
        $numero=number_format($dato->cuantia,0);
        $adjuntos=Soportecon::where('num_solicitud', $modeloxx)->get();
        //dd($adjuntos);
        $data = array(
            "detalleAbc" => $detalleAbc,
            "adjuntos" =>$adjuntos
        );
        return view('Consulta.Consulta.Formulario.agregar', compact('dato', 'data', 'nombrecompleto','tiposolicitud','adjuntos','numero'));
    }

    public function archivo($id)
    {

        $adjuntos=Soportecon::where('id', $id)->first();

  
        return response()->download(Storage::path($adjuntos->rutafinalfile));
    }

    public function show(Tramiteusuario $modeloxx)
    {
        return view('AsignaUsuario.Asignar.Formulario.autosearch');
        
    }


   
}

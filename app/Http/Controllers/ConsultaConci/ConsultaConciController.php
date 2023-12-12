<?php

namespace App\Http\Controllers\ConsultaConci;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\ConciReferente;
use App\Models\Convocante;
use App\Models\Parametro;
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
use Carbon\Carbon;
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
    use PestaniasTrait; // trait que construye las pestañas que va a tener el modulo con respectiva logica
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

    //Consulta general

    public function indexgeneral()
    {
        
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->getTablas($this->opciones)]);
    }

        //Consulta Finalizado
    public function indexFin()
    {
 
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        $this->opciones['pestania'][0]['activexx']="";
        $this->opciones['pestania'][1]['activexx']="active";
        $this->opciones['pestania'][2]['activexx']="";
        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->getTablasFinalizado($this->opciones)]);
    }


          //Consulta Diferencia de días
    public function Dias()
    {
        // $this->pestanix[0]['activexx'] = "";
        // $this->pestanix[1]['activexx'] = "active";
        // $this->pestanix[2]['activexx'] = "";
   
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        $this->opciones['pestania'][0]['activexx']="";
        $this->opciones['pestania'][1]['activexx']="";
        $this->opciones['pestania'][2]['activexx']="active";
        

        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->getTabladias($this->opciones)]);
    }


      //Consulta solicitud individual
    public function consultanum(Request $request)
    {
        if ($request->ajax()) {
           
            $data = Tramiteusuario::where('num_solicitud', $request->num_solicitud)->where('vigencia', $request->codigo)->first();
            
            //se verifica el estado de documento
            $output = '';
            if ($data) {
                $tiposolicitud= $data->tiposolicitud;
                $vigencia=$request->codigo;
                $Dfinalizacion=date("d/m/Y", strtotime($data->updated_at));
                $nombrecompleto = $data->primernombre . ' ' . $data->segundonombre . ' ' . $data->primerapellido  . ' ' . $data->segundoapellido;
                $detalleAbc = Subdescripcion::where('subasu_id', $data->subasunto)
                    ->where('sis_esta_id', 1)
                    ->orderBy('id')
                    ->get();
                    $numero=number_format($data->cuantia,0,'.','.');
                if($data->estadodoc==''){
                    $data->estadodoc='Remitido';
                    return view('Consulta.Consulta.Formulario.incompleto', compact( 'data', 'nombrecompleto','tiposolicitud','numero','Dfinalizacion','vigencia'));
                //Validacion de estado "adjunto", devuelve mensaje y no deja ingresar al formulario de adjuntos
            } else if($data->estadodoc=='Finalizado Adjuntos') {
             
                //$output .= '<br><p style="width:90%;margin:auto;" class="alert alert-success"><i class="fa-regular fa-circle-check fa-2xl"></i>' . '<span style="padding:8px;font-size: 1.2rem;"> El proceso de adjuntar documentos finalizó el día '.date("d/m/Y", strtotime($data->updated_at)) . '</span></p><br>';

                return view('Consulta.Consulta.Formulario.finalizado', compact( 'data', 'nombrecompleto','tiposolicitud','numero','Dfinalizacion','vigencia'));
               ;

                //Validacion de estado "Cancelado", devuelve mensaje y no deja ingresar al formulario de adjuntos
            }else if($data->estadodoc=='Desistimiento Voluntario'||$data->estadodoc=='Desistimiento Automatico') {
                return view('Consulta.Consulta.Formulario.desistir', compact( 'data', 'nombrecompleto','tiposolicitud','numero','Dfinalizacion','vigencia'));
            }
            return $output;
        }else{
            $output .= '<br><p style="width:90%;margin:auto;" class="alert alert-warning"> <i class="fa-solid fa-triangle-exclamation fa-2xl"></i>' . '<span style="padding:8px;font-size: 1.2rem;">  No se encuentra información' . ' </span>   </p>';
            return $output;
        }
    }
        return view('Consulta.Consulta.Formulario.consultasearch');
    }
    
    


    public function agrega($modeloxx)
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

    public function verificar($modeloxx,$vigencia)
    {
    
        $tramite = Soportecon::where('num_solicitud', $modeloxx)->where('vigencia',$vigencia)->get();

        $dato = Tramiteusuario::where('num_solicitud', $modeloxx)->where('vigencia',$vigencia)->first();
        $fecha = $dato->fec_solicitud_tramite;
        $newDate =    $newDate = Carbon::parse($fecha)->format('d/m/Y H:i:s'); 
        $tipodedocumento=Parametro::where('id', $dato->tipodocumento)->first()->nombre;
               
        $tiposolicitud= $dato->tiposolicitud;
        $tipodedocapoderado='';
        if($tiposolicitud==1){
            $tipodedocapoderado=Parametro::where('id', $dato->tipodocapoderado)->first()->nombre;
        }
      $nombrecompleto = $dato->primernombre . ' ' . $dato->segundonombre . ' ' . $dato->primerapellido  . ' ' . $dato->segundoapellido;
        $apoderado = $dato->primernombreapoderado . ' ' . $dato->segundonombreapoderado . ' ' . $dato->primerapellidoapoderado  . ' ' . $dato->segundoapellidoapoderado;
    
        $convocates = Convocante::where('num_solicitud', $modeloxx)
        ->orderBy('id')
        ->get();
        $numero=number_format($dato->cuantia,0,'.','.');
        $detalleAbc = Subdescripcion::where('subasu_id', $dato->subasunto)
            ->where('sis_esta_id', 1)
            ->orderBy('id')
            ->get();
        //INFORMACION RETORNADA EN LA VISTA
        //$conteo= count($detalleAbc)-1;
    
        $data = array(
            "detalleAbc" => $detalleAbc,
            "convocates" => $convocates
        );
    
      if(!$tramite->isEmpty()){
          return view('Consulta.Consulta.Formulario.archivos', compact('tramite','dato', 'data', 'nombrecompleto','tiposolicitud','numero','newDate','tipodedocumento','tipodedocapoderado','apoderado'));
       
      } else{
        return view('Consulta.Consulta.Formulario.agregar', compact('tramite','dato', 'data', 'nombrecompleto','tiposolicitud','numero','newDate','tipodedocumento','tipodedocapoderado','apoderado'));
      }
    
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

<?php

namespace App\Traits\Administracion\Asunto;

use App\Models\Acciones\Grupales\Traslado\MotivoEgreso;
use App\Models\Acciones\Grupales\Traslado\MotivoEgresoSecu;
use App\Models\Acciones\Grupales\Traslado\MotivoEgreu;
use App\Models\ASubasunto;
use App\Models\Asunto;
use App\Models\Descripciona;
use App\Models\fichaobservacion\FosSeguimiento;
use App\Models\fichaobservacion\FosStse;
use App\Models\fichaobservacion\FosStsesTest;
use App\Models\fichaobservacion\FosTse;
use App\Models\SubAsunto;
use App\Models\Subdescripcion;
use App\Models\Texto;
use App\Models\Usuario\Estusuario;
use App\Traits\DatatableTrait;
use Illuminate\Http\Request;


/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait ListadosTrait
{
    use DatatableTrait;

    /**
     * 
     */

    public function listaAsunto(Request $request)
    {

        if ($request->ajax()) {
            // ddd($request);
            $request->routexxx = [$this->opciones['routxxxx'],'textos'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx = Asunto::select(
				[
					'conci_asuntos.id',
					'conci_asuntos.nombre',
                    'conci_asuntos.sis_esta_id',
					'conci_sis_estas.s_estado'
				]
			)
				->join('conci_sis_estas', 'conci_asuntos.sis_esta_id', '=', 'conci_sis_estas.id');
                

            return $this->getDt($dataxxxx, $request);
        }
    }
    public function listaSubAsunto(Request $request)
    {

        if ($request->ajax()) {
            // ddd($request);
            $request->routexxx = [$this->opciones['routxxxx'],'textos'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx = SubAsunto::select(
				[
					'conci_sub_asuntos.id',
					'conci_sub_asuntos.nombre',
                    'conci_sub_asuntos.sis_esta_id',
					'conci_sis_estas.s_estado'
				]
			)
				->join('conci_sis_estas', 'conci_sub_asuntos.sis_esta_id', '=', 'conci_sis_estas.id');
                

            return $this->getDt($dataxxxx, $request);
            }
     }


     public function listaAsignaAsunto(Request $request)
     {
 
         if ($request->ajax()) {
             // ddd($request);
             $request->routexxx = [$this->opciones['routxxxx'],'textos'];
             $request->botonesx = $this->opciones['rutacarp'] .
                 $this->opciones['carpetax'] . '.Botones.botonesapi';
             $request->estadoxx = 'layouts.components.botones.estadosx';
             $dataxxxx = ASubasunto::select(
                 [
                     'conci_a_subasuntos.id',
                     'asunto.nombre as asunto',
                     'sub.nombre as sub',
                     'conci_a_subasuntos.sis_esta_id',
                     'conci_sis_estas.s_estado'
                 ]
             )

                ->join('conci_asuntos as asunto', 'conci_a_subasuntos.asunto_id', '=', 'asunto.id')
                ->join('conci_sub_asuntos as sub', 'conci_a_subasuntos.subasu_id', '=', 'sub.id')
                 ->join('conci_sis_estas', 'conci_a_subasuntos.sis_esta_id', '=', 'conci_sis_estas.id');
                 
 
             return $this->getDt($dataxxxx, $request);
             }
      }

      //listaDescripcion


      public function listaDescripcion(Request $request)
      {
  
          if ($request->ajax()) {
              // ddd($request);
              $request->routexxx = [$this->opciones['routxxxx'],'textos'];
              $request->botonesx = $this->opciones['rutacarp'] .
                  $this->opciones['carpetax'] . '.Botones.botonesapi';
              $request->estadoxx = 'layouts.components.botones.estadosx';
              $dataxxxx = Descripciona::select(
                  [
                      'conci_descripcionas.id',
                      'conci_descripcionas.nombre',
                      'conci_descripcionas.sis_esta_id',
                      'conci_sis_estas.s_estado'
                  ]
              )
                  ->join('conci_sis_estas', 'conci_descripcionas.sis_esta_id', '=', 'conci_sis_estas.id');
                  
  
              return $this->getDt($dataxxxx, $request);
              }
       }
      public function listaAsignaDescripcion(Request $request)
     {
 
         if ($request->ajax()) {
             // ddd($request);
             $request->routexxx = [$this->opciones['routxxxx'],'textos'];
             $request->botonesx = $this->opciones['rutacarp'] .
                 $this->opciones['carpetax'] . '.Botones.botonesapi';
             $request->estadoxx = 'layouts.components.botones.estadosx';
             $dataxxxx = Subdescripcion::select(
                 [
                     'conci_subdescripcions.id',
                     'descri.nombre as descri',
                     'sub.nombre as sub',
                     'conci_subdescripcions.sis_esta_id',
                     'conci_sis_estas.s_estado'
                 ]
             )

                ->join('conci_descripcionas as descri', 'conci_subdescripcions.descri_id', '=', 'descri.id')
                ->join('conci_sub_asuntos as sub', 'conci_subdescripcions.subasu_id', '=', 'sub.id')
                 ->join('conci_sis_estas', 'conci_subdescripcions.sis_esta_id', '=', 'conci_sis_estas.id');
                 
 
             return $this->getDt($dataxxxx, $request);
             }
      }


}


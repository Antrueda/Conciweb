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
					'asuntos.id',
					'asuntos.nombre',
                    'asuntos.sis_esta_id',
					'sis_estas.s_estado'
				]
			)
				->join('sis_estas', 'asuntos.sis_esta_id', '=', 'sis_estas.id');
                

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
					'sub_asuntos.id',
					'sub_asuntos.nombre',
                    'sub_asuntos.sis_esta_id',
					'sis_estas.s_estado'
				]
			)
				->join('sis_estas', 'sub_asuntos.sis_esta_id', '=', 'sis_estas.id');
                

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
                     'a_subasuntos.id',
                     'asunto.nombre as asunto',
                     'sub.nombre as sub',
                     'a_subasuntos.sis_esta_id',
                     'sis_estas.s_estado'
                 ]
             )

                ->join('asuntos as asunto', 'a_subasuntos.asunto_id', '=', 'asunto.id')
                ->join('sub_asuntos as sub', 'a_subasuntos.subasu_id', '=', 'sub.id')
                 ->join('sis_estas', 'a_subasuntos.sis_esta_id', '=', 'sis_estas.id');
                 
 
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
                      'descripcionas.id',
                      'descripcionas.nombre',
                      'descripcionas.sis_esta_id',
                      'sis_estas.s_estado'
                  ]
              )
                  ->join('sis_estas', 'descripcionas.sis_esta_id', '=', 'sis_estas.id');
                  
  
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
                     'subdescripcions.id',
                     'descri.nombre as descri',
                     'sub.nombre as sub',
                     'subdescripcions.sis_esta_id',
                     'sis_estas.s_estado'
                 ]
             )

                ->join('descripcionas as descri', 'subdescripcions.descri_id', '=', 'descri.id')
                ->join('sub_asuntos as sub', 'subdescripcions.subasu_id', '=', 'sub.id')
                 ->join('sis_estas', 'subdescripcions.sis_esta_id', '=', 'sis_estas.id');
                 
 
             return $this->getDt($dataxxxx, $request);
             }
      }


}


<?php

namespace App\Traits\Reportes;


use App\Models\Tramiteusuario;

use App\Traits\DatatableTrait;
use App\tramiteusuario as AppTramiteusuario;
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

    public function listaConciliaciones(Request $request)
    {

        if ($request->ajax()) {
            // ddd($request);
            $request->routexxx = [$this->opciones['routxxxx'],'textos'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx = Tramiteusuario::select(
				[
					'conci_tramiteusuarios.num_solicitud',
					'conci_tramiteusuarios.id_tramite',
                    'conci_tramiteusuarios.fec_solicitud_tramite',
                    'UPDATED_AT',
                    DB::raw('DATEDIFF(fecha_actualizacion, fecha_creacion) as diferencia_dias'),
					'conci_tramiteusuarios.estadodoc',
				]
			)
                ->where('conci_tramiteusuarios.id_tramite', 335)
                ->whereNotNull('fecha_actualizacion')
                ->whereDate('fecha_creacion', '>=', '2023-10-02')->orderBy('num_solicitud', 'desc');

            return $this->getDts($dataxxxx, $request);
        }
    }

   // $query = Tramiteusuario::select('NUM_SOLICITUD', 'FEC_SOLICITUD_TRAMITE', 'UPDATED_AT','ESTADODOC')
        // ->whereNotNull('UPDATED_AT')
        // ->whereDate('FEC_SOLICITUD_TRAMITE', '>=', '2023-10-02')->get();
        // //dd($query);
        // return view('Reportes.Consulta.Formulario.index',compact('query'));






}

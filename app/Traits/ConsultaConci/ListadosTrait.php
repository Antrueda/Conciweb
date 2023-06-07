<?php

namespace App\Traits\ConsultaConci;

use App\Models\Acciones\Grupales\Traslado\MotivoEgreso;
use App\Models\Acciones\Grupales\Traslado\MotivoEgresoSecu;
use App\Models\Acciones\Grupales\Traslado\MotivoEgreu;
use App\Models\fichaobservacion\FosSeguimiento;
use App\Models\fichaobservacion\FosStse;
use App\Models\fichaobservacion\FosStsesTest;
use App\Models\fichaobservacion\FosTse;
use App\Models\Texto;
use App\Models\Tramiteusuario;
use App\Models\Usuario\Estusuario;
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
					'conci_tramiteusuarios.sis_esta_id',
					'conci_sis_estas.s_estado'
				]
			)
                ->where('conci_tramiteusuarios.id_tramite', 335)
				->join('conci_sis_estas', 'conci_tramiteusuarios.sis_esta_id', '=', 'conci_sis_estas.id')->orderBy('num_solicitud', 'desc');;

            return $this->getDt($dataxxxx, $request);
        }
    }

    // public function listaConciliaciones(Request $request)
    // {

    //     if ($request->ajax()) {
    //         // ddd($request);
    //         $request->routexxx = [$this->opciones['routxxxx'],'textos'];
    //         $request->botonesx = $this->opciones['rutacarp'] .
    //             $this->opciones['carpetax'] . '.Botones.botonesapi';
    //         $request->estadoxx = 'layouts.components.botones.estadosx';
    //         $dataxxxx = AppTramiteusuario::where('id_tramite',330);
	// 			//->join('conci_sis_estas', 'conci_tramiteusuarios.sis_esta_id', '=', 'conci_sis_estas.id');

    //         return $this->getDt($dataxxxx, $request);
    //     }
    // }






}

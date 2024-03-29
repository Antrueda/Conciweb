<?php

namespace App\Traits\TextoAdmin;

use App\Models\Acciones\Grupales\Traslado\MotivoEgreso;
use App\Models\Acciones\Grupales\Traslado\MotivoEgresoSecu;
use App\Models\Acciones\Grupales\Traslado\MotivoEgreu;
use App\Models\fichaobservacion\FosSeguimiento;
use App\Models\fichaobservacion\FosStse;
use App\Models\fichaobservacion\FosStsesTest;
use App\Models\fichaobservacion\FosTse;
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

    public function listaFosts(Request $request)
    {

        if ($request->ajax()) {
            // ddd($request);
            $request->routexxx = [$this->opciones['routxxxx'],'textos'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx = Texto::select(
				[
					'conci_textos.id',
					'conci_textos.texto',
                    'tipotexto.nombre as tipotexto',
   
					'conci_textos.sis_esta_id',
					'conci_sis_estas.s_estado'
				]
			)
				->join('conci_sis_estas', 'conci_textos.sis_esta_id', '=', 'conci_sis_estas.id')
                ->join('conci_parametros as tipotexto', 'conci_textos.tipotexto_id', '=', 'tipotexto.id');

            return $this->getDt($dataxxxx, $request);
        }
    }




}

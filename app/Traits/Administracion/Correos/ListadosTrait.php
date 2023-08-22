<?php

namespace App\Traits\Administracion\Correos;

use App\Models\Acciones\Grupales\Traslado\MotivoEgreso;
use App\Models\Acciones\Grupales\Traslado\MotivoEgresoSecu;
use App\Models\Acciones\Grupales\Traslado\MotivoEgreu;
use App\Models\ASubasunto;
use App\Models\Asunto;
use App\Models\ConciCorreoinv;
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

    public function listaCorreos(Request $request)
    {

        if ($request->ajax()) {
            
            $request->routexxx = [$this->opciones['routxxxx'],'textos'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx = ConciCorreoinv::select(
				[
					'conci_correoinvs.id',
					'conci_correoinvs.email',
                    'conci_correoinvs.created_at',
				]
                );
                

            return $this->getDt($dataxxxx, $request);
        }
    }
   
}


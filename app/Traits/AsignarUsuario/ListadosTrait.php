<?php

namespace App\Traits\AsignarUsuario;

use App\Models\Acciones\Grupales\Traslado\MotivoEgreso;
use App\Models\Acciones\Grupales\Traslado\MotivoEgresoSecu;
use App\Models\Acciones\Grupales\Traslado\MotivoEgreu;
use App\Models\ConciReferente;
use App\Models\fichaobservacion\FosSeguimiento;
use App\Models\fichaobservacion\FosStse;
use App\Models\fichaobservacion\FosStsesTest;
use App\Models\fichaobservacion\FosTse;
use App\Models\Texto;
use App\Models\Tramiteusuario;
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

    public function listaUsers(Request $request)
    {

        if ($request->ajax()) {
            // ddd($request);
            $request->routexxx = [$this->opciones['routxxxx'],'textos'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
                
            $request->estadoxx = $this->opciones['rutacarp'] .
            $this->opciones['carpetax'] . '.Botones.estadosx';
            $request->correo = $this->opciones['rutacarp'] .
            $this->opciones['carpetax'] . '.Botones.correo';
            $dataxxxx = ConciReferente::select(
				[
					'conci_referentes.id',
					'conci_referentes.ccfuncionario',
                    'conci_referentes.contador',
                    'conci_referentes.email',
                    'conci_referentes.correo',
					'conci_referentes.estado',
				]
                );

            return $this->getAsignaDt($dataxxxx, $request);
        }
    }

  




}

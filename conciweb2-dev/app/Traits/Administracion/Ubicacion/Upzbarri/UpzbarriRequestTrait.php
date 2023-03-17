<?php

namespace App\Traits\Administracion\Ubicacion\Upzbarri;



/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait UpzbarriRequestTrait
{
    public function getMensajesULT($dataxxxx)
    {
        $_mensaje = [
            'sis_barrio_id.required' => 'Seleccione una barrio',
            'simianti_id.required' => 'Ingrese el código antiguo',
        ];
        return $_mensaje;
    }
    public function getReglasULT($dataxxxx)
    {
        $_reglasx = [
            'sis_barrio_id' => [
                'required',
            ],
            'simianti_id' => [
                'required',
            ],
        ];
        return $_reglasx;
    }
}

<?php

namespace App\Traits\Administracion\Ubicacion\Localupz;



/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait LocalupzRequestTrait
{
    public function getMensajesULT($dataxxxx)
    {
        $_mensaje = [
            'sis_upz_id.required' => 'Seleccione una upz',

        ];
        return $_mensaje;
    }
    public function getReglasULT($dataxxxx)
    {
        $_reglasx = [
            'sis_upz_id' => [
                'required',
            ],
        ];
        return $_reglasx;
    }
}

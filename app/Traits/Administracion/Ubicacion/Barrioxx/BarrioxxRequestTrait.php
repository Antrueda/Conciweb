<?php

namespace App\Traits\Administracion\Ubicacion\Barrioxx;



/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait BarrioxxRequestTrait
{
    public function getMensajesULT($dataxxxx)
    {
        $_mensaje = [
            's_barrio.required' => 'El nombre del barrio es requerido',
            's_barrio.unique' => 'El nombre del barrio ya se encuentra en uso',
        ];
        return $_mensaje;
    }
    public function getReglasULT($dataxxxx)
    {
        $unicoxxx='';
        if($dataxxxx['creaedit']){
            $unicoxxx=',s_barrio,'.$dataxxxx['requestx']->segments()[2];
        }

        $_reglasx = [
            's_barrio' => [
                'required',
                'unique:sis_barrios' . $unicoxxx,
            ],
        ];
        return $_reglasx;
    }
}

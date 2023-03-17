<?php

namespace App\Traits\Administracion\Ubicacion\Upzxxxxx;



/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait UpzxxxxxRequestTrait
{
    public function getMensajesULT($dataxxxx)
    {
        $_mensaje = [
            's_upz.required' => 'El nombre de la upz es requerido',
            's_upz.unique' => 'El nombre de la upz ya se encuentra en uso',
            'simianti_id.required' => 'Ingrese el código antiguo',
            's_codigo.required' => 'Ingrese el código',
        ];
        return $_mensaje;
    }
    public function getReglasULT($dataxxxx)
    {
        $unicoxxx='';
        if($dataxxxx['creaedit']){
            $unicoxxx=',s_upz,'.$dataxxxx['requestx']->segments()[2];
        }

        $_reglasx = [
            's_upz' => [
                'required',
                'unique:sis_upzs' . $unicoxxx,
            ],
            'simianti_id' => [
                'required',
            ],
            's_codigo' => [
                'required',
            ],
        ];
        return $_reglasx;
    }
}

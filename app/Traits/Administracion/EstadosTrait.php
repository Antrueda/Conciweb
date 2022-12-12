<?php

namespace App\Traits\Administracion;


use App\Models\Usuario\Estusuario;
use App\Traits\DatatableTrait;

/**
 * Este trait permite realizar los calculos para encontrar cuantos días adicionales se le darán
 * terminado el mes para el carge de información
 */
trait EstadosTrait
{
    use DatatableTrait;
    public function getEstados($request)
    {
        $dataxxxx =  Estusuario::select([
            'estusuarios.id',
            'estusuarios.estado',
            'estusuarios.sis_esta_id',
            'parametros.nombre',
            'sis_estas.s_estado'
        ])
        ->join('parametros', 'estusuarios.prm_formular_id', '=', 'parametros.id')
            ->join('sis_estas', 'estusuarios.sis_esta_id', '=', 'sis_estas.id');
        return $this->getDtGeneral($dataxxxx, $request);
    }
}

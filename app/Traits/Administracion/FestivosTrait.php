<?php

namespace App\Traits\Administracion;

use App\Models\Sistema\SisDiaFestivo;
use App\Models\Usuario\Estusuario;
use App\Traits\DatatableTrait;

/**
 * Este trait permite realizar los calculos para encontrar cuantos días adicionales se le darán
 * terminado el mes para el carge de información
 */
trait FestivosTrait
{
    use DatatableTrait;
    public function getListados($request)
    {
        $dataxxxx =  SisDiaFestivo::select([
            'sis_dia_festivos.id',
            'sis_dia_festivos.dia',
            'sis_dia_festivos.mes',
            'sis_dia_festivos.anio',
            'sis_esta_id',
            'sis_estas.s_estado'
        ])
            ->join('sis_estas', 'sis_dia_festivos.sis_esta_id', '=', 'sis_estas.id');
        return $this->getDtGeneral($dataxxxx, $request);
    }
}

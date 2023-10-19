<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class tramiterespuesta extends Model
{
    protected $connection = 'oracleexterna';
    protected $table = 'tramiterespuesta as TR';
    public $timestamps = false;

    protected $fillable = [
        'CONSECUTIVO',
        'NUM_SOLICITUD',
        'ID_TRAMITE',
        'NUM_PASO',
        'FEC_RESPUESTA',
        'TEX_RESPUESTA',
        'ID_USU_ADM_CONTESTA',
        'ID_USU_ADM',
        'ESTADO_TRAMITE',
        'NUM_PASO_ANTERIOR',
        'VIGENCIA',
        'CAMBIO',
        'REGRESO',
        'ASIGNADO_POR',
        'ASIGNADO_A',
        'ID_DEPENDENCIA_REG',
        'ID_DEPENDENCIA_ASIG',
        'VAL_DEPENDENCIA',
        'ID_ENTIDAD_REMITE',
        'CODIGO_ENTIDAD_REMITE',
        'ID_TIPO_GESTION',
        'ID_MATERIALIZACION',
        'ID_TIPO_GESTION',
        
        ];

    public function realizarCambioDespuesDe5Dias($dias)
    {
      $fechaCreacion = Carbon::parse($this->fec_respuesta);
      
      $fechaCambio = $fechaCreacion->addWeekdays($dias);
      
      if (Carbon::now()->isSameDay($fechaCambio) || Carbon::now()->gt($fechaCambio)) {
        $this->update(['ESTADO_TRAMITE' => 'Finalizado']);
      }
}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class tramiteusuario extends Model
{
    protected $connection = 'oracleexterna';
//    protected $table = 'usuario_rol';
    protected $table = 'tramiteusuario as TU';
    public $timestamps = false;

    protected $fillable = [
        'CONSECUTIVO',
        'NUM_SOLICITUD',
        'ID_TRAMITE',
        'FEC_SOLICITUD_TRAMITE',
        'ESTADO_TRAMITE',
        'NUM_PASO_ANTERIOR',
        'VIGENCIA',

        
        ];

    public function realizarCambioDespuesDe5Dias($dias)
    {
      $fechaCreacion = Carbon::parse($this->fec_solicitud_tramite);
      
      $fechaCambio = $fechaCreacion->addWeekdays($dias);
      
      if (Carbon::now()->isSameDay($fechaCambio) || Carbon::now()->gt($fechaCambio)) {
        $this->update(['ESTADO_TRAMITE' => 'Finalizado']);
      }
}
}

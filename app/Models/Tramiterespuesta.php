<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramiterespuesta extends Model
{
    use HasFactory;

    protected $table = 'conci_tramiterespuestas';

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
        'sis_esta_id',
        ];
}


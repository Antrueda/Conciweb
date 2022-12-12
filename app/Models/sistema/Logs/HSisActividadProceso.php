<?php

namespace App\Models\Sistema\Logs;

use Illuminate\Database\Eloquent\Model;

class HSisActividadProceso extends Model
{
    protected $fillable = [
        'sis_actividad_id',
        'sis_proceso_id',
        'tiempo',
        'user_crea_id',
        'user_edita_id',
        'sis_esta_id',

        'id_old', 'metodoxx', 'rutaxxxx', 'ipxxxxxx'
    ];
}

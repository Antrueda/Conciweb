<?php

namespace App\Models\Sistema\Logs;

use Illuminate\Database\Eloquent\Model;

class HSisProceso extends Model
{
    protected $fillable = [
        'sis_proceso_id',
        'sis_mapa_proc_id',
        'prm_proceso_id',
        'nombre',
        'user_crea_id',
        'user_edita_id',
        'sis_esta_id',
                
        'id_old', 'metodoxx', 'rutaxxxx', 'ipxxxxxx'
    ];
}

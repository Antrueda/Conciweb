<?php

namespace App\Models\Sistema\Logs;

use Illuminate\Database\Eloquent\Model;

class HSisDepeServ extends Model
{
    protected $table = 'h_sis_depeservs';
    protected $fillable = [
        'sis_depen_id',
        'sis_servicio_id',
        'user_crea_id',
        'user_edita_id',
        'sis_esta_id',
        'deleted_at',

        'id_old', 'metodoxx', 'rutaxxxx', 'ipxxxxxx'
    ];
}

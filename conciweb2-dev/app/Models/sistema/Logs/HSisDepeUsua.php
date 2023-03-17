<?php

namespace App\Models\Sistema\Logs;

use Illuminate\Database\Eloquent\Model;

class HSisDepeUsua extends Model
{
    protected $table = 'h_sis_depen_user';
    protected $fillable = [
        'user_id',
        'sis_depen_id',
        'i_prm_responsable_id',
        'user_crea_id',
        'user_edita_id',
        'sis_esta_id',

        'id_old', 'metodoxx', 'rutaxxxx', 'ipxxxxxx'
    ];
}

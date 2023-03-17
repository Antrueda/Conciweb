<?php

namespace App\Models\Sistema\Logs;

use Illuminate\Database\Eloquent\Model;

class HSisDocfuen extends Model
{
    protected $fillable = [
        'nombre',
        'user_crea_id',
        'user_edita_id',
        'sis_esta_id',
        'deleted_at',

        'id_old', 'metodoxx', 'rutaxxxx', 'ipxxxxxx'
    ];
}

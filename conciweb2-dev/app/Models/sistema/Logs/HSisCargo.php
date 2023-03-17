<?php

namespace App\Models\Sistema\Logs;

use Illuminate\Database\Eloquent\Model;

class HSisCargo extends Model
{
    protected $fillable = [
        's_cargo',
        'itiestan',
        'itiegabe',
        'itigafin',
        'user_crea_id',
        'user_edita_id',
        'sis_esta_id',
        'estusuario_id',
        'id_old', 'metodoxx', 'rutaxxxx', 'ipxxxxxx'
    ];
}

<?php

namespace App\Models\Sistema\Logs;

use Illuminate\Database\Eloquent\Model;

class HSisDiaFestivo extends Model
{
    protected $fillable = [
        'diafestivo',
        'sis_esta_id',
        'user_crea_id',
        'user_edita_id',
        'id_old', 'metodoxx', 'rutaxxxx', 'ipxxxxxx'
    ];
}

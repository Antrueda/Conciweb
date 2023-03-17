<?php

namespace App\Models\Sistema\Logs;

use Illuminate\Database\Eloquent\Model;

class HSisTabla extends Model
{
    protected $fillable = [
        's_tabla',
        's_descripcion',
        'sis_docfuen_id',
        'sis_esta_id','user_crea_id','user_edita_id',
        'id_old', 'metodoxx', 'rutaxxxx', 'ipxxxxxx'
    ];
}

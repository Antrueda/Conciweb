<?php

namespace App\Models\Sistema\Logs;

use Illuminate\Database\Eloquent\Model;

class HSisDiagnosticos extends Model
{
    protected $fillable = [
        'codigo',
        'simbolo',
        'descripcion',
        'sexo',

        'id_old', 'metodoxx', 'rutaxxxx', 'ipxxxxxx'
    ];
}

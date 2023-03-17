<?php

namespace App\Models\Sistema\Logs;

use Illuminate\Database\Eloquent\Model;

class HSisDepen extends Model
{
    protected $fillable = [
        'nombre',
        'i_prm_cvital_id',
        'i_prm_tdependen_id',

        'i_prm_sexo_id',
        's_direccion',
        'sis_departamento_id',
        'sis_municipio_id',
        'sis_upzbarri_id',
        's_telefono',
        's_correo',
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

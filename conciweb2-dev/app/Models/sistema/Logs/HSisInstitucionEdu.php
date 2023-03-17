<?php

namespace App\Models\Sistema\Logs;

use Illuminate\Database\Eloquent\Model;

class HSisInstitucionEdu extends Model
{
    protected $fillable = [
        's_nombre',
        's_telefono',
        'user_crea_id',
        's_email',
        'sis_municipio_id',
        'sis_departamento_id',
        'i_prm_sector_id',
        'i_usr_rector_id',
        'i_usr_secretario_id',
        'i_usr_coord_academico_id',
        'user_edita_id',
        'sis_esta_id',
                
        'id_old', 'metodoxx', 'rutaxxxx', 'ipxxxxxx'
    ];
}

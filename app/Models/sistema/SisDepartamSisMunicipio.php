<?php
namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;

class SisDepartamSisMunicipio extends Model
{
    protected $table = 'sis_departam_sis_municipio';
    protected $fillable = [
        
        'sis_departam_id',
        'sis_municipio_id',
        'sis_esta_id',
    ];
}

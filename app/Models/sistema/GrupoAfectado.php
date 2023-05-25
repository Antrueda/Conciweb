<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoAfectado extends Model
{
    use HasFactory;
    protected $table = 'gruposafectados';
    
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'sis_esta_id',
        'created_at',
        'updated_at',
    ];

    public static function combo($cabecera, $ajaxxxxx)
    {
        $comboxxx = [];
        if ($cabecera) {
            if ($ajaxxxxx) {
                $comboxxx[] = [
                    'valuexxx' => '',
                    'optionxx' => 'Seleccione'
                ];
            } else {
                $comboxxx = [
                    '' => 'Seleccione'
                ];
            }
        }
        $parametr = GrupoAfectado::select(['id as valuexxx', 'nombre as optionxx'])
            ->where('sis_esta_id', '1')
            ->orderBy('nombre', 'asc')
            ->get();
        foreach ($parametr as $registro) {
            if ($ajaxxxxx) {
                $comboxxx[] = [
                    'valuexxx' => $registro->valuexxx,
                    'optionxx' => $registro->optionxx
                ];
            } else {
                $comboxxx[$registro->valuexxx] = $registro->optionxx;
            }
        }
        return $comboxxx;
    }
}

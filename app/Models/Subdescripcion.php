<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdescripcion extends Model
{
    use HasFactory;
    protected $table = 'conci_subdescripcions';
    protected $fillable = [
        'descri_id',
        'subasu_id',
        'sis_esta_id'
      ];

      
    public function descripcion(){
        return $this->belongsTo(Descripciona::class, 'descri_id');
    }
    public function subasunto(){
        return $this->belongsTo(SubAsunto::class, 'subasu_id');
    }

    public static function combo($cabecera, $ajaxxxxx,$asunto)
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
        $parametr = Subdescripcion::select(['sub_asuntos.id as valuexxx', 'sub_asuntos.nombre as optionxx'])
        ->join('asuntos', 'subdescripcions.asunto_id', '=', 'asuntos.id')
        ->join('sub_asuntos', 'subdescripcions.subasu_id', '=', 'sub_asuntos.id')
        ->where('subdescripcions.asunto_id', $asunto)
        ->where('subdescripcions.sis_esta_id', 1)
        ->orderBy('subdescripcions.id', 'asc')
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

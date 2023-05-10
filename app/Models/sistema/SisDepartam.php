<?php

namespace App\Models\Sistema;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SisDepartam extends Model
{
    protected $fillable = ['s_departamento',  'sis_esta_id', 'user_crea_id', 'user_edita_id'];
    protected $attributes = ['sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1];


    public function sis_municipios()
    {
        return $this->hasMany(SisMunicipio::class);
    }


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
          $parametr = SisDepartam::select(['id as valuexxx', 's_departamento as optionxx'])
              ->where('sis_esta_id', '1')
              ->orderBy('s_departamento', 'asc')
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
    public function getComboAjaxUnoAttribute()
    {
        return [['valuexxx' => $this->id, 'optionxx' => $this->s_departamento]];
    }
}

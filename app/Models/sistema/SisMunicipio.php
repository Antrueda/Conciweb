<?php

namespace app\Models\Sistema;

use app\Models\User;
use Illuminate\Database\Eloquent\Model;

class SisMunicipio extends Model {

  protected $fillable = ['s_municipio', 'sis_departam_id', 'simianti_id', 'sis_esta_id', 'user_crea_id', 'user_edita_id'];
  protected $attributes = ['sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1];

  public function sis_departamento() {
    return $this->belongsTo(SisDepartamento::class);
  }

  public static function combo($departam, $ajaxxxxx) {
    $comboxxx = [];
    if ($ajaxxxxx != '') {
      if ($ajaxxxxx == false) {
        $comboxxx = ['' => 'Seleclcione'];
      } else {
        $comboxxx[] = ['valuexxx' => '', 'optionxx' => 'Seleccione'];
      }
    }

    $municipi = SisMunicipio::where(function ($dataxxxx) use ($departam) {
              $dataxxxx->where('sis_departamento_id', $departam);
            })->get();

    foreach ($municipi as $registro) {
      if ($ajaxxxxx) {
        $comboxxx[] = ['valuexxx' => $registro->id, 'optionxx' => $registro->s_municipio];
      } else {
        $comboxxx[$registro->id] = $registro->s_municipio;
      }
    }

    return $comboxxx;
  }

  public function creador() {
    return $this->belongsTo(User::class, 'user_crea_id');
  }

  public function editor() {
    return $this->belongsTo(User::class, 'user_edita_id');
  }

}

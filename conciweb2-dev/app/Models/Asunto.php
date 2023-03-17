<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asunto extends Model
{
    use HasFactory;
    protected $table = 'conci_asuntos';

    protected $fillable = [
        'nombre',
        'sis_esta_id'
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
          $parametr = Asunto::select(['id as valuexxx', 'nombre as optionxx'])
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

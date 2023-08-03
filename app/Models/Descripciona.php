<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descripciona extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'sis_esta_id'
      ];
      protected $table = 'conci_descripcionas';

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
          $parametr = Descripciona::select(['id as valuexxx', 'nombre as optionxx'])
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

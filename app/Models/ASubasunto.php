<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ASubasunto extends Model
{
    use HasFactory;

    protected $fillable = [
        'asunto_id',
        'subasu_id',
        'sis_esta_id'
      ];
                                                     
      protected $table = 'conci_a_subasuntos';
      

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
          $parametr = ASubasunto::select(['sub_asuntos.id as valuexxx', 'sub_asuntos.nombre as optionxx'])
          ->join('asuntos', 'a_subasuntos.asunto_id', '=', 'asuntos.id')
          ->join('sub_asuntos', 'a_subasuntos.subasu_id', '=', 'sub_asuntos.id')
          ->where('a_subasuntos.asunto_id', $asunto)
          ->where('a_subasuntos.sis_esta_id', 1)
          ->orderBy('a_subasuntos.id', 'asc')
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


//php artisan db:seed --class=PermisosConsumoAdmin  
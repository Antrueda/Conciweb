<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Texto extends Model
{
    protected $fillable = [
        'texto',
        'tipotexto_id',
        'user_crea_id',
        'user_edita_id',
        'sis_esta_id'
      ];

      public function creador()
      {
        return $this->belongsTo(User::class, 'user_crea_id');
      }

      public function editor()
      {
        return $this->belongsTo(User::class, 'user_edita_id');
      }

      public function TipoTexto()
      {
        return $this->belongsTo(Parametro::class, 'tipotexto_id');
      }
}

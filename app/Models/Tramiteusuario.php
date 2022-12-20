<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramiteusuario extends Model
{
    use HasFactory;
    protected $table = 'conci_tramiteusuarios';
    protected $fillable = [
        'ESTADO_TRAMITE',
        'sis_esta_id'
      ];

      public function asunto()
      {
        return $this->belongsTo(Asunto::class, 'numero05');
      }

      public function subasunto()
      {
        return $this->belongsTo(SubAsunto::class, 'numero06');
      }
}

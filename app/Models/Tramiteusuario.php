<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramiteusuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'ESTADO_TRAMITE',
        'sis_esta_id'
      ];
}

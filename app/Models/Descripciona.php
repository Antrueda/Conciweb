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
      
}

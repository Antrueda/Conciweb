<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConciRepartoweb extends Model
{
    use HasFactory;

    protected $fillable = [
        'ccfuncionario',
        'contador',
        'estado',
        'fechaing',
        'correo',
        'email',
        'fechafin'
      ];

      protected $table = 'conci_referentes';


}

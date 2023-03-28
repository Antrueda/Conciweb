<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salario extends Model
{
    use HasFactory;


    protected $fillable = [
        'numero',
        'maximo'
      ];

      protected $table = 'conci_salarios';
}

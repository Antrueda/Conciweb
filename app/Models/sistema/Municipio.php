<?php

namespace App\Models\Sistema;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $connection = 'oracleexterna';
//    protected $table = 'usuario_rol';
    protected $table = 'municipios';
    public $timestamps = false;
}
}

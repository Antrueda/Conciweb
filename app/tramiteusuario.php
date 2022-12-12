<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tramiteusuario extends Model
{
    protected $connection = 'oracleexterna';
//    protected $table = 'usuario_rol';
    protected $table = 'tramiteusuario as TU';
    public $timestamps = false;
}

<?php

namespace App\Models\Sistema;
use DB;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Tabdepatamento extends Model
{
    protected $connection = 'oracleexterna';
//    protected $table = 'usuario_rol';
    protected $table = 'tab_departamento';
    public $timestamps = false;
  
}


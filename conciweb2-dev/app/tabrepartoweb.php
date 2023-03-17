<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tabrepartoweb extends Model
{
    protected $connection = 'oracleexterna';
//    protected $table = 'usuario_rol';
    protected $table = 'TAB_REPARTO_WEB as TR';
    public $timestamps = false;
}

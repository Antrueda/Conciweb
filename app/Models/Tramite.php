<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;
    protected $connection = 'oracleexterna';
//    protected $table = 'usuario_rol';
    protected $table = 'tramiteusuario as TU';
    public $timestamps = false;
}

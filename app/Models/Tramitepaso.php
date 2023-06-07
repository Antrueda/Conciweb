<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramitepaso extends Model
{
    use HasFactory;
    protected $connection = 'oracleexterna';
//    protected $table = 'usuario_rol';
    protected $table = 'tramitepaso';
    public $timestamps = false;
}

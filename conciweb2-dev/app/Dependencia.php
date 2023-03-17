<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    protected $connection = 'oracleexterna';
    protected $table = 'dependencia';
    protected $primaryKey = 'consecutivo';


    use HasFactory;
}

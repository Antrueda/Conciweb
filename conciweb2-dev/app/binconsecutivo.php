<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class binconsecutivo extends Model
{
    protected $connection = 'oracleexterna';
    protected $table = 'binconsecutivo';
    public $timestamps = false;
}

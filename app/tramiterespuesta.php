<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tramiterespuesta extends Model
{
    protected $connection = 'oracleexterna';
    protected $table = 'tramiterespuesta as TR';
    public $timestamps = false;
}

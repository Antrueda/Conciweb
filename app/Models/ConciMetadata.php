<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConciMetadata extends Model
{
    use HasFactory;

    protected $fillable = 
    ['ip', 'num_solicitud', 'plataforma','pais','ciudad','explorador'];
}

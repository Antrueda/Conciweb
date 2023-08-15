<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConciDocumento extends Model
{
    use HasFactory;

    protected $fillable = 
    ['nombreOriginalFile', 'rutaFinalFile', 'descripcion'];
}

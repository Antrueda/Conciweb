<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DCondicionProteccion extends Model
{
    use HasFactory;

    protected $table = 'dcondicionesproteccion';

    protected $fillable = [
        'id',
        'id_condicion',
        'nombre',
        'habilitado',
        'created_at',
        'updated_at',
    ];
}

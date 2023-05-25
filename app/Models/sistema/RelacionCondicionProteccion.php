<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelacionCondicionProteccion extends Model
{
    use HasFactory;

    protected $table = 'relacionescondicionesproteccion';

    protected $fillable = [
        'id',
        'condicion',
        'relacion',
        'created_at',
        'updated_at',
    ];
}

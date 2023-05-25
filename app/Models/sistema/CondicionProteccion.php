<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CondicionProteccion extends Model
{
    use HasFactory;
    protected $table = 'condicionesproteccion';
    
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'imagen_on',
        'imagen_off',
        'habilitado',
        'tabla_desplegable',
        'nombre_tabla_desplegable',
        'created_at',
        'updated_at',
    ];

    public function parametros(){
        return $this->hasMany(DCondicionProteccion::class, 'id_condicion');
    }

}

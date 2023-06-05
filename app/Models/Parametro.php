<?php

namespace App\Models;

use app\Models\Indicadores\InDocPregunta;
use app\Models\Indicadores\InPregunta;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $fillable = ['nombre', 'sis_esta_id', ];

    

    protected $table = 'conci_parametros';

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }
    public function getComboAttribute()
    {
        return [$this->id => $this->nombre];
    }
    public function getComboAjaxUnoAttribute()
    {
        return [['valuexxx' => $this->id, 'optionxx' => $this->nombre]];
    }
    public function getComboAjaxRegistroAttribute()
    {
        return ['valuexxx' => $this->id, 'optionxx' => $this->nombre];
    }
    public function temas()
    {
        return $this->belongsToMany(Tema::class);
    }
    public function creador()
    {
        return $this->belongsTo(User::class, 'user_crea_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'user_edita_id');
    }

   
}

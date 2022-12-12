<?php

namespace App\Models\Sistema;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SisLocalidad extends Model{
    protected $fillable = ['s_localidad', 'sis_esta_id', 'user_crea_id', 'user_edita_id'];

    protected $attributes = ['sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1];

    public static function combo(){
        $comboxxx = [''=>'Seleccione'];
        foreach (SisLocalidad::get() as $localida) {
            $comboxxx[$localida->id] = $localida->s_localidad;
        }
        return $comboxxx;
    }

    public function sis_localupzs(){
        return $this->hasMany(SisLocalupz::class);
    }

    public function creador(){
        return $this->belongsTo(User::class, 'user_crea_id');
    }

    public function editor(){
        return $this->belongsTo(User::class, 'user_edita_id');
    }
}

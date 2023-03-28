<?php

namespace app\Models\Sistema;

use Illuminate\Database\Eloquent\Model;

class SisLocalupz extends Model
{
    protected $fillable = ['sis_upz_id', 'sis_localidad_id',  'sis_esta_id', 'user_crea_id', 'user_edita_id'];

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_crea_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'user_edita_id');
    }
    public function sis_esta()
    {
        return $this->belongsTo(SisEsta::class);
    }
    public function sis_localidad()
    {
        return $this->belongsTo(SisLocalidad::class);
    }
    public function sis_upz()
    {
        return $this->belongsTo(SisUpz::class);
    }
    public function sis_upzbarris()
    {
        return $this->hasMany(SisUpzbarri::class);
    }
}

<?php

namespace App\Models;

use App\Models\sistema\SisPestania;
use Spatie\Permission\Models\Permission;

class Permissionext extends Permission
{
    protected $fillable = ['sis_esta_id', 'name','descripcion', 'guard_name','sis_pestania_id'];
    protected $attributes = ['sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1,'sis_pestania_id'=>1];
    public function creador()
    {
        return $this->belongsTo(User::class, 'user_crea_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'user_edita_id');
    }
    public function sis_pestania()
    {
        return $this->belongsTo(SisPestania::class);
    }
}

<?php

namespace app\Models\Sistema;

use app\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ParametroTema extends Pivot
{
    protected $fillable = [ 'parametro_id','tema_id', 'sis_esta_id' ,'user_crea_id','user_edita_id'];
    protected $attributes = ['sis_esta_id' => 1,'user_crea_id'=>1,'user_edita_id'=>1];

    protected $table = 'parametro_tema';

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_crea_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'user_edita_id');
    }
}

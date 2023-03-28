<?php

namespace app\Models\Sistema;

use app\Models\User;
use Illuminate\Database\Eloquent\Model;

class SisPai extends Model
{
    protected $fillable = ['s_pais', 's_iso', 'sis_esta_id', 'user_crea_id', 'user_edita_id'];
    protected $attributes = ['sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1];

    public function sis_departamentos()
    {
        return $this->belongsToMany(SisDepartamento::class);
    }
    public static function combo($cabecera, $ajaxxxxx)
    {
        $comboxxx = [];
        if ($cabecera){
            if ($ajaxxxxx) {
                $comboxxx[] =  ['valuexxx'=>'' , 'optionxx'=>'Seleccione'];
            }else {
                $comboxxx = ['' => 'Seleccione'];
            }

        }

        foreach (SisPai::get() as $sispaisx) {
            if ($ajaxxxxx) {
                $comboxxx[] = ['valuexxx'=>$sispaisx->id , 'optionxx'=>$sispaisx->s_pais];
            }else{
                $comboxxx[$sispaisx->id] = $sispaisx->s_pais;
            }
        }
        return $comboxxx;
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

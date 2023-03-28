<?php

namespace app\Models\Sistema;

use app\Models\User;
use Illuminate\Database\Eloquent\Model;

class SisDepartamento extends Model
{
    protected $fillable = ['s_departamento', 'sis_pai_id', 's_iso', 'sis_esta_id', 'user_crea_id', 'user_edita_id'];
    protected $attributes = ['sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1];

    public function sis_pai()
    {
        return $this->belongsTo(SisPai::class);
    }
    public function sis_municipios()
    {
        return $this->hasMany(SisMunicipio::class);
    }

    public static function combo($idpadrex, $esajaxxx)
    {
        $comboxxx = [];
        if ($esajaxxx == false) {
            $comboxxx = ['' => 'Seleccione'];

        } else {
            $comboxxx[] = ['valuexxx' => '', 'optionxx' => 'Seleccione'];
        }

        foreach (SisDepartamento::where(function ($dataxxxx) use ($idpadrex) {

                $dataxxxx->where('sis_pai_id', $idpadrex);


        })
            ->get() as $registro) {
            if ($esajaxxx) {
                $comboxxx[] = ['valuexxx' => $registro->id, 'optionxx' => $registro->s_departamento];
            } else {
                $comboxxx[$registro->id] = $registro->s_departamento;
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

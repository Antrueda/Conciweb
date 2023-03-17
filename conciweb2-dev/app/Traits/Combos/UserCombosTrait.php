<?php

namespace App\Traits\Combos;

use App\Models\sistema\SisDepen;
use App\Models\sistema\SisMunicipio;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait UserCombosTrait
{
    use EstructuraComboTrait;
    public function userComboRolUCT($dataxxxx)
    {
      
        if (!isset($dataxxxx['cabecera'])) {
            $dataxxxx['cabecera']=true;
        }
        if (!isset($dataxxxx['ajaxxxxx'])) {
            $dataxxxx['ajaxxxxx']=false;
        }       
        $comboxxx = $this->getCabecera($dataxxxx);
        $userxxxx = User::select(['users.id', 's_primer_nombre', 's_documento', 's_primer_apellido', 's_segundo_apellido', 's_segundo_nombre', 'sis_cargo_id'])->where(function ($queryxxx) use ($dataxxxx) {
            if (isset($dataxxxx['notinxxx'])) {
                $queryxxx->whereNotIn('users.id', $dataxxxx['notinxxx']);
            }
            $queryxxx->where('users.sis_esta_id', 1);
        })
        ->orWhere(function ($queryxxx) use ($dataxxxx) {
            $queryxxx->where('users.id',  $dataxxxx['usersele']);
        })
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->whereIn('model_has_roles.role_id', $dataxxxx['rolxxxxx'])
            ->groupBy('users.id', 's_primer_nombre', 's_documento', 's_primer_apellido', 's_segundo_apellido', 's_segundo_nombre', 'sis_cargo_id')
            ->orderBy('s_primer_nombre')
            ->orderBy('s_primer_apellido')
            ->get();
        foreach ($userxxxx as $registro) {
            if ($dataxxxx['ajaxxxxx']) {
                $comboxxx[] = ['valuexxx' => $registro->id, 'optionxx' => $registro->getDocNombreCompletoCargoAttribute()];
            } else {
                $comboxxx[$registro->id] = $registro->getDocNombreCompletoCargoAttribute();
            }
        }
        return $comboxxx;
    }

    /** listar todos o el usuario que se seleccionó */
    public function getUsuarioUCT($dataxxxx)
    {
        if (!isset($dataxxxx['cabecera'])) {
            $dataxxxx['cabecera']=true;
        }
        if (!isset($dataxxxx['ajaxxxxx'])) {
            $dataxxxx['ajaxxxxx']=false;
        }
        $comboxxx = $this->getCabecera($dataxxxx);
        $dataxxxx['dataxxxx'] = User::where(function ($queryxxx) use ($dataxxxx) {
            if ($dataxxxx['usersele'] > 0) { 
                $queryxxx->where('id', $dataxxxx['usersele']);
            }
        })->get();


        foreach ($dataxxxx['dataxxxx'] as $registro) {
            if ($dataxxxx['ajaxxxxx']) {
                $comboxxx[] = ['valuexxx' => $registro->id, 'optionxx' => $registro->getDocNombreCompletoCargoAttribute()];
            } else {
                $comboxxx[$registro->id] = $registro->getDocNombreCompletoCargoAttribute();
            }
        }
        return $comboxxx;
    }


    public function getUpiUsuarioUCT($dataxxxx)
    {
        if (!isset($dataxxxx['cabecera'])) {
            $dataxxxx['cabecera']=true;
        }
        if (!isset($dataxxxx['ajaxxxxx'])) {
            $dataxxxx['ajaxxxxx']=false;
        }
        $comboxxx = $this->getCabecera($dataxxxx);

        $dataxxxx['dataxxxx'] = SisDepen::join('sis_depen_user', 'sis_depens.id', '=', 'sis_depen_user.sis_depen_id')
        ->where(function($queryxxx){
            $queryxxx->where('user_id', Auth::user()->id);
            $queryxxx->where('sis_depen_user.sis_esta_id', 1);

        })
        ->orWhere(function ($queryxxx) use ($dataxxxx) {
            $queryxxx->where('sis_depens.id',  $dataxxxx['optisele']);
        })
            ->get(['sis_depens.id', 'sis_depens.nombre']);


            foreach ($dataxxxx['dataxxxx'] as $registro) {
                if ($dataxxxx['ajaxxxxx']) {
                    $comboxxx[] = ['valuexxx' => $registro->id, 'optionxx' => $registro->nombre];
                } else {
                    $comboxxx[$registro->id] = $registro->nombre;
                }
            }
        return $comboxxx;
    }
}
//

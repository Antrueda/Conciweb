<?php

namespace App\Models\Usuario;

use App\Models\Indicadores\Administ\Area;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolUsuario extends Model
{
    protected $table = 'model_has_roles';
    protected $fillable = [
        'role_id',
        'model_id',
        'model_type',

    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function transaccion($dataxxxx, $objetoxx)
    {
        $usuariox = DB::transaction(function () use ($dataxxxx, $objetoxx) {
            $dataxxxx['model_type']='App\Models\User';
            $dataxxxx['user_edita_id'] = Auth::user()->id;
            if ($objetoxx != '') {
                $objetoxx->update($dataxxxx);
            } else {
                $dataxxxx['user_crea_id'] = Auth::user()->id;
                $objetoxx = RolUsuario::create($dataxxxx);
            }
            return $objetoxx;
        }, 5);
        return $usuariox;
    }
    public static function getUsuarioRoles($dataxxxx)
    {
        $comboxxx = [];
        if ($dataxxxx['cabecera']) {
            if ($dataxxxx['ajaxxxxx']) {
                $comboxxx[] = ['valuexxx' => '', 'optionxx' => 'Seleccione'];
            } else {
                $comboxxx = ['' => 'Seleccione'];
            }
        }

        $notinxxx = Role::whereNotIn('id', RolUsuario::whereNotIn('role_id', [$dataxxxx['selectxx']])
            ->where('model_id', $dataxxxx['padrexxx'])
            ->get(['role_id']))
            ->get();

        foreach ($notinxxx as $registro) {
            if ($dataxxxx['ajaxxxxx']) {
                $comboxxx[] = ['valuexxx' => $registro->id, 'optionxx' => $registro->name];
            } else {
                $comboxxx[$registro->id] = $registro->name;
            }
        }
        return $comboxxx;
    }
}
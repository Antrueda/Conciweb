<?php

namespace App\Traits\Administracion;

use App\Models\User;
use App\Models\Usuario\Estusuario;
use App\Traits\DatatableTrait;

/**
 * Este trait permite realizar los calculos para encontrar cuantos días adicionales se le darán
 * terminado el mes para el carge de información
 */
trait UsuariosTrait
{
    use DatatableTrait;
    public function getUsuarios($request)
    {
        $dataxxxx =  User::select([

            'users.id',
            'users.s_documento',
            'users.s_primer_nombre',
            'users.s_segundo_nombre',
            'users.s_primer_apellido',
            'users.s_segundo_apellido',
            'users.sis_esta_id',
            'users.email',
            'roles.name',
            'parametros.nombre',
            'sis_estas.s_estado'
        ])
            ->join('sis_estas', 'users.sis_esta_id', '=', 'sis_estas.id')
            ->join('parametros', 'users.prm_tvinculacion_id', '=', 'parametros.id')
            ->join('model_has_roles', function ($join) {
                $join->on('users.id', '=', 'model_has_roles.model_id')
                     ->where('model_has_roles.model_type', User::class)
                     ->where('model_has_roles.sis_esta_id', 1);
            })
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id');

        return $this->getDtGeneral($dataxxxx, $request);
    }
}

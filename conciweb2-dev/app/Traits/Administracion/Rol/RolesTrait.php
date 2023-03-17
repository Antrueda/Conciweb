<?php

namespace App\Traits\Administracion\Rol;

use App\Models\Permissionext;
use App\Models\Roleext;
use App\Traits\DatatableTrait;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

/**
 * Este trait permite realizar los calculos para encontrar cuantos días adicionales se le darán
 * terminado el mes para el carge de información
 */
trait RolesTrait
{
    use DatatableTrait;
    public function lista(Request $request)
    {
        if ($request->ajax()) {
            // ddd($request);
            $request->routexxx = [$this->opciones['routxxxx'],'rolesxxx'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx = Role::select(
				[
					'roles.id',
					'roles.name',
       
   

				]
                );
		

            return $this->getDt($dataxxxx, $request);
        }
    }

    public function getPermisos($request)
    {
        $notinxxx =  Role::select([
            'role_has_permissions.permission_id',
        ])
            ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->where('roles.id', $request->padrexxx)->get();
        $dataxxxx =  Permissionext::select([
            'permissions.id',
            'permissions.name',


        ])

             ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')


            ->whereNotIn('permissions.id', $notinxxx);
        return $this->getDtPermisoRol($dataxxxx, $request);
    }
    public function getPermisosRol($request)
    {
        $dataxxxx =  Role::select([
            'permissions.id',
            'permissions.name',
        ])

            ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('roles.id', $request->padrexxx);
        return $this->getDtPermisoRol($dataxxxx, $request);
    }
}

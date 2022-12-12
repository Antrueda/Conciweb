<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesYPermisosSeeder extends Seeder
{
    public function getPermisos($dataxxxx)
    {
        $listaxxx = 'Permiso que permite ver el contenido para: ';

        $descripc = [
            'leer' => $listaxxx,
            'crear' => 'Permiso que permite crear registro para: ',
            'editar' => 'Permiso que permite editar registro para: ',
            'borrar' => 'Permiso que permite inactivar registro para: ',
            'activarx' => 'Permiso que permite activar registro para: ',
            'factorxx' => 'Permioso que permite ver los: ',
            'metaxxxx' => 'Permioso que permite ver las: ',
            'psicologo' => 'Permioso que permite ver contenido de psicologo: ',
            'social' => 'Permioso que permite ver contenido de trabajador social: ',
            'modulo' => 'Permioso que permite ver el menu de: ',
            'admin' => 'Permiso para administrar: ',
            'area-admin' => 'Permiso para administrar: ',
            'tipo-admin' => 'Permiso para administrar: ',
            'sub-tipo-admin' => 'Permiso para administrar: '
        ];
        foreach ($dataxxxx['permisos'] as $value) {
            Permission::create([
                'name' => $dataxxxx['permisox'] . '-' . $value,
                
            ]);
        }
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Restablecer roles y permisos en caché
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // crear permisos permiso
        $this->getPermisos(['permisox' => 'administrar', 'permisos' => ['leer', 'crear', 'editar', 'borrar','modulo'], 'compleme' => 'Permisos']);

        $this->getPermisos(['permisox' => 'parametro', 'permisos' => ['leer', 'crear', 'editar', 'borrar'], 'compleme' => 'PARAMETROS']);

        $this->getPermisos(['permisox' => 'tema', 'permisos' => ['leer', 'crear', 'editar', 'borrar'], 'compleme' => 'TEMA']);
        // crear permisos para rol
        $this->getPermisos(['permisox' => 'textosadmin', 'permisos' => ['modulo', 'crear', 'editar', 'borrar'], 'compleme' => 'Administracion de textos']);

        $this->getPermisos(['permisox' => 'textos', 'permisos' => ['leer', 'crear', 'editar', 'borrar','activarx'], 'compleme' => 'Administracion de textos']);
        // crear permisos rol
        $this->getPermisos(['permisox' => 'asunto', 'permisos' => ['leer', 'crear', 'editar', 'borrar','activarx'], 'compleme' => 'Administracion de asunto']);

        $this->getPermisos(['permisox' => 'subasunto', 'permisos' => ['leer', 'crear', 'editar', 'borrar','activarx'], 'compleme' => 'Administracion de subasunto']);

        $this->getPermisos(['permisox' => 'asignasunto', 'permisos' => ['leer', 'crear', 'editar', 'borrar','activarx'], 'compleme' => 'Administracion de asignar subasunto']);

        $this->getPermisos(['permisox' => 'descripcion', 'permisos' => ['leer', 'crear', 'editar', 'borrar','activarx'], 'compleme' => 'Administracion de descripcion de subasunto']);

        $this->getPermisos(['permisox' => 'asignadescri', 'permisos' => ['leer', 'crear', 'editar', 'borrar','activarx'], 'compleme' => 'Administracion de asignar descripcion']);

        $this->getPermisos(['permisox' => 'asuntomodulo', 'permisos' => ['modulo'], 'compleme' => 'modulo de asunto']);
        

        $this->getPermisos(['permisox' => 'rolesxxx', 'permisos' => ['leer', 'crear', 'editar', 'borrar','activarx'], 'compleme' => 'permisos de un rol']);
        
        $this->getPermisos(['permisox' => 'usuario', 'permisos' => ['leer', 'crear', 'editar', 'borrar','activarx'], 'compleme' => 'permisos de un rol']);


        $this->getPermisos(['permisox' => 'roleusua', 'permisos' => ['leer', 'crear', 'editar', 'borrar','activarx'], 'compleme' => 'permisos de un rol']);

        $this->getPermisos(['permisox' => 'permiso', 'permisos' => ['leer', 'crear', 'editar', 'borrar','activarx'], 'compleme' => 'permisos de un rol']);

        $this->getPermisos(['permisox' => 'permirol', 'permisos' => ['leer', 'crear', 'editar', 'borrar','activarx'], 'compleme' => 'permisos de un rol']);

 
        Role::create(['name' => 'super-administrador',])->givePermissionTo(Permission::all());
        Role::create(['name' => 'administrador',])->givePermissionTo(Permission::all());
        Role::create(['name' => 'consulta',]);
        Role::create(['name' => 'conciliacion',]);
        $user=User::where('consec',52283026)->first();
        $user->assignRole('super-administrador');
        
        
            
    }
}

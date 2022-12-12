<?php

namespace App\Traits\Seguridad\UsuarioRol;



/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait DataTablesTrait
{
    /**
     * grabar o actualizar registros para paises
     *
     * @param array $dataxxxx
     * @return $usuariox
     */
    public function getTablas($dataxxxx)
    {
        $dataxxxx['tablasxx'] = [
            [
                'titunuev' => 'ASIGNAR ROL',
                'titulist' => 'LISTA DE ROLES ASIGNADOS',
                'archdttb' => $dataxxxx['rutacarp'] . 'Acomponentes.Adatatable.index',
                'vercrear' => true,
                'urlxxxxx' => route('roleusua.listaxxx', $dataxxxx['parametr']),
                'permtabl' => [
                    $dataxxxx['permisox'] . '-leer',
                    $dataxxxx['permisox'] . '-crear',
                    $dataxxxx['permisox'] . '-editar',
                    $dataxxxx['permisox'] . '-borrar',
                    $dataxxxx['permisox'] . '-activar',
                ],
                'cabecera' => [
                    [
                        ['td' => 'ACCIONES', 'widthxxx' => 200, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ID', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],                        
                        ['td' => 'NOMBRE', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],   
                        ],
            ],
                'columnsx' => [
                    ['data' => 'botonexx', 'name' => 'botonexx'],
                    ['data' => 'id', 'name' => 'model_has_roles.role_id'],
                    ['data' => 'name', 'name' => 'roles.name'],
                ],
                'tablaxxx' => 'datatable',
                'permisox' => 'roleusua',
                'routxxxx' => 'roleusua',
                'parametr' => $dataxxxx['parametr'],
            ]
        ];
        $dataxxxx['ruarchjs'] = [
            ['jsxxxxxx' => 'TextoAdmin.Texto.Js.tabla']
        ];

        //ddd( $dataxxxx);
        // return $dataxxxx;
        // $dataxxxx['tablasxx'][] =
        //     [
        //         'titunuev' => 'ASIGNAR ROL',
        //         'titulist' => 'LISTA DE ROLES',
        //         'vercrear' => true,
        //         'archdttb' => $dataxxxx['rutacarp'] . 'Acomponentes.Adatatable.index',
        //         'urlxxxxx' => route('roleusua.listaxxx', $dataxxxx['parametr']),
        //         'permtabl' => [
        //             $dataxxxx['permisox'] . '-leer',
        //             $dataxxxx['permisox'] . '-crear',
        //             $dataxxxx['permisox'] . '-editar',
        //             $dataxxxx['permisox'] . '-borrar',
        //             $dataxxxx['permisox'] . '-activar',
        //         ],
        //         'cabecera' => [
        //             [
        //                 ['td' => 'ACCIONES', 'widthxxx' => 200, 'rowspanx' => 1, 'colspanx' => 1],
        //                 ['td' => 'ID', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],                        
        //                 ['td' => 'NOMBRE', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],   
        //                 ],
        //     ],
        //         'columnsx' => [
        //             ['data' => 'botonexx', 'name' => 'botonexx'],
        //             ['data' => 'id', 'name' => 'model_has_roles.id'],
        //             ['data' => 'name', 'name' => 'roles.name'],
        //         ],
        //         'tablaxxx' => 'datatable',
        //         'permisox' => 'roleusua',
        //         'routxxxx' => 'roleusua',
        //         'parametr' => $dataxxxx['parametr'],

        //     ];
        //     $dataxxxx['ruarchjs'] = [
        //     ['jsxxxxxx' => $dataxxxx['rutacarp'] . $dataxxxx['carpetax'] . '.Js.tabla']
        //                 ];
        // //ddd( $dataxxxx);
        return $dataxxxx;
    }
}


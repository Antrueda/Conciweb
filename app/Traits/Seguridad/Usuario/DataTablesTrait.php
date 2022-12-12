<?php

namespace App\Traits\Seguridad\Usuario;



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
                'titunuev' => 'NUEVO USUARIO',
                'titulist' => 'LISTA DE USUARIOS',
                'archdttb' => $dataxxxx['rutacarp'] . 'Acomponentes.Adatatable.index',
                'vercrear' => true,
                'urlxxxxx' => route($dataxxxx['routxxxx'] . '.listaxxx', []),
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
                        ['td' => 'CONCECUTIVO', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],  
                        ['td' => 'CEDULA', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],  
                        ['td' => 'CORREO ELECTRÓNICO', 'widthxxx' => '', 'rowspanx' => 1, 'colspanx' => 1],
                ],
            ],
                'columnsx' => [
                    ['data' => 'botonexx', 'name' => 'botonexx'],
                    ['data' => 'consec', 'name' => 'usuario_rol.consec'],
                    ['data' => 'cedula', 'name' => 'usuario_rol.cedula'],
                    ['data' => 'email', 'name' => 'usuario_rol.email'],
                ],
                'tablaxxx' => 'datatable',
                'permisox' => 'usuario',
                'routxxxx' => 'usuario',
                'parametr' => $this->opciones['parametr'],
            ]
        ];
        $dataxxxx['ruarchjs'] = [
            ['jsxxxxxx' => 'TextoAdmin.Texto.Js.tabla']
        ];

        //ddd( $dataxxxx);
        return $dataxxxx;
    }
}


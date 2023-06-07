<?php

namespace App\Traits\AsignarUsuario\Asignar;



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
                'titunuev' => 'ASIGNAR USUARIO',
                'titulist' => 'LISTA DE USUARIOS ASIGNADOS',
                'archdttb' => $dataxxxx['rutacarp'] . 'Acomponentes.Adatatable.index',
                'vercrear' => true,
                'urlxxxxx' => route($dataxxxx['routxxxx'] . '.listaxxx', []),
                'permtabl' => [
                    $dataxxxx['permisox'] . '-leer',
                    $dataxxxx['permisox'] . '-crear',
                    $dataxxxx['permisox'] . '-editar',
                    $dataxxxx['permisox'] . '-borrar',
                ],
                'cabecera' => [
                    [
               
                        ['td' => 'ID', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'CEDULA', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'CONTADOR', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'EMAIL', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'RECIBE CORREO', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ESTADO', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ACCIONES', 'widthxxx' => 10, 'rowspanx' => 1, 'colspanx' => 1],
                    ]
                ],
                'columnsx' => [
                
                    ['data' => 'id', 'name' => 'conci_referentes.id'],
                    ['data' => 'ccfuncionario', 'name' => 'conci_referentes.ccfuncionario'],
                    ['data' => 'contador', 'name' => 'conci_referentes.contador'],
                    ['data' => 'email', 'name' => 'conci_referentes.email'],
                    ['data' => 'correo', 'name' => 'conci_referentes.correo'],
                    ['data' => 'estado', 'name' => 'conci_referentes.estado'],
                    ['data' => 'botonexx', 'name' => 'botonexx'],
                ],
                'tablaxxx' => 'datatable',
                'permisox' => $dataxxxx['permisox'],
                'routxxxx' => $dataxxxx['routxxxx'] ,
                //'routxxxx' => $dataxxxx['routxxxx'] . '.search',
         
                'parametr' => [],
            ]
        ];
        $dataxxxx['ruarchjs'] = [
            ['jsxxxxxx' => 'TextoAdmin.Texto.Js.tabla']
        ];

        return $dataxxxx;
    }
}

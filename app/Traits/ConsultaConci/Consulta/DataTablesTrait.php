<?php

namespace App\Traits\ConsultaConci\Consulta;



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
                'titunuev' => 'NUEVO TEXTO',
                'titulist' => 'LISTA DE CONCILIACIONES',
                'archdttb' => $dataxxxx['rutacarp'] . 'Acomponentes.Adatatable.index',
                'vercrear' => false,
                'urlxxxxx' => route($dataxxxx['routxxxx'] . '.listaxxx', []),
                'permtabl' => [
                    $dataxxxx['permisox'] . '-leer',
                    $dataxxxx['permisox'] . '-crear',
                    $dataxxxx['permisox'] . '-editar',
                    $dataxxxx['permisox'] . '-borrar',
                ],
                'cabecera' => [
                    [
                        ['td' => 'NUM SOLICITUD', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'NOMBRE', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'FECHA SOLICITUD', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ESTADO', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ACCIONES', 'widthxxx' => 1, 'rowspanx' => 1, 'colspanx' => 1],
                    ]
                ],
                'columnsx' => [
                  
                    ['data' => 'num_solicitud', 'name' => 'conci_tramiteusuarios.num_solicitud', ],
                    ['data' => 'nombre_completo', 'name' => 'nombre_completo'],
                    ['data' => 'fec_solicitud_tramite', 'name' => 'conci_tramiteusuarios.fec_solicitud_tramite'],
                    ['data' => 'estadodoc', 'name' => 'conci_tramiteusuarios.estadodoc'],
                    ['data' => 'botonexx', 'name' => 'botonexx'],
                ],
                'tablaxxx' => 'datatable',
                'permisox' => $dataxxxx['permisox'],
                'routxxxx' => $dataxxxx['routxxxx'],
                'parametr' => [],
            ]
        ];
        $dataxxxx['ruarchjs'] = [
            ['jsxxxxxx' => 'Consulta\.Consulta.Js.tabla']
        ];
    
        return $dataxxxx;
    }

    public function getTablasFinalizado($dataxxxx)
    {

        $dataxxxx['tablasxx'] = [
            [
                'titunuev' => 'NUEVO TEXTO',
                'titulist' => 'LISTA DE CONCILIACIONES',
                'archdttb' => $dataxxxx['rutacarp'] . 'Acomponentes.Adatatable.index',
                'vercrear' => false,
                'urlxxxxx' => route($dataxxxx['routxxxx'] . '.listafin', []),
                'permtabl' => [
                    $dataxxxx['permisox'] . '-leer',
                    $dataxxxx['permisox'] . '-crear',
                    $dataxxxx['permisox'] . '-editar',
                    $dataxxxx['permisox'] . '-borrar',
                ],
                'cabecera' => [
                    [
                        ['td' => 'NUM SOLICITUD', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'NOMBRE', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'FECHA SOLICITUD', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'FECHA ACTUALIZACIÓN', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ESTADO', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ACCIONES', 'widthxxx' => 1, 'rowspanx' => 1, 'colspanx' => 1],
                    ]
                ],
                'columnsx' => [
                  
                    ['data' => 'num_solicitud', 'name' => 'conci_tramiteusuarios.num_solicitud'],
                    ['data' => 'nombre_completo', 'name' => 'nombre_completo'],
                    ['data' => 'fec_solicitud_tramite', 'name' => 'conci_tramiteusuarios.fec_solicitud_tramite'],
                    ['data' => 'fecha_actualizacion_formateada', 'name' => 'fecha_actualizacion_formateada'],
                    ['data' => 'estadodoc', 'name' => 'conci_tramiteusuarios.estadodoc'],
                    ['data' => 'botonexx', 'name' => 'botonexx'],
                ],
                'tablaxxx' => 'datatable',
                'permisox' => $dataxxxx['permisox'],
                'routxxxx' => $dataxxxx['routxxxx'],
                'parametr' => [],
            ]
        ];
        $dataxxxx['ruarchjs'] = [
            ['jsxxxxxx' => 'Consulta\.Consulta.Js.tabla']
        ];
    
        return $dataxxxx;
    }

    public function getTabladias($dataxxxx)
    {

        $dataxxxx['tablasxx'] = [
            [
                'titunuev' => 'NUEVO TEXTO',
                'titulist' => 'LISTA DE CONCILIACIONES',
                'archdttb' => $dataxxxx['rutacarp'] . 'Acomponentes.Adatatable.index',
                'vercrear' => false,
                'urlxxxxx' => route($dataxxxx['routxxxx'] . '.listadias', []),
                'permtabl' => [
                    $dataxxxx['permisox'] . '-leer',
                    $dataxxxx['permisox'] . '-crear',
                    $dataxxxx['permisox'] . '-editar',
                    $dataxxxx['permisox'] . '-borrar',
                ],
                'cabecera' => [
                    [
                        ['td' => 'NUM SOLICITUD', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'NOMBRE', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'FECHA SOLICITUD', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'FECHA ACTUALIZACIÓN', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'DÍAS', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ESTADO', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ACCIONES', 'widthxxx' => 1, 'rowspanx' => 1, 'colspanx' => 1],
                    ]
                ],
                'columnsx' => [
                  
                    ['data' => 'num_solicitud', 'name' => 'conci_tramiteusuarios.num_solicitud'],
                    ['data' => 'nombre_completo', 'name' => 'nombre_completo'],
                    ['data' => 'fec_solicitud_tramite', 'name' => 'conci_tramiteusuarios.fec_solicitud_tramite'],
                    ['data' => 'fecha_actualizacion_formateada', 'name' => 'fecha_actualizacion_formateada'],
                    ['data' => 'dias_de_diferencia', 'name' => 'dias_de_diferencia'],
                    ['data' => 'estadodoc', 'name' => 'conci_tramiteusuarios.estadodoc'],
                    ['data' => 'botonexx', 'name' => 'botonexx'],
                ],
                'tablaxxx' => 'datatable',
                'permisox' => $dataxxxx['permisox'],
                'routxxxx' => $dataxxxx['routxxxx'],
                'parametr' => [],
            ]
        ];
        $dataxxxx['ruarchjs'] = [
            ['jsxxxxxx' => 'Consulta\.Consulta.Js.tabla']
        ];
    
        return $dataxxxx;
    }


}

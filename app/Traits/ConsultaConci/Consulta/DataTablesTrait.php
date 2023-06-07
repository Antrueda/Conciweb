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
                        ['td' => 'ID TRAMITE', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'FECHA SOLICITUD', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ESTADO', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ACCIONES', 'widthxxx' => 1, 'rowspanx' => 1, 'colspanx' => 1],
                    ]
                ],
                'columnsx' => [
                  
                    ['data' => 'num_solicitud', 'name' => 'conci_tramiteusuarios.num_solicitud'],
                    ['data' => 'id_tramite', 'name' => 'conci_tramiteusuarios.id_tramite'],
                    ['data' => 'fec_solicitud_tramite', 'name' => 'conci_tramiteusuarios.fec_solicitud_tramite'],
                    ['data' => 's_estado', 'name' => 'conci_sis_estas.s_estado'],
                      ['data' => 'botonexx', 'name' => 'botonexx'],
                ],
                'tablaxxx' => 'datatable',
                'permisox' => $dataxxxx['permisox'],
                'routxxxx' => $dataxxxx['routxxxx'],
                'parametr' => [],
            ]
        ];
        $dataxxxx['ruarchjs'] = [
            ['jsxxxxxx' => 'TextoAdmin.Texto.Js.tabla']
        ];
    
        return $dataxxxx;
    }

}

<?php

namespace App\Traits\Administracion\Temas\Combpara;



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
    public function getTablas()
    {

            $this->opciones['tablasxx'] = [
                [
                    'titunuev' => "NUEVA RESPUESTA",
                    'titulist' => "LISTA DE RESPUESTAS",
                    'archdttb' => $this->opciones['rutacarp'] . 'Acomponentes.Adatatable.index',
                    'vercrear' => false,
                    'urlxxxxx' => route($this->opciones['routxxxx'] . '.listaxxx', [$this->opciones['padrexxx']->id]),
                    'permtabl' => [
                        $this->opciones['permisox'] . '-leer',
                        $this->opciones['permisox'] . '-crear',
                        $this->opciones['permisox'] . '-editar',
                        $this->opciones['permisox'] . '-borrar',
                        $this->opciones['permisox'] . '-activar',
                    ],
                    'cabecera' => [
                        [
                            ['td' => 'ACCIONES', 'widthxxx' => 200, 'rowspanx' => 1, 'colspanx' => 1],
                            ['td' => 'ID', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                            ['td' => "RESPUESTA", 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                            ['td' => "HOMOLAGADO", 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                            ['td' => 'ESTADO', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ]
                    ],
                    'columnsx' => [
                        ['data' => 'botonexx', 'name' => 'botonexx'],
                        ['data' => 'id', 'name' => 'parametros.id'],
                        ['data' => 'nombre', 'name' => 'parametros.nombre'],
                        ['data' => 'simianti_id', 'name' => 'parametro_temacombo.simianti_id'],
                        ['data' => 's_estado', 'name' => 'sis_estas.s_estado'],
                    ],
                    'tablaxxx' => 'datatable',
                    'permisox' => $this->opciones['permisox'],
                    'routxxxx' => $this->opciones['routxxxx'],
                    'parametr' => [$this->opciones['padrexxx']->id],
                ],
                [
                    'titunuev' => "NUEVO RESPUESTA",
                    'titulist' => "LISTA OPCIONES DE RESPUESTA",
                    'archdttb' =>$this->opciones['rutacarp'] . 'Acomponentes.Adatatable.index',
                    'vercrear' => false,
                    'urlxxxxx' => route($this->opciones['routxxxx'] . '.listapar', [$this->opciones['padrexxx']->id]),
                    'permtabl' => [
                       $this->opciones['permisox'] . '-leer',
                       $this->opciones['permisox'] . '-crear',
                       $this->opciones['permisox'] . '-editar',
                       $this->opciones['permisox'] . '-borrar',
                       $this->opciones['permisox'] . '-activar',
                    ],
                    'cabecera' => [
                        [
                            ['td' => 'ACCIONES', 'widthxxx' => 200, 'rowspanx' => 1, 'colspanx' => 1],
                            ['td' => 'ID', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                            ['td' => "RESPUESTA", 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                            ['td' => 'ESTADO', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ]
                    ],
                    'columnsx' => [
                        ['data' => 'botonexx', 'name' => 'botonexx'],
                        ['data' => 'id', 'name' => 'parametros.id'],
                        ['data' => 'nombre', 'name' => 'parametros.nombre'],
                        ['data' => 's_estado', 'name' => 'sis_estas.s_estado'],
                    ],
                    'tablaxxx' => 'datatableopc',
                    'permisox' =>$this->opciones['permisox'],
                    'routxxxx' =>$this->opciones['routxxxx'],
                    'parametr' => [$this->opciones['padrexxx']->id],
                ]
            ];



            $this->opciones['ruarchjs'] = [
                ['jsxxxxxx' => $this->opciones['rutacarp'] . $this->opciones['carpetax'] . '.Js.tabla']
            ];
    }
}

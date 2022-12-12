<?php

namespace App\Traits\Administracion\Ubicacion\Localidad;



/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait LocalidadDataTablesTrait
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
                'titunuev' => 'NUEVA UPI/DEPENDENCIA',
                'titulist' => 'LISTA DE UPIS/DEPENDENCIAS',
                'archdttb' =>$this->opciones['rutacarp'] . 'Acomponentes.Adatatable.index',
                'vercrear' => false,
                'urlxxxxx' => route($this->opciones['routxxxx'] . '.listaxxx', []),
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
                        ['td' => 'UPI/DEPENDENCIA', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ESTADO', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                    ]
                ],
                'columnsx' => [
                    ['data' => 'botonexx', 'name' => 'botonexx'],
                    ['data' => 'id', 'name' => 'sis_localidads.id'],
                    ['data' => 's_localidad', 'name' => 'sis_localidads.s_localidad'],
                    ['data' => 's_estado', 'name' => 'sis_estas.s_estado'],
                ],
                'tablaxxx' => 'datatable',
                'permisox' =>$this->opciones['permisox'],
                'routxxxx' =>$this->opciones['routxxxx'],
                'parametr' => [],
            ]
        ];
       $this->opciones['ruarchjs'] = [
            ['jsxxxxxx' =>$this->opciones['rutacarp'] .$this->opciones['carpetax'] . '.Js.tabla']
        ];
    }
}

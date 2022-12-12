<?php

namespace App\Traits\Administracion\Ubicacion\Localupz;



/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait LocalupzDataTablesTrait
{
    /**
     * grabar o actualizar registros para paises
     *
     * @param array $dataxxxx
     * @return $usuariox
     */
    public function getTablasIndexLDT($padrexxx)
    {

       $this->opciones['tablasxx'] = [
            [
                'titunuev' => 'NUEVA UPZ',
                'titulist' => 'LISTA DE UPZ',
                'archdttb' =>$this->opciones['rutacarp'] . 'Acomponentes.Adatatable.index',
                'vercrear' => true,
                'urlxxxxx' => route($this->opciones['routxxxx'] . '.listaxxx', [$padrexxx->id]),
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
                        ['td' => 'UPZ', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ESTADO', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],
                    ]
                ],
                'columnsx' => [
                    ['data' => 'botonexx', 'name' => 'botonexx'],
                    ['data' => 'id', 'name' => 'sis_localupzs.id'],
                    ['data' => 's_upz', 'name' => 'sis_upzs.s_upz'],
                    ['data' => 's_estado', 'name' => 'sis_estas.s_estado'],
                ],
                'tablaxxx' => 'datatable',
                'permisox' =>$this->opciones['permisox'],
                'routxxxx' =>$this->opciones['routxxxx'],
                'parametr' => [$padrexxx->id],
            ]
        ];
       $this->opciones['ruarchjs'] = [
            ['jsxxxxxx' =>$this->opciones['rutacarp'] .$this->opciones['carpetax'] . '.Js.tabla']
        ];
    }
}

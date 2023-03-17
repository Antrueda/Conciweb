<?php

namespace App\Traits\Seguridad;



/**
 * Este trait permite realizar los calculos para encontrar cuantos días adicionales se le darán
 * terminado el mes para el carge de información
 */
trait SeguridadDatatableTrait
{

    public function getTablas()
    {
        $this->opciones['tablasxx'][] =
            [
                'titunuev' => 'CREAR USUARIO',
                'titulist' => 'LISTA DE USUARIOS',
                'vercrear' => true,
                'urlxxxxx' => route('usuario.listaxxx', $this->opciones['parametr']),
                'cabecera' => [
                    [
                        ['td' => 'ACCIONES', 'widthxxx' => 200, 'rowspanx' => 1, 'colspanx' => 1],
                        ['td' => 'ID', 'widthxxx' => 0, 'rowspanx' => 1, 'colspanx' => 1],                        
                        ['td' => 'CORREO ELECTRÓNICO', 'widthxxx' => '', 'rowspanx' => 1, 'colspanx' => 1],
                ],
            ],
                'columnsx' => [
                    ['data' => 'botonexx', 'name' => 'botonexx'],
                    ['data' => 'id', 'name' => 'usuario_rol.consec'],
                    ['data' => 'email', 'name' => 'usuario_rol.email'],
                ],
                'tablaxxx' => 'datatable',
                'permisox' => 'usuario',
                'routxxxx' => 'usuario',
                'parametr' => $this->opciones['parametr'],

            ];
      
        $this->opciones['ruarchjs'] = [
            ['jsxxxxxx' => $this->opciones['rutacarp'] . $this->opciones['carpetax'] . '.Js.tabla']
        ];
        
    }
}

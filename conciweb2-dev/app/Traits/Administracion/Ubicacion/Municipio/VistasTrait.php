<?php

namespace App\Traits\Administracion\Ubicacion\Municipio;

use App\Models\Sistema\SisEsta;

/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait VistasTrait
{
    public function getVista($dataxxxx)
    {
        $this->opciones['estadoxx'] = SisEsta::combo(['cabecera' => false, 'esajaxxx' => false]);
        $this->opciones['rutarchi'] = $this->opciones['rutacarp'] . 'Acomponentes.Acrud.' . $dataxxxx['accionxx'][0];
        $this->opciones['formular'] = $this->opciones['rutacarp'] . $this->opciones['carpetax'] . '.Formulario.' . $dataxxxx['accionxx'][1];
        $this->opciones['ruarchjs'] = [
            ['jsxxxxxx' => $this->opciones['rutacarp'] . $this->opciones['carpetax'] . '.Js.js']
        ];
    }
    public function view($dataxxxx)
    {
        $this->opciones['parametr'][0] = $dataxxxx['padrexxx']->id;
        $this->opciones['departam'] = [$dataxxxx['padrexxx']->id => $dataxxxx['padrexxx']->s_departamento];
        $this->pestania[1][2] = [$dataxxxx['padrexxx']->sis_pai_id];
        $this->pestania[2][2] = [$dataxxxx['padrexxx']->id];
        $this->getBotones(['leer', [$this->opciones['routxxxx'], $this->opciones['parametr']], 2, 'VOLVER A MUNICIPIOS', 'btn btn-sm btn-primary']);
        $this->getVista($dataxxxx);
        // indica si se esta actualizando o viendo
        if ($dataxxxx['modeloxx'] != '') {
            $this->opciones['parametr'][1] = $dataxxxx['modeloxx']->id;
            $this->opciones['modeloxx'] = $dataxxxx['modeloxx'];
            $this->pestania[1][4] = true;
            $this->pestania[1][2] = $this->opciones['parametr'];
            $this->getBotones(['crear', [$this->opciones['routxxxx'] . '.nuevo', [$dataxxxx['padrexxx']->id]], 2, 'NUEVO MUNICIPIO', 'btn btn-sm btn-primary']);
        }
        $this->getPestanias($this->opciones);
        // Se arma el titulo de acuerdo al array opciones
        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->opciones]);
    }
}

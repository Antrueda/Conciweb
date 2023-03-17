<?php

namespace App\Traits\Administracion\Temas\Combo;;

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
        $this->opciones['tituloxx'] = "COMBO";
        $this->opciones['parametr'] = [$this->opciones['padrexxx']->id];
        $this->getVista($dataxxxx);
        $this->opciones['tituhead'] = $this->opciones['padrexxx']->nombre;
        $this->pestania[1][2] =$this->opciones['parametr'];
        $this->getBotones(['leer', [$this->opciones['routxxxx'], $this->opciones['parametr']], 2, 'VOLVER A COMBOS', 'btn btn-sm btn-primary']);
        // indica si se esta actualizando o viendo
        if ($dataxxxx['modeloxx'] != '') {
            $this->opciones['modeloxx'] = $dataxxxx['modeloxx'];
            $this->getBotones(['crear', [$this->opciones['routxxxx'].'.nuevo', $this->opciones['parametr']], 2, 'NUEVO COMBO', 'btn btn-sm btn-primary']);
        }

        $this->getPestanias([]);
        // Se arma el titulo de acuerdo al array opciones
        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->opciones]);
    }
}

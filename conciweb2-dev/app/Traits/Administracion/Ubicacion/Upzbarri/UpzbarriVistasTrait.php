<?php

namespace App\Traits\Administracion\Ubicacion\Upzbarri;

use App\Models\Sistema\SisEsta;

/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait UpzbarriVistasTrait
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
    public function getViewLVT($dataxxxx)
    {
        $this->opciones['localida'] = [$dataxxxx['padrexxx']->id=>$dataxxxx['padrexxx']->sis_upz->s_upz];
        $this->opciones['parametr'] = [$dataxxxx['padrexxx']->id];
        $this->getBotones(['leer', [$this->opciones['routxxxx'], $this->opciones['parametr']], 2, 'VOLVER A BARRIOS', 'btn btn-sm btn-primary']);
        $this->getVista($dataxxxx);
        $this->pestania[4][2] = [$dataxxxx['padrexxx']->sis_localidad_id];
        $this->pestania[6][2]=$this->opciones['parametr'];
        // indica si se esta actualizando o viendo
        $selected=0;
        if ($dataxxxx['modeloxx'] != '') {
            $this->opciones['parametr'][1] = $dataxxxx['modeloxx']->id;
            $this->opciones['modeloxx'] = $dataxxxx['modeloxx'];
            $selected=$this->opciones['modeloxx']->sis_upzbarri_id;
            $this->getBotones(['crear', [$this->opciones['routxxxx'] . '.nuevo', [$this->opciones['parametr'][0]]], 2, 'NUEVO BARRIO', 'btn btn-sm btn-primary']);
        }
        $this->opciones['upzsxxxx'] = $this->getBarriosCT([
            'cabecera'=>true,
            'ajaxxxxx'=>false,
            'padrexxx'=>$this->opciones['parametr'][0],
            'selected'=>[$selected]
            ])['comboxxx'];
        $this->getPestanias($this->opciones);
        // Se arma el titulo de acuerdo al array opciones
        return view($this->opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $this->opciones]);
    }
}

<?php

namespace App\Traits\Seguridad\UsuarioRol;

use App\Models\Indicadores\Administ\Area;
use App\Models\Sistema\SisEsta;
use App\Models\Tema;
use App\Models\Usuario\Estusuario;
use App\Models\Usuario\RolUsuario;

/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait VistasTrait
{
    public function getVista($opciones, $dataxxxx)
    {
        
        $opciones['estadoxx'] = SisEsta::combo(['cabecera' => true, 'esajaxxx' => false]);
        $opciones['tipotext'] = Tema::combo(2, true, false);
        
        $opciones['rutarchi'] = $opciones['rutacarp'] . 'Acomponentes.Acrud.' . $dataxxxx['accionxx'][0];
        $opciones['formular'] = $opciones['rutacarp'] . $opciones['carpetax'] . '.Formulario.' . $dataxxxx['accionxx'][1];
        $opciones['ruarchjs'] = [
            ['jsxxxxxx' => $opciones['rutacarp'] . $opciones['carpetax'] . '.Js.js']
        ];
        return $opciones;
    }
    public function view($opciones, $dataxxxx)
    {
        $opciones['usuariox'] = $dataxxxx['padrexxx'];
        $opciones['fechcrea'] = '';
        $opciones['fechedit'] = '';
        $opciones['tituhead'] = $dataxxxx['padrexxx']->name;
        $opciones['userxxxx'] = [$dataxxxx['padrexxx']->cedula => $dataxxxx['padrexxx']->nombre .' '. $dataxxxx['padrexxx']->apellido];
        //     $this->opciones['parametr'] = [$dataxxxx['padrexxx']->cedula];
        $opciones = $this->getVista($opciones, $dataxxxx);
        $selectxx = 0;
        // indica si se esta actualizando o viendo
        if ($dataxxxx['modeloxx'] != '') {
            $opciones['modeloxx'] = $dataxxxx['modeloxx'];
            $opciones['modeloxx'] = $dataxxxx['modeloxx'];
            $opciones['parametr'] = [$dataxxxx['modeloxx']->id];
            $opciones['fechcrea'] = $dataxxxx['modeloxx']->created_at;
            $opciones['fechedit'] = $dataxxxx['modeloxx']->updated_at;
      
        }
        $opciones['rolesxxx'] = RolUsuario::getUsuarioRoles([
            'padrexxx' => $dataxxxx['padrexxx']->cedula,
            'cabecera' => true,
            'ajaxxxxx' => false,
            'selectxx' => $selectxx
        ]);

        // Se arma el titulo de acuerdo al array opciones
        return view($opciones['rutacarp'] . 'pestanias', ['todoxxxx' => $opciones]);
    }
}

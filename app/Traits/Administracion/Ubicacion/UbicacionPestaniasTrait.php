<?php

namespace App\Traits\Administracion\Ubicacion;


trait UbicacionPestaniasTrait
{
    public $pestania = [
        ['paisxxxx', '', [],"PAÍS",true,'','Paises'],
        ['departam', '', [],'DEPARTAMENTO',false,'','Departamentos'],
        ['municipi', '', [],'MUNICIPIO',false,'','Municipios'],
        ['localida', '', [],'LOCALIDAD',true,'','Loacalidades'],
        ['localupz', '', [],'LOCALIDAD-UPZ',false,'','Unión de la localidad con la upz'],
        ['upzxxxxx', '', [],'UPZ',true,'','Upz'],
        ['barriupz', '', [],'UPZ-BARRIO',false,'','Unión de la upz con el barrio'],
        ['barrioxx', '', [],'BARRIO',true,'','Barrios'],

    ];
    /**
     * permisos que va a manejar cada pestaña
     *
     * @param array $dataxxxx
     * @return $respuest
     */
    private function getCanany($dataxxxx)
    {
        $permisox = [
            'leer', 'crear', 'editar', 'borrar', 'activarx'
        ];
        $respuest = [];
        foreach ($permisox as $key => $value) {
            $respuest[] = $dataxxxx[0] . '-' . $value;
        }
        return $respuest;
    }

    /**
     * armar la estructura principal de una pestaña
     *
     * @param array $dataxxxx
     * @return $respuest
     */
    public function getArmarPestania($dataxxxx)
    {
        $respuest = [
            'muespest' => false, // indica si se mustra o no
            'pestania' => [
                'routexxx' => route($dataxxxx[0].$dataxxxx[1], $dataxxxx[2]), // ruta que tiene la pestaña
                'activexx' => $dataxxxx[5], // clase que activa la pestaña cuando se esté en ella
                'tituloxx' => $dataxxxx[3], // titulo con el que se identifica la pestanña
                'tooltipx' => $dataxxxx[6], // Ayuda para la pestaña
                'cananyxx' => $this->getCanany($dataxxxx),
            ]
        ];
        return $respuest;
    }
    /**
     * armar las pestañas que va a tener el módulo
     *
     * @param array $dataxxxx
     * @return $respuest
     */
    public function getArmarPestanias($dataxxxx)
    {
        $respuest = [];
        foreach ($this->pestania as $key => $valuexxx) {
            if ($valuexxx[4]) {
                $respuest[] = $this->getArmarPestania($valuexxx);
            }

        }
        return $respuest;
    }
    public function getPestanias($dataxxxx)
    {
        $this->opciones['pestania']  = $this->getArmarPestanias($dataxxxx);
    }
}

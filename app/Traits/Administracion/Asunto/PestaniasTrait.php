<?php

namespace App\Traits\Administracion\Asunto;


trait PestaniasTrait
{
    public $pestanix = [
        'asunto' => [true, []],
        'subasunto' => [true, []],
        'asignasunto' => [true, []],
        'descripcion' => [true, []],
        'asignadescri' => [true, []],
        
        
    ];

    private function getCanany($dataxxxx)
    {
        $permisox = [

            'asunto' => ['leer', 'crear', 'editar', 'borrar', 'activarx'],
            'subasunto' => ['leer', 'crear', 'editar', 'borrar', 'activarx'],
            'asignasunto' => ['leer', 'crear', 'editar', 'borrar', 'activarx'],
            'descripcion' => ['leer', 'crear', 'editar', 'borrar', 'activarx'],
            'asignadescri' => ['leer', 'crear', 'editar', 'borrar', 'activarx'],
            
        
        ];
        $cananyxx = [];
        foreach ($permisox[$dataxxxx['cananyxx']] as $key => $value) {
            $cananyxx[] = $dataxxxx['cananyxx'] . '-' . $value;
        }
        return $cananyxx;
    }

    public function setPestanias($dataxxxx)
    {
        $pestania['asunto'] = [
            'routexxx' => '',
            'activexx' => '',
            'tituloxx' => 'ASUNTOS',
            'tablaxxx' => 'sis_pais',
            'datablex' => [],
            'cananyxx' => $this->getCanany($dataxxxx),
        ];
        $pestania['subasunto'] = [
            'routexxx' => '',
            'activexx' => '',
            'tituloxx' => 'SUBASUNTOS',
            'tablaxxx' => 'sis_pais',
            'datablex' => [],
            'cananyxx' => $this->getCanany($dataxxxx),
        ];
        $pestania['asignasunto'] = [
            'routexxx' => '',
            'activexx' => '',
            'tituloxx' => 'ASIGNAR ASUNTOS',
            'tablaxxx' => 'sis_pais',
            'datablex' => [],
            'cananyxx' => $this->getCanany($dataxxxx),
        ];

        $pestania['descripcion'] = [
            'routexxx' => '',
            'activexx' => '',
            'tituloxx' => 'DESCRIPCIÓN',
            'tablaxxx' => 'sis_pais',
            'datablex' => [],
            'cananyxx' => $this->getCanany($dataxxxx),
        ];
        $pestania['asignadescri'] = [
            'routexxx' => '',
            'activexx' => '',
            'tituloxx' => 'ASIGNAR DESCRIPCIÓN',
            'tablaxxx' => 'sis_pais',
            'datablex' => [],
            'cananyxx' => $this->getCanany($dataxxxx),
        ];


        if (isset($pestania[$dataxxxx['slotxxxx']]['activexx'])) {
            $pestania[$dataxxxx['slotxxxx']]['activexx'] = 'active';
        }
        return $pestania[$dataxxxx['cananyxx']];
    }
    public function getPestanias($dataxxxx)
    {
        $pestania = [];
        foreach ($this->pestanix as $key => $value) {
            if ($value[0]) {
                $dataxxxx['cananyxx'] = $key;
                $dotosxxx = $this->setPestanias($dataxxxx);
                $dotosxxx['routexxx'] = route($key, $value[1]);
                $pestania[] = $dotosxxx;
            }
        }
        return $pestania;
    }
}

<?php

namespace App\Traits\Seguridad\Usuario;


trait PestaniasTrait
{
    public $pestanix = [
        [
            'permisox' => 'rolesxxx', 'routexxx' => '', 'dataxxxx' => [true, []],
        ],
        [
            'permisox' => 'permirol', 'routexxx' => '', 'dataxxxx' => [false, []],
        ],
     
    ];

    private function getCanany($dataxxxx)
    {
        $permisox = [
        'rolesxxx' => ['leer', 'crear', 'editar', 'borrar', 'activarx'],
        'permirol' => ['leer', 'crear', 'editar', 'borrar', 'activarx'],
        ];
        $cananyxx = [];
        foreach ($permisox[$dataxxxx['cananyxx']] as $key => $value) {
            $cananyxx[] = $dataxxxx['cananyxx'] . '-' . $value;
        }
        return $cananyxx;
    }

    public function setPestanias($dataxxxx)
    {

        $pestania['rolesxxx'] = [
            'routexxx' => '',
            'activexx' => '',
            //'dataxxxx' =>true, [$dataxxxx['padrexxx']->id],
            'tituloxx' => 'ROLES',
            'tablaxxx' => 'rolesxxx',
            'datablex' => [],
            'cananyxx' => ['rolesxxx-leer'],
        ];

        $pestania['permirol'] = [
            'routexxx' => '',
            'activexx' => '',
            'tituloxx' => 'ASIGNAR PERMISOS',
            'tablaxxx' => 'rolesxxx',
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
             if ($value['dataxxxx'][0]) {
                $dataxxxx['cananyxx'] = $value['permisox'];
                $dotosxxx = $this->setPestanias($dataxxxx);
                
                $dotosxxx['routexxx'] = route($value['permisox'].$value['routexxx'], $value['dataxxxx'][1]);
                $pestania[] = $dotosxxx;
            }
        }
        return $pestania;
    }
}



<?php

namespace App\Traits\Reportes;


trait PestaniasTrait
{
    public $pestanix = [
        'reportes.general' => [true, []],
        'reportes.finalizado' => [true, []],
        'reportes.dias' => [true, []],
        
        
    ];

    private function getCanany($dataxxxx)
    {
        $permisox = [
         'leer', 'crear', 'editar','borrar'
        ];
        $respuest = [];
        foreach ($permisox as $key => $value) {
            $respuest[] ='consultac-' . $value;
        }
        return $respuest;
    }

    public function setPestanias($dataxxxx)
    {
        $pestania['reportes.general'] = [
            'routexxx' => '',
            'activexx' => '',
            'tituloxx' => 'CONSULTAR REGISTROS',
            'tablaxxx' => 'sis_pais',
            'datablex' => [],
            'cananyxx' => $this->getCanany($dataxxxx),
        ];
        $pestania['reportes.finalizado'] = [
            'routexxx' => '',
            'activexx' => '',
            'tituloxx' => 'CONSULTAR FINALIZADOS',
            'tablaxxx' => 'sis_pais',
            'datablex' => [],
            'cananyxx' => $this->getCanany($dataxxxx),
        ];
        $pestania['reportes.dias'] = [
            'routexxx' => '',
            'activexx' => '',
            'tituloxx' => 'CONSULTAR DÍAS',
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

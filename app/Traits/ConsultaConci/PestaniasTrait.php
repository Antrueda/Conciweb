<?php

namespace App\Traits\ConsultaConci;


trait PestaniasTrait
{
    public $pestanix = [
        'consultac.indexgeneral' => [true, []],
        'consultac.indexFin' => [true, []],
        'consultac.indexdias' => [true, []],
        
        
    ];

    private function getCanany($dataxxxx)
    {
        // $permisox = [

        //    'consultac' => ['leer', 'crear', 'editar', 'borrar', 'activar'],
        //    'consultac' => ['leer', 'crear', 'editar', 'borrar', 'activar'],
        //    'consultac' => ['leer', 'crear', 'editar', 'borrar', 'activar'],
        
        // ];
        // $cananyxx = [];
        // foreach ($permisox[$dataxxxx['cananyxx']] as $key => $value) {
        //     $cananyxx[] = $dataxxxx['cananyxx'] . '-' . $value;
        // }
        // return $cananyxx;

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
        $pestania['consultac.indexgeneral'] = [
            'routexxx' => '',
            'activexx' => '',
            'tituloxx' => 'CONSULTAR REGISTROS',
            'tablaxxx' => 'sis_pais',
            'datablex' => [],
            'cananyxx' => $this->getCanany($dataxxxx),
        ];
        $pestania['consultac.indexFin'] = [
            'routexxx' => '',
            'activexx' => '',
            'tituloxx' => 'CONSULTAR FINALIZADOS',
            'tablaxxx' => 'sis_pais',
            'datablex' => [],
            'cananyxx' => $this->getCanany($dataxxxx),
        ];
        $pestania['consultac.indexdias'] = [
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

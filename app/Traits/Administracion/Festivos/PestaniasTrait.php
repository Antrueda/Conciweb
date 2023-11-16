<?php

namespace App\Traits\Administracion\Festivos;


trait PestaniasTrait
{
    public $pestanix = [
        'correoinv' => [true, []],
        
        
    ];

    private function getCanany($dataxxxx)
    {
        $permisox = [

            'correoinv' => ['leer', 'crear', 'editar', 'borrar', 'activarx'],
            
        
        ];
        $cananyxx = [];
        foreach ($permisox[$dataxxxx['cananyxx']] as $key => $value) {
            $cananyxx[] = $dataxxxx['cananyxx'] . '-' . $value;
        }
        return $cananyxx;
    }

    public function setPestanias($dataxxxx)
    {
        $pestania['correoinv'] = [
            'routexxx' => '',
            'activexx' => '',
            'tituloxx' => 'Correos',
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

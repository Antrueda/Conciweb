<?php

namespace App\Traits\Combos;

use App\Models\Temacombo;
use Illuminate\Support\Facades\Cache;

trait TemacomboTrait
{
    private $nuevoxxx = true;

    public function getActualizaCacheTCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultTCT($dataxxxx);
        Cache::forget('temacombo_' . $dataxxxx['temaxxxx']);
    
        $temacomb = Temacombo::where('id', $dataxxxx['temaxxxx'])
        ->with(['parametros' => function ($queryxxx) use ($dataxxxx) {
            $queryxxx->select(['id as valuexxx', 'nombre as optionxx']);
            $queryxxx->orderBy($dataxxxx['campoxxx'], $dataxxxx['orderxxx']);
        }])
        ->first();
        Cache::put('temacombo_' . $dataxxxx['temaxxxx'], $temacomb);
    }
    /** armar los campos que van por defecto */
    public function getDefaultTCT($dataxxxx)
    {
        if (!isset($dataxxxx['orderxxx'])) {
            $dataxxxx['orderxxx'] = 'ASC';
        }
        if (!isset($dataxxxx['cabecera'])) {
            $dataxxxx['cabecera'] = true;
        }
        if (!isset($dataxxxx['ajaxxxxx'])) {
            $dataxxxx['ajaxxxxx'] = false;
        }
        if (!isset($dataxxxx['selected'])) {
            $dataxxxx['selected'] = [];
        }
        if (!isset($dataxxxx['campoxxx'])) {
            $dataxxxx['campoxxx'] = 'nombre';
        }
        if (!isset($dataxxxx['notinxxx'])) {
            $dataxxxx['notinxxx'] = [];
        }
        if (!isset($dataxxxx['inxxxxxx'])) {
            $dataxxxx['inxxxxxx'] = [];
        }

        return $dataxxxx;
    }

    /** armar la cabecera del combo */
    public function getCabeceraTCT($dataxxxx)
    {
        $comboxxx = [];
        if ($dataxxxx['cabecera']) {
            if ($dataxxxx['ajaxxxxx']) {
                $comboxxx[] = ['valuexxx' => '', 'optionxx' => 'Seleccione'];
            } else {
                $comboxxx = ['' => 'Seleccione'];
            }
        }
        return $comboxxx;
    }
    /** armar la opcion dependiendo de si es un combo ajax o normal */
    public function getTipoComboTCT($registro, $dataxxxx, $comboxxx)
    {
        if ($dataxxxx['ajaxxxxx']) {
            $comboxxx[] = ['valuexxx' => $registro->valuexxx, 'optionxx' => strtoupper($registro->optionxx)];
        } else {
            $comboxxx[$registro->valuexxx] = strtoupper($registro->optionxx);
        }
        return $comboxxx;
    }


    public function getCacheTCT($dataxxxx)
    {
        $temacomb = [];
        if (Cache::has('temacombo_' . $dataxxxx['temaxxxx'])) {
            $temacomb = Cache::get('temacombo_' . $dataxxxx['temaxxxx']);
        } else {
            $temacomb = Temacombo::where('id', $dataxxxx['temaxxxx'])
                ->with(['parametros' => function ($queryxxx) use ($dataxxxx) {
                    $queryxxx->select(['id as valuexxx', 'nombre as optionxx']);
                    $queryxxx->orderBy($dataxxxx['campoxxx'], $dataxxxx['orderxxx']);
                }])
                ->first();
            Cache::put('temacombo_' . $dataxxxx['temaxxxx'], $temacomb);
        }
        return $temacomb;
    }

    public function getCuerpoComboTCT($dataxxxx)
    {
        $comboxxx = $this->getCabeceraTCT($dataxxxx);
        foreach ($dataxxxx['dataxxxx'] as $registro) {
            $comboxxx = $this->getTipoComboTCT($registro, $dataxxxx, $comboxxx);
        }
        return $comboxxx;
    }

    


    public function getComboTCT($parametr, $dataxxxx)
    {
        foreach ($parametr as $key => $value) {
            if ($this->nuevoxxx) {
                // * quitar los parámetros inactivos
                if ($value->pivot->sis_esta_id == 2) {
                    unset($parametr[$key]);
                } else
                    // quitar los parámetros que no se requieran
                    if (in_array($value->valuexxx, $dataxxxx['notinxxx'])) {
                        unset($parametr[$key]);
                    }
            } else {
                // * quitar los parámetros que estén inactivos y que no estén en: inxxxxxx
                if (!in_array($value->valuexxx, $dataxxxx['inxxxxxx']) && $value->pivot->sis_esta_id == 2) {
                    unset($parametr[$key]);
                }
            }
        }
        return $parametr;
    }

    public function getTemecomboTCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultTCT($dataxxxx);
        $temacomb = $this->getCacheTCT($dataxxxx);
        $dataxxxx['dataxxxx'] = $this->getComboTCT($temacomb->parametros, $dataxxxx);
        return ['comboxxx' => $this->getCuerpoComboTCT($dataxxxx), 'nombcomb' => $temacomb->nombre, 'tooltipx' => $temacomb->nombre . ' (' . $temacomb->id . ')'];
    }
}
//

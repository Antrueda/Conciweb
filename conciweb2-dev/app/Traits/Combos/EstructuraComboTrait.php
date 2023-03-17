<?php

namespace App\Traits\Combos;

trait EstructuraComboTrait
{
    public function getCampoCT($dataxxxx, $campoxxx)
    {
        if (!isset($dataxxxx['campoxxx'])) {
            $dataxxxx['campoxxx'] = $campoxxx;
        }
        return $dataxxxx;
    }

    public function getDefaultCT($dataxxxx)
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
        return $dataxxxx;
    }

    public function getCabecera($dataxxxx)
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

    public function getCuerpoCombo($dataxxxx)
    {
        $comboxxx = $this->getCabecera($dataxxxx);
        foreach ($dataxxxx['dataxxxx'] as $registro) {
            if ($dataxxxx['ajaxxxxx']) {
                $comboxxx[] = ['valuexxx' => $registro->valuexxx, 'optionxx' => strtoupper($registro->optionxx)];
            } else {
                $comboxxx[$registro->valuexxx] = strtoupper($registro->optionxx);
            }
        }
        return $comboxxx;
    }

    public function getCuerpoUsuarioCT($dataxxxx)
    {
        $comboxxx = $this->getCabecera($dataxxxx);
        foreach ($dataxxxx['dataxxxx'] as $registro) {
            if ($dataxxxx['ajaxxxxx']) {
                $selected = '';
                if (in_array($registro->valuexxx, $dataxxxx['selected'])) {
                    $selected = 'selected';
                }
                $comboxxx[] = ['valuexxx' => $registro->valuexxx, 'optionxx' => $registro->s_documento . ' - ' . strtoupper($registro->optionxx), 'selected' => $selected];
            } else {
                $comboxxx[$registro->valuexxx] = $registro->s_documento . ' - ' . strtoupper($registro->optionxx);
            }
        }
        return $comboxxx;
    }

    public function getCuerpoComboSinValueCT($dataxxxx)
    {
        $comboxxx = $this->getCabecera($dataxxxx);
        foreach ($dataxxxx['dataxxxx'] as $registro) {
            if ($dataxxxx['ajaxxxxx']) {
                $selected = '';
                if (in_array($registro->valuexxx, $dataxxxx['selected'])) {
                    $selected = 'selected';
                }
                $comboxxx[] = ['valuexxx' => $registro->valuexxx, 'optionxx' => strtoupper($registro->optionxx), 'selected' => $selected];
            } else {
                $comboxxx[$registro->valuexxx] = strtoupper($registro->optionxx);
            }
        }
        return $comboxxx;
    }
}
//

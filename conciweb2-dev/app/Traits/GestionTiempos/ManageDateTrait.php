<?php

namespace App\Traits\GestionTiempos;

use App\Models\Sistema\SisDiaFestivo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Este trait permite realizar los calculos para encontrar cuantos días adicionales se le darán
 * terminado el mes para el carge de información
 */
trait ManageDateTrait
{

    /**
     * Encontrar los dias del mes transcurridos
     *
     * @return $dataxxxx
     */
    public function getDiasTranscurridos()
    {
        $fechahoy = Carbon::today(); // hallar fecha actual
        $diastran = $fechahoy->day; // cantidad de dias transcurridos hasta hoy
        return $diastran;
    }
    /**
     * identificar si hoy es festivo
     *
     * @param date $fechaxxx
     * @return $festivox
     */
    public function getDiaFestivo($anioxxxx, $mesxxxxx, $diaxxxxx)
    {
        $festivox = false; // no es festivo
        $diafesti = SisDiaFestivo::where('anio', $anioxxxx)
            ->where('mes', $mesxxxxx)
            ->where('dia', $diaxxxxx)
            ->first(['id']);
        if ($diafesti != null) { // dia consultado es festivo
            $festivox = true;
        }
        return $festivox;
    }

    /**
     * validar si un dia es sabado o domingo
     *
     * @param int $diaxxxxx
     * @return void
     */
    public function getSabodoDomingo($diaxxxxx)
    {
        $esdiafin = false;
        $finseman = ['Sunday', 'Saturday']; // dias del fin de semana
        if (in_array(date('l', strtotime($diaxxxxx)), $finseman)) { // el dia es sabado o domigo
            $esdiafin = true;
        }
        return $esdiafin;
    }
    /**
     * cantidad de dias fin de semana del mes anterior (sabado y domingo)
     *
     * @return int $cantdias
     */
    public function getDiasFinSemana($finmesan)
    {
        $cantdias = 0; // días fin de semana del fin de mes
        // saber si el fin de mes tuvo fin de semana
        for ($i = $finmesan->day; $i > 0; $i--) {
            if ($this->getSabodoDomingo($i)) { // el dia es sabado o domigo
                $cantdias++;
            } else { // el dia es hábil
                break;
            }
        }
        return  $cantdias;
    }
    /**
     * contar los días festivos que tuvo el fin de mes pasado
     *
     * @param object $finmesan
     * @return int $cantdias
     */
    public function getFestivosFinMesPasado($finmesan)
    {
        $cantdias = 0; // cantidad días festivos del fin de mes pasado
        // recorrer los dias del mes pasado de manera inversa para encontrar los dias festivos con que finalizó
        for ($i = $finmesan->day; $i > 0; $i--) {
            if ($this->getDiaFestivo($finmesan->year, $finmesan->month, $i)) { // contar días fin de semana
                $cantdias++;
            } else { // salir del conteo
                break;
            }
        }
        return  $cantdias;
    }
    /**
     * contar los dias fin de semana del fin de mes pasado (sabado, domingo y festivos)
     *
     * @return int $cantdias
     */
    public function getDiasFinMesPasado()
    {
        $finmesan = Carbon::now()->startofMonth()->subMonth()->endOfMonth(); // fin de mes anterior
        $cantdias = $this->getDiasFinSemana($finmesan); // cantidad dias fin de seamana
        $cantdias = $cantdias + $this->getFestivosFinMesPasado($finmesan); // cantidad dias festivos
        return $cantdias;
    }

    /**
     * contar los dias festivos y fin de semana del inicio de mes actual
     *
     * @return int $cantdias
     */
    public function getInicioMesActual()
    {
        $cantdias = $this->getFinSemanaInicioMes(); // cantidad días fin de semana al inicio del mes
        $cantdias = $cantdias + $this->getFestivosInicioMes(); // cantidad dis festivos del inicio del mes
        return $cantdias;
    }


    /**
     * contar los dias fin de semana que tuvo el inicio del mes actual
     *
     * @return int $cantdias
     */
    public function getFinSemanaInicioMes()
    {
        $cantdias = 0; // días fin de semana del inicio de mes
        // saber si el inicio de mes actual tuvo fin de semana
        for ($i = 1; $i < 10; $i++) {
            if ($this->getSabodoDomingo($i)) { // contar dias fin de semana
                $cantdias++;
            } else { // salir del conteo
                break;
            }
        }
        return  $cantdias;
    }

    public function getFestivosInicioMes()
    {
        $fechahoy = Carbon::today(); // hallar fecha actual
        $cantdias = 0; // cantidad días festivos del fin de mes pasado
        // recorrer los dias del mes pasado de manera inversa para encontrar los dias festivos con que finalizó
        for ($i = 1; $i < 10; $i++) {
            if ($this->getDiaFestivo($fechahoy->year, $fechahoy->month, $i)) { // contar días fin de semana
                $cantdias++;
            } else { // salir del conteo
                break;
            }
        }
        return  $cantdias;
    }




    /**
     * sumar la totalidad encontrados de días del fin de mes pasdo y los del inicio del mes actual
     *
     * @return int $cantdias
     */
    public function getTotalDias()
    {
        $cantdias = $this->getDiasFinMesPasado();
        $cantdias = $cantdias + $this->getInicioMesActual();
        return $cantdias;
    }


    /**
     * Encontrar los días de gabela cuando se esta iniciando mes para el mes anterior
     *
     * @param array $dataxxxx
     * @return $dataxxxx
     */
    public function getGabelaFinMes($dataxxxx)
    {
        $dataxxxx['tienperm'] = false;
        $cantdias = $this->getTotalDias(); // cantidad días (sabado, domingo festivos) que tuvo el fin de mes pasado
        $itiegabe = $dataxxxx['itiegabe'] + $cantdias; // se suman los dias festivos y fin de semana con el tiempo de gabela dado
        $diastran = $this->getDiasTranscurridos(); // dias transcurridos del mes
        $anterior = Carbon::now()->subDays($itiegabe)->startofMonth(); // ir hasta el inicio del mes de los días de gabela
        // $anterior = Carbon::now()->startofMonth()->subMonth(); // mes anterior
        $actualxx = Carbon::today(); // hallar fecha actual
        $dataxxxx['actualxx'] = $actualxx->toDateString();
        $inicioxx=Carbon::now()->startofMonth();
        $dataxxxx['inicioxx'] = $inicioxx->toDateString(); // inicio del mes actual
      
        $fechregi = Carbon::parse($dataxxxx['fechregi']);

        if ($diastran <= $itiegabe) { // permitir el cargue de informacion del mes anterio y del actual hasta hoy
            $dataxxxx['fechlimi'] = $anterior->toDateString();
            // * la fecha de registro mayor o igual a la permitida
            if ($fechregi->gte($anterior)) { // validar que la fecha de registro esté dentro de los meses posibles
                $dataxxxx['inicioxx'] = $anterior->toDateString(); // inicio del mes pasado
                $dataxxxx['tienperm'] = true; 
            } 
        } else { // permitir el cargue de información del mes actual hasta hoy
            $dataxxxx['fechlimi'] =  $dataxxxx['inicioxx'];
            if ($fechregi->month ==  $inicioxx->month &&  $fechregi->day <= $actualxx->day) { // la fecha de regitro está dentro del rango
                $dataxxxx['tienperm'] = true;
            }
        }
        return $dataxxxx;
    }
}

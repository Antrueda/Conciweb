<?php

namespace App\Traits\GestionTiempos;

use App\Models\Sistema\SisDepen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * este trait permite gestionar permisos de acuerdo al tiempo asignado para el carge de informacion
 * el cargue se debe gestionar de la siguiente manenera:
 * 1 si es fin de mes debe permitir cargar hasta los dos primeros días hábiles del siguiente mes
 * 2 si es dia intermedio solo debe permitir cargar hasta hoy
 * 3 el sistema debe permitir cargar informacion hacia atrás teniendo en cuenta el numero de días
 *   y este cargue se debe contar a partir del dia hoy
 *
 * estas validaciones se deben hacer con la fecha de diligenciamiento del formato
 */
trait ManageTimeTrait
{
    use ManageDateTrait;
    /**
     * gestiona el cargue de información de acuerdo al tiempo asignado al usuario registrado
     *
     * @return void
     */
    public function getPersonal($dataxxxx)
    {
        
        return $this->getGabelaFinMes($dataxxxx);
    }

    /**
     * gestiona el cargue de información de acuerdo al tiempo asignado al cargo del usuario registrado
     *
     * @return void
     */
    public function getCargo($dataxxxx)
    {
        return  $this->getGabelaFinMes($dataxxxx);
    }
    /**
     * gistiona el cargue de información de acuerdo al tiempo asignado a la upi asignada al usuario registrado
     *
     * @return void
     */
    public function getUpi(array $dataxxxx)
    {
        return $this->getGabelaFinMes($dataxxxx);
    }

    /**
     * gestiona los permiso de acuerdo al tiempo asignado para todo lo que tiene que ver con las acciones
     * ii
     *
     * @return void
     */
    public function getAcciones(array $dataxxxx)
    {
        $userxxxx =  Auth::user();
        $itieusua = $userxxxx->itiegabe; // sumar el tiempo estandar con tiempo gabela
        if ($itieusua == 0) {
            $itieusua = 4;
        }
        

        $itiecarg =  $userxxxx->sis_cargo->itiegabe;
        if ($itiecarg == 0) {
            $itiecarg = 4;
        }
        if ($itieusua > $itiecarg) {
            $dataxxxx['itiegabe'] = $itieusua;
            $dataxxxx = $this->getPersonal($dataxxxx);
        } else {
            $dataxxxx['itiegabe'] = $itiecarg;
            $dataxxxx = $this->getCargo($dataxxxx);
        }
        

        $dataxxxx['msnxxxxx'] = 'NO TIENE PREMISOS PARA REGISTRAR INFORMACIÓN INFERIOR A LA FECHA: ' . $dataxxxx['fechlimi'];
        return $dataxxxx;
    }

    /**
     * gestiona los permiso de acuerdo al tiempo asignado para todo lo que tiene que ver con las asistencias
     *
     * @return void
     */
    public function getAsistenciasMTT(array $dataxxxx)
    {
        // * consultar la upi
        $upixxxxx = SisDepen::find($dataxxxx['upixxxxx']);
        $dataxxxx['itiegabe'] = $upixxxxx->itiegabe;
        if ($dataxxxx['itiegabe'] == 0) {
            $dataxxxx['itiegabe'] = 4;
        }
        $dataxxxx = $this->getUpi($dataxxxx);
        $dataxxxx['msnxxxxx'] = 'NO TIENE PREMISOS PARA REGISTRAR INFORMACIÓN INFERIOR A LA FECHA: ' . $dataxxxx['fechlimi'];
        return $dataxxxx;
    }



    /**
     * gestiona los permisos para acciones o asistencias
     *
     * NOTA: se debe indicar en donde está para saber si los permisos se deben gestionar
     * por acciones o por asistencias
     * @return void
     */
    public function getPuedeCargar(array $dataxxxx)
    {
        $respuest = [];
        switch ($dataxxxx['estoyenx']) {
            case 1: // cargue por acciones
                $respuest = $this->getAcciones($dataxxxx);

                break;
            case 2: // cargue por asistencias
                // $respuest=['tienperm'=>true];
                $respuest = $this->getAsistenciasMTT($dataxxxx);
                break;
        }

        return $respuest;
    }

    /**
     * notas para tener en cuenta
     *
     * los días festivos se deben administrar por base de datos
     */

    /**
     * calcular año, mes y dia máximo en que el NNAJ es poblción objetivo del IDIPRON
     * 29 años menos y día
     * @param int $anioxxxx
     * @param int $diaxxxxx
     * @return array
     */
    public function getMindatex($anioxxxx, $diaxxxxx, $arrayxxx = true)
    {
        $mindatex = Carbon::now();
        $mindatex->subYears($anioxxxx);
        $fechaxxx=$mindatex->addDay($diaxxxxx)->format('Y-m-d');
        if ($arrayxxx) {
            $fechaxxx = explode('-', $fechaxxx);
        }
        return  $fechaxxx;
     
    }

    /**
     * calcular año, mes y dia mínimo en que el NNAJ es poblción objetivo del IDIPRON
     * 6 años
     * @param int $anioxxxx
     * @param int $diaxxxxx
     * @return array
     */
    public function getMaxdatex($anioxxxx, $diaxxxxx, $arrayxxx = true)
    {
        $mindatex = Carbon::now();
        $mindatex->subYears($anioxxxx);
        $fechaxxx = $mindatex->subDay($diaxxxxx)->format('Y-m-d');
        if ($arrayxxx) {
            $fechaxxx = explode('-', $fechaxxx);
        }
        return  $fechaxxx;
    }

    /**
     * obtener el rango de fechas para la población objetivo del IDIPRON
     *
     * @return void
     */
    public function getEdadIdipron()
    {
        $this->opciones['mindatex'] =  $this->getMindatex(29, 1);
        $this->opciones['maxdatex'] =  $this->getMaxdatex(5, 0);
    }

    public function getFechaPuedeMTT($dataxxxx)
    {
        $puedexxx = $this->getPuedeCargar([
            'estoyenx' => $dataxxxx['estoyenx'], // 1 para acciones individuale y 2 para acciones grupales
            'fechregi' => date('Y-m-d'),
            'formular'=>1,
        ]);
        $this->opciones['minpuede'] =  explode('-',$puedexxx['fechlimi']);
        $this->opciones['maxpuede'] =  explode('-',$puedexxx['actualxx']);
    }
}

<?php

namespace App\Traits\Administracion\Ubicacion;

use App\Models\Sistema\SisBarrio;
use App\Models\Sistema\SisDepartam;
use App\Models\Sistema\SisLocalidad;
use App\Models\Sistema\SisLocalupz;
use App\Models\Sistema\SisMunicipio;
use App\Models\Sistema\SisPai;
use App\Models\Sistema\SisUpz;
use App\Models\Sistema\SisUpzbarri;
use App\Traits\DatatableTrait;
use Illuminate\Http\Request;


/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait UbicacionListadosTrait
{
    use DatatableTrait;
    /**
     * encontrar listar paises
     */
    public function listaPaises(Request $request)
    {

        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'departam'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  SisPai::select(['sis_pais.id', 'sis_pais.s_pais', 'sis_pais.sis_esta_id', 'sis_estas.s_estado'])
                ->join('sis_estas', 'sis_pais.sis_esta_id', '=', 'sis_estas.id');
            return $this->getDt($dataxxxx, $request);
        }
    }

    public function listaDepartamentos(Request $request, SisPai $padrexxx)
    {

        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'municipi'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  SisDepartam::select(['sis_departams.id', 'sis_departams.s_departamento', 'sis_departams.sis_esta_id', 'sis_estas.s_estado'])
                ->join('sis_estas', 'sis_departams.sis_esta_id', '=', 'sis_estas.id')
                ->where('sis_pai_id', $padrexxx->id);
            return $this->getDt($dataxxxx, $request);
        }
    }

    public function listaMunicipios(Request $request, SisDepartam $padrexxx)
    {

        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'comboxxx'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  SisMunicipio::select(['sis_municipios.id', 'sis_municipios.s_municipio', 'sis_municipios.sis_esta_id', 'sis_estas.s_estado'])
                ->join('sis_estas', 'sis_municipios.sis_esta_id', '=', 'sis_estas.id')
                ->where('sis_departam_id', $padrexxx->id);
            return $this->getDt($dataxxxx, $request);
        }
    }

    public function listaLocalidades(Request $request)
    {

        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'localupz'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  SisLocalidad::select(['sis_localidads.id', 'sis_localidads.s_localidad', 'sis_localidads.sis_esta_id', 'sis_estas.s_estado'])
                ->join('sis_estas', 'sis_localidads.sis_esta_id', '=', 'sis_estas.id');
            return $this->getDt($dataxxxx, $request);
        }
    }
    public function listaupzs(Request $request)
    {
        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'barriupz'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  SisUpz::select(['sis_upzs.id', 'sis_upzs.s_upz', 'sis_upzs.sis_esta_id', 'sis_estas.s_estado'])
                ->join('sis_estas', 'sis_upzs.sis_esta_id', '=', 'sis_estas.id')
                ;
            return $this->getDt($dataxxxx, $request);
        }
    }
    public function listalocalupzs(Request $request,SisLocalidad $padrexxx)
    {
        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'barriupz'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  SisLocalupz::select(['sis_localupzs.id', 'sis_upzs.s_upz', 'sis_localupzs.sis_esta_id', 'sis_estas.s_estado'])
                ->join('sis_upzs', 'sis_localupzs.sis_upz_id', '=', 'sis_upzs.id')
                ->join('sis_estas', 'sis_localupzs.sis_esta_id', '=', 'sis_estas.id')
                ->where('sis_localidad_id',$padrexxx->id)
                ;
            return $this->getDt($dataxxxx, $request);
        }
    }
    public function listabarrios(Request $request)
    {
        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'barriupz'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  SisBarrio::select(['sis_barrios.id', 'sis_barrios.s_barrio', 'sis_barrios.sis_esta_id', 'sis_estas.s_estado'])
                ->join('sis_estas', 'sis_barrios.sis_esta_id', '=', 'sis_estas.id')
                ;
            return $this->getDt($dataxxxx, $request);
        }
    }
    public function listaupzbarris(Request $request,SisLocalupz $padrexxx)
    {
        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'barriupz'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  SisUpzbarri::select(['sis_upzbarris.id', 'sis_barrios.s_barrio', 'sis_upzbarris.sis_esta_id','sis_upzbarris.simianti_id', 'sis_estas.s_estado'])
            ->join('sis_barrios', 'sis_upzbarris.sis_barrio_id', '=', 'sis_barrios.id')
                ->join('sis_estas', 'sis_upzbarris.sis_esta_id', '=', 'sis_estas.id')
                ->where('sis_localupz_id',$padrexxx->id)
                ;
            return $this->getDt($dataxxxx, $request);
        }
    }


}

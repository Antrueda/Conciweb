<?php

namespace App\Traits\Administracion\Temas;

use App\Models\Parametro;
use App\Models\Tema;
use App\Models\Temacombo;
use App\Traits\DatatableTrait;
use Illuminate\Http\Request;

/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait ListadosTrait
{
    use DatatableTrait;

    /**
     * encontrar listar paises
     */


    public function listaTemas(Request $request)
    {

        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'comboxxx'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  Tema::select(['temas.id', 'temas.nombre', 'temas.sis_esta_id', 'sis_estas.s_estado'])
                ->join('sis_estas', 'temas.sis_esta_id', '=', 'sis_estas.id');
            return $this->getDt($dataxxxx, $request);
        }
    }

    public function listaCombos(Request $request, Tema $padrexxx)
    {

        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'combpara'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  Temacombo::select(
                [
                    'temacombos.id',
                    'temacombos.nombre',
                    'temacombos.sis_esta_id',
                    'sis_estas.s_estado',
                    'temacombos.tema_id'
                ]
            )
                ->join('sis_estas', 'temacombos.sis_esta_id', '=', 'sis_estas.id')
                // ->where('tema_id', $padrexxx->id)
                ;
            return $this->getDt($dataxxxx, $request);
        }
    }

    /**
     * listado de parámetros
     *
     * @param Request $request
     * @return void
     */
    public function listaParametros(Request $request)
    {

        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'comboxxx'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  Parametro::select(['parametros.id', 'parametros.nombre', 'parametros.sis_esta_id', 'sis_estas.s_estado'])
                ->join('sis_estas', 'parametros.sis_esta_id', '=', 'sis_estas.id')->orderBy('parametros.nombre', 'ASC');
            return $this->getDt($dataxxxx, $request);
        }
    }
public function getData($selectxx,$padrexxx)
{
    $dataxxxx =  Temacombo::select($selectxx)
        ->join('sis_estas', 'temacombos.sis_esta_id', '=', 'sis_estas.id')
        ->join('parametro_temacombo', 'temacombos.id', '=', 'parametro_temacombo.temacombo_id')
        ->join('parametros', 'parametro_temacombo.parametro_id', '=', 'parametros.id')
        ->where('temacombos.id', $padrexxx->id);
        return $dataxxxx;
}
    public function listaComboparametros(Request $request, Temacombo $padrexxx)
    {

        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'combpara'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =
                [
                    'parametros.id',
                    'parametros.nombre',
                    'parametro_temacombo.sis_esta_id',
                    'sis_estas.s_estado',
                    'temacombos.tema_id',
                    'parametro_temacombo.simianti_id',
                    'parametro_temacombo.temacombo_id',
                ];

            return $this->getDt($this->getData($dataxxxx,$padrexxx), $request);
        }
    }

    public function listaParametrosNotIn(Request $request, Temacombo $padrexxx)
    {
        if ($request->ajax()) {
            $notinxxx=$this->getData(['parametros.id'],$padrexxx)->get();
            $request->routexxx = [$this->opciones['routxxxx'], 'comboxxx'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botoagre';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  Parametro::select(['parametros.id', 'parametros.nombre', 'parametros.sis_esta_id', 'sis_estas.s_estado'])
                ->join('sis_estas', 'parametros.sis_esta_id', '=', 'sis_estas.id')
                ->whereNotIn('parametros.id',$notinxxx);

            return $this->getDt($dataxxxx, $request);
        }
    }
}

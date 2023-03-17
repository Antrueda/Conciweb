<?php

namespace App\Traits\Combos;

use App\Models\Acciones\Grupales\AgRecurso;
use App\Models\Actaencu\AeRecuadmi;
use App\Models\Actaencu\AeRecurso;
use App\Models\Direccionamiento\EntidadServicio;
use App\Models\Educacion\Administ\Pruediag\EdaAsignatu;
use App\Models\Educacion\Administ\Pruediag\EdaGrado;
use App\Models\Educacion\Administ\Pruediag\EdaPresaber;
use App\Models\Educacion\Usuariox\Pruediag\EduPresaber;
use App\Models\Sistema\SisBarrio;
use App\Models\sistema\SisDepartam;
use App\Models\Sistema\SisDepen;
use App\Models\Sistema\SisEntidad;
use App\Models\sistema\SisEsta;
use App\Models\Sistema\SisLocalidad;
use App\Models\Sistema\SisLocalupz;
use App\Models\sistema\SisMunicipio;
use App\Models\Sistema\SisServicio;
use App\Models\Sistema\SisUpz;
use App\Models\Sistema\SisUpzbarri;
use App\Models\Temacombo;
use App\Models\User;
use App\Models\Usuario\Estusuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait CombosTrait
{
    use EstructuraComboTrait;

    public function getInRespuestas($dataxxxx)
    {
        $comboxxx = $this->getCabecera($dataxxxx);
        $padrexxx = $dataxxxx['padrexxx']->sis_tcampo->tema->temacombos[0]->parametros;
        foreach ($padrexxx as $registro) {
            if ($dataxxxx['ajaxxxxx']) {
                $comboxxx[] = ['valuexxx' => $registro->id, 'optionxx' => $registro->nombre];
            } else {
                $comboxxx[$registro->id] = $registro->nombre;
            }
        }
        return $comboxxx;
    }


    /**
     * encontrar los parámetros del tema indicado
     * @param array $dataxxxx tema padre de los parámetros

     * @return $comboxxx
     */

     
    public function getTemacomboCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        // * Campo en que se ordena el combo
        if (!isset($dataxxxx['campoxxx'])) {
            $dataxxxx['campoxxx'] = 'nombre';
        }

        $consulta = Temacombo::where('id', $dataxxxx['temaxxxx'])
            ->with(['parametros' => function ($queryxxx) use ($dataxxxx) {
                $queryxxx->select(['id as valuexxx', 'nombre as optionxx']);
                if (isset($dataxxxx['notinxxx']) && count($dataxxxx['notinxxx'])) {
                    $queryxxx->whereNotIn('id', $dataxxxx['notinxxx']);
                }
                if (isset($dataxxxx['inxxxxxx']) && count($dataxxxx['inxxxxxx'])) {
                    $queryxxx->whereIn('id', $dataxxxx['inxxxxxx']);
                }
                $queryxxx->where('parametro_temacombo.sis_esta_id', 1);
                if (isset($dataxxxx['selected'])) {
                    $queryxxx->orWhere('id', $dataxxxx['selected']);
                }
                $queryxxx->orderBy($dataxxxx['campoxxx'], $dataxxxx['orderxxx']);
            }])
            ->first();
        $dataxxxx['dataxxxx'] = $consulta->parametros;
        return ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx), 'pregunta' => $consulta->nombre];
    }

    /**
     * encontrar los parámetros del tema indicado
     * @param array $dataxxxx tema padre de los parámetros

     * @return $comboxxx
     */
    public function getTemacomboCTNotIn($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = Temacombo::where('id', $dataxxxx['temaxxxx'])
            ->with(['parametros' => function ($queryxxx) use ($dataxxxx) {
                $queryxxx->select(['id as valuexxx', 'nombre as optionxx']);
                $queryxxx->orderBy($dataxxxx['campoxxx'], $dataxxxx['orederby']);
                $queryxxx->whereNotIn('id', $dataxxxx['notinxxx']);
            }])
            ->first()->parametros;
        return ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
    }

    public function getResponsablesActividad($dataxxxx)
    {
        if ($dataxxxx['cabecera']) {
            if ($dataxxxx['ajax']) {
            }
        }
    }

    public function getUpzsCT($dataxxxx)
    {
        $localida = SisLocalupz::select(['sis_upz_id'])
            ->where('sis_localidad_id', $dataxxxx['padrexxx'])
            ->whereNotIn('sis_upz_id', $dataxxxx['selected'])
            ->get();
        $dataxxxx['dataxxxx'] = SisUpz::select(['sis_upzs.id as valuexxx', 'sis_upzs.s_upz as optionxx'])
            ->whereNotIn('id', $localida)
            ->get();
        return ['comboxxx' => $this->getCuerpoComboCT($dataxxxx)];
    }

    public function getCuerpoComboCT($dataxxxx)
    {
        $comboxxx = $this->getCabecera($dataxxxx);
        foreach ($dataxxxx['dataxxxx'] as $registro) {
            if ($dataxxxx['ajaxxxxx']) {
                $selected = '';
                if (in_array($registro->valuexxx, $dataxxxx['selected'])) {
                    $selected = 'selected';
                }
                $comboxxx[] = ['valuexxx' => $registro->valuexxx, 'optionxx' => $registro->valuexxx . ' ' . strtoupper($registro->optionxx), 'selected' => $selected];
            } else {
                $comboxxx[$registro->valuexxx] = strtoupper($registro->optionxx);
            }
        }
        return $comboxxx;
    }

    

    public function getBarriosCT($dataxxxx)
    {
        $localida = SisUpzbarri::select(['sis_barrio_id'])
            ->where('sis_localupz_id', $dataxxxx['padrexxx'])
            ->whereNotIn('sis_barrio_id', $dataxxxx['selected'])
            ->get();
        $dataxxxx['dataxxxx'] = SisBarrio::select(['sis_barrios.id as valuexxx', 'sis_barrios.s_barrio as optionxx'])
            ->whereNotIn('id', $localida)
            ->get();
        return ['comboxxx' => $this->getCuerpoComboCT($dataxxxx)];
    }

    /**
     * combo de los barrios para utilizarlos en el select
     */
    public function getBarriosComboCT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = SisLocalupz::select(['sis_barrios.id as valuexxx', 'sis_barrios.s_barrio as optionxx'])
            ->join('sis_upzbarris', 'sis_localupzs.id', '=', 'sis_upzbarris.sis_localupz_id')
            ->join('sis_barrios', 'sis_upzbarris.sis_barrio_id', '=', 'sis_barrios.id')
            ->where('sis_localupzs.sis_localidad_id', $dataxxxx['localidx'])
            ->where('sis_localupzs.sis_upz_id', $dataxxxx['upzidxxx'])
            ->where('sis_upzbarris.sis_esta_id', 1)
            ->orderBy('sis_barrios.s_barrio', $dataxxxx['ordenxxx'])
            ->get();
        return    $this->getCuerpoComboSinValueCT($dataxxxx);
    }

    /**
     * encontrar las upzs de la localidad
     */
    public function getUpzsComboCT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = SisLocalupz::select(['sis_upzs.id as valuexxx', 'sis_upzs.s_upz as optionxx'])
            ->join('sis_upzs', 'sis_localupzs.sis_upz_id', '=', 'sis_upzs.id')
            ->where('sis_localupzs.sis_localidad_id', $dataxxxx['localidx'])
            ->get();
        return    $this->getCuerpoComboCT($dataxxxx);
    }

    /**
     * encontrar los servicios de la upi
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getServiciosUpiComboCT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = SisServicio::select(['sis_servicios.id as valuexxx', 'sis_servicios.s_servicio as optionxx'])
            ->join('sis_depeservs', 'sis_depeservs.sis_servicio_id', 'sis_servicios.id')
            ->where('sis_depeservs.sis_depen_id', $dataxxxx['dependen'])
            ->where('sis_depeservs.sis_esta_id', 1)
            ->get();
        $respuest = $this->getCuerpoComboSinValueCT($dataxxxx);
        return    $respuest;
    }



    public function getServiciosEntidadComboCT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = EntidadServicio::select(['sis_servicios.id as valuexxx', 'sis_servicios.s_servicio as optionxx'])
            ->join('sis_entidads', 'sis_entidad_sis_servicio.fos_tse_id', '=', 'sis_entidads.id')
            ->join('sis_servicios', 'sis_entidad_sis_servicio.fos_stses_id', '=', 'sis_servicios.id')
            ->where('sis_entidad_sis_servicio.sis_servicio_id', $dataxxxx['entidadx'])
            ->where('sis_entidad_sis_servicio.sis_esta_id', 1)
            ->orderBy('sis_entidad_sis_servicio.id', 'asc')
            ->get();
        $respuest = $this->getCuerpoComboSinValueCT($dataxxxx);
        return    $respuest;
    }

    public function getServiciosUpiComboMaCT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = SisServicio::select(['sis_servicios.id as valuexxx', 'sis_servicios.s_servicio as optionxx'])
            ->join('sis_depeservs', 'sis_depeservs.sis_servicio_id', 'sis_servicios.id')
            ->where('sis_depeservs.sis_depen_id', $dataxxxx['dependen'])
            ->where('sis_depeservs.sis_esta_id', 1)
            ->get();
        $respuest = $this->getCuerpoComboSinValueCT($dataxxxx);
        return    $respuest;
    }




    /**
     * encontrar el responsable de la upi
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getResponsableUpiCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        // $selected = ['users.name as optionxx', 'users.id as valuexxx', 'users.s_documento'];
        $selected = ['users.id as valuexxx', 'users.s_documento', DB::raw("users.name||' ('||sis_cargos.s_cargo||')' AS optionxx")];

        // * se está creando un registro nuevo
        if ($dataxxxx['usersele'] == 0) {
            $dataxxxx['dataxxxx'] = User::join('sis_depen_user', 'sis_depen_user.user_id', 'users.id')
                ->join('sis_cargos', 'users.sis_cargo_id', '=', 'sis_cargos.id')
                ->where(
                    function ($queryxxx) use ($dataxxxx) {
                        // $whereinx = [2];
                        // if (isset($dataxxxx['whereinx'])) {
                        //     $whereinx = $dataxxxx['whereinx'];
                        // }
                        $queryxxx->whereIn('sis_depen_user.sis_depen_id', $dataxxxx['whereinx']);
                        $queryxxx->where('sis_depen_user.i_prm_responsable_id', 227);
                        $queryxxx->whereIn('users.sis_cargo_id', $dataxxxx['cargosxx']);
                    }
                )
                ->get($selected);
        } else {
            $dataxxxx['dataxxxx'] = User::join('sis_cargos', 'users.sis_cargo_id', '=', 'sis_cargos.id')
                ->where('users.id', $dataxxxx['usersele'])->get($selected);
        }
        $respuest = $this->getCuerpoUsuarioCT($dataxxxx);
        return    $respuest;
    }

    /**
     * listado de localidades
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getLocalidadesCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = SisLocalidad::select('sis_localidads.s_localidad as optionxx', 'sis_localidads.id as valuexxx')
            ->where(function ($queryxxx) use ($dataxxxx) {
                if (isset($dataxxxx['whereinx']) && count($dataxxxx['whereinx'])) {
                    $queryxxx->whereIN('id', $dataxxxx['whereinx']);
                }
                if (isset($dataxxxx['wherenot']) && count($dataxxxx['wherenot'])) {
                    $queryxxx->whereNotIn('id', $dataxxxx['wherenot']);
                }
            })
            ->get();
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

    /**
     * listoado de recursos para combo
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getAgRecursosComboCT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = AgRecurso::select('ag_recursos.s_recurso as optionxx', 'ag_recursos.id as valuexxx')
            ->get();
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

    /**
     * listoado de entidades para combo
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getSisEntidadComboCT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = SisEntidad::select('sis_entidads.nombre as optionxx', 'sis_entidads.id as valuexxx')
            ->get();
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

    /**
     * listado de usuarios contratistas  para combo
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getFuncionarioContratistaComboCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        if (!isset($dataxxxx['campoxxx'])) {
            $dataxxxx['campoxxx'] = 'name';
        }
        $dataxxxx['dataxxxx'] = User::join('sis_depen_user', 'users.id', '=', 'sis_depen_user.user_id')
            ->join('sis_depens', 'sis_depen_user.sis_depen_id', '=', 'sis_depens.id')
            ->join('sis_depeservs', 'sis_depens.id', '=', 'sis_depeservs.sis_depen_id')
            ->orderBy($dataxxxx['campoxxx'], $dataxxxx['orderxxx'])
            ->whereIn('users.sis_cargo_id', [5, 25, 35])
            ->where('sis_depeservs.sis_servicio_id', 6)
            ->where('sis_depen_user.sis_esta_id', 1)
            ->where('sis_depen_user.sis_depen_id', $dataxxxx['dependid'])
            ->orderBy('s_primer_nombre', 'ASC')
            ->get(['users.name as optionxx', 'users.id as valuexxx', 's_documento']);
        $respuest = ['comboxxx' => $this->getCuerpoUsuarioCT($dataxxxx)];
        return $respuest;
    }

    /**
     * lista de usuarios por el numero de cédula
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getUsuarioCT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = User::whereIn('s_documento', $dataxxxx['document'])
            ->orderBy($dataxxxx['campoxxx'], $dataxxxx['orderxxx'])
            ->get(['users.name as optionxx', 'users.id as valuexxx', 's_documento']);
        $respuest = ['comboxxx' => $this->getCuerpoUsuarioCT($dataxxxx)];
        return $respuest;
    }

    /**
     * Lista de usuarios que pertenezcan a upis con servicio territorio
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getUsuarioTerritorioCT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = User::whereIn('s_documento', $dataxxxx['document'])
            ->orderBy($dataxxxx['campoxxx'], $dataxxxx['orderxxx'])
            ->get(['users.name as optionxx', 'users.id as valuexxx', 's_documento']);
        $respuest = ['comboxxx' => $this->getCuerpoUsuarioCT($dataxxxx)];
        return $respuest;
    }

    /**
     * listado de dependencias para acta de encuentro para combo
     *
     * @param array $dataxxxx
     * @param array $soloTerritorio
     * @return array $respuest
     */
    public function getDepenTerritorioAECT($dataxxxx, $soloTerritorio = true)
    {
        $dataxxxx['dataxxxx'] = SisDepen::join('sis_depeservs', 'sis_depens.id', '=', 'sis_depeservs.sis_depen_id');

        if ($soloTerritorio) {
            $dataxxxx['dataxxxx'] = $dataxxxx['dataxxxx']->where('sis_depeservs.sis_servicio_id', 6);
        }

        $dataxxxx['dataxxxx'] = $dataxxxx['dataxxxx']->where('sis_depeservs.sis_esta_id', 1)
            ->get(['sis_depens.nombre as optionxx', 'sis_depens.id as valuexxx']);
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

    public function getFuncionarioComboCT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = User::join('sis_depen_user', 'users.id', '=', 'sis_depen_user.user_id')
            ->join('sis_depens', 'sis_depen_user.sis_depen_id', '=', 'sis_depens.id')
            ->join('sis_depeservs', 'sis_depens.id', '=', 'sis_depeservs.sis_depen_id')
            ->whereIn('prm_tvinculacion_id', [1673, 1674])
            ->where('sis_depeservs.sis_servicio_id', 6)
            ->get(['users.name as optionxx', 'users.id as valuexxx', 's_documento']);
        $respuest = ['comboxxx' => $this->getCuerpoUsuarioCT($dataxxxx)];
        return $respuest;
    }

    /**
     * listado de justificaciones
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getEstusuariosAECT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = Estusuario::where('sis_esta_id', $dataxxxx['estadoid'])
            ->where('prm_formular_id', $dataxxxx['formular'])
            ->orderBy('estusuarios.estado', 'asc')
            ->get(['estusuarios.estado as optionxx', 'estusuarios.id as valuexxx']);
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

    /**
     * listado de estados
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getEstadosAECT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] =  SisEsta::where(function ($queryxxx) use ($dataxxxx) {
            if (isset($dataxxxx['notinxxx'])) {
                $queryxxx->whereNotIn('id', $dataxxxx['notinxxx']);
            }
            if (isset($dataxxxx['inxxxxxx'])) {
                $queryxxx->whereIn('id', $dataxxxx['inxxxxxx']);
            }
        })
            ->orderBy($dataxxxx['campoxxx'], $dataxxxx['orderxxx'])
            ->get(['sis_estas.s_estado as optionxx', 'sis_estas.id as valuexxx']);
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

    public function getSisEntidadCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        if (!isset($dataxxxx['campoxxx'])) {
            $dataxxxx['campoxxx'] = 'nombre';
        }
        $dataxxxx['dataxxxx'] = SisEntidad::orderby($dataxxxx['campoxxx'], $dataxxxx['orderxxx'])
            ->get(['sis_entidads.nombre as optionxx', 'sis_entidads.id as valuexxx']);
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

    public function getSisDepenCT($dataxxxx, $modeloxx = null)
    {
        $dataxxxx = $this->getCampoCT($dataxxxx, 'nombre');
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = SisDepen::orderby($dataxxxx['campoxxx'], $dataxxxx['orderxxx'])
            ->where('sis_esta_id', 1)
            ->get(['sis_depens.nombre as optionxx', 'sis_depens.id as valuexxx']);
            $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

    public function getAeRecursosAECT($dataxxxx)
    {
        $dataxxxx = $this->getCampoCT($dataxxxx, 's_recurso');
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $notinxxx = [];
        if (isset($dataxxxx['notinxxx'])) {
            $notinxxx = $dataxxxx['notinxxx'];
        }
        $notinxxx = AeRecurso::whereNotIn('ae_recuadmi_id', $notinxxx)
            ->where('ae_encuentro_id', $dataxxxx['actaencu'])
            ->get(['ae_recuadmi_id']);

        $dataxxxx['dataxxxx'] = AeRecuadmi::whereNotIn('id', $notinxxx)
            ->where('prm_trecurso_id', $dataxxxx['padrexxx'])
            ->orderby($dataxxxx['campoxxx'], $dataxxxx['orderxxx'])
            ->get(['ae_recuadmis.s_recurso as optionxx', 'ae_recuadmis.id as valuexxx']);
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

    /**
     * Encontrar las dependencias del nnaj con respeto a la del usuario que se encuentra logueado
     *
     * @param array $dataxxxx
     * @param object $modeloxx
     * @return array $respuest
     */
    public function getUpisNnajUsuarioCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        // // * encontrar las dependencia del nnaj
        $upisnnaj = SisDepen::select(['sis_depens.id'])
            ->join('nnaj_upis', 'sis_depens.id', '=', 'nnaj_upis.sis_depen_id')
            // * encontrar las upis activas del nnaj
            ->where(function ($queryxxx) use ($dataxxxx) {
                $queryxxx->where('nnaj_upis.sis_nnaj_id', $dataxxxx['nnajidxx']);
                $queryxxx->where('nnaj_upis.sis_esta_id', 1);
            })
            ->get()->toArray();
        // * encontrar las dependencias del profesional registrado y que sean comunes a las del nnaj
        $dataxxxx['dataxxxx'] = SisDepen::join('sis_depen_user', 'sis_depens.id', '=', 'sis_depen_user.sis_depen_id')
            ->where(function ($queryxxx) use ($upisnnaj) {
                $queryxxx->where('sis_depen_user.user_id', Auth::user()->id);
                $queryxxx->whereIn('sis_depen_user.sis_depen_id', $upisnnaj);
                $queryxxx->where('sis_depen_user.sis_esta_id', 1);
            })
            // * encontrar la upi que se le asignó
            ->orWhere(function ($queryxxx) use ($dataxxxx) {
                $queryxxx->where('sis_depens.id',  $dataxxxx['dependid']);
            })
            ->get(['sis_depens.id as valuexxx', 'sis_depens.nombre as optionxx']);
        $respuest = $this->getCuerpoComboSinValueCT($dataxxxx);
        return $respuest;
    }

    /**
     * Encontrar las áreas o contextos pedagógicos asignadas al usuario que se encuentra logueado
     *
     * @param array $dataxxxx
     * @param object $modeloxx
     * @return array $respuest
     */
    public function getAreasUsuarioCT($dataxxxx, $modeloxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = User::join('area_user', 'users.id', '=', 'area_user.user_id')
            ->join('areas', 'area_user.area_id', '=', 'areas.id')
            ->where(function ($queryxxx) {
                $queryxxx->where('area_user.user_id', Auth::User()->id);
                $queryxxx->where('area_user.sis_esta_id', 1);
            })
            ->orWhere(function ($queryxxx) use ($modeloxx) {
                if (!is_null($modeloxx)) {
                    $queryxxx->where('areas.id', $modeloxx->area_id);
                }
            })
            ->get(['areas.id as valuexxx', 'areas.nombre as optionxx']);
        $respuest = $this->getCuerpoComboSinValueCT($dataxxxx);
        return $respuest;
    }

    /**
     *  encontrar las upi/dependencias del usuasrio conectado
     */
    public function getUpiUsuarioCT($dataxxxx,  $modeloxx = null)
    {
        $dataxxxx = $this->getCampoCT($dataxxxx, 'nombre');
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = SisDepen::join('sis_depen_user', 'sis_depens.id', '=', 'sis_depen_user.sis_depen_id')
            ->where(function ($queryxxx) {
                $queryxxx->where('user_id', Auth::user()->id);
                $queryxxx->where('sis_depen_user.sis_esta_id', 1);
            })
            // * encontrar la upi que se le asignó
            ->orWhere(function ($queryxxx) use ($modeloxx) {
                if (!is_null($modeloxx)) {
                    $queryxxx->where('sis_depens.id',  $modeloxx->sis_deporigen_id);
                }
            })
            ->get(['sis_depens.id as valuexxx', 'sis_depens.nombre as optionxx']);
        $respuest = $this->getCuerpoComboSinValueCT($dataxxxx);
        return $respuest;
    }

    /**
     * lista de usuarios por cargos y upi
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getUsuarioCargosCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        if (!isset($dataxxxx['campoxxx'])) {
            $dataxxxx['campoxxx'] = 'name';
        }

        $dataxxxx['dataxxxx'] = User::whereIn('sis_cargo_id', $dataxxxx['cargosxx'])
            ->join('sis_depen_user', 'users.id', '=', 'sis_depen_user.user_id')
            ->orderBy($dataxxxx['campoxxx'], $dataxxxx['orderxxx'])
            ->where('sis_depen_user.sis_depen_id', $dataxxxx['upidxxxx'])
            ->get(['users.name as optionxx', 'users.id as valuexxx', 's_documento']);
        $respuest = ['comboxxx' => $this->getCuerpoUsuarioCT($dataxxxx)];
        return $respuest;
    }

    public function getSisDepenComboINCT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = SisDepen::whereIn('id', $dataxxxx['inxxxxxx'])
            ->orderby($dataxxxx['campoxxx'], $dataxxxx['orderxxx'])
            ->get(['sis_depens.nombre as optionxx', 'sis_depens.id as valuexxx']);
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

    public function getUpiUsuarioRegistraCT($dataxxxx,  $modeloxx = null)
    {
        $dataxxxx = $this->getCampoCT($dataxxxx, 'nombre');
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = User::where(function ($queryxxx) use ($modeloxx, $dataxxxx) {
            if (!is_null($modeloxx)) {
                $queryxxx->where('id',  $dataxxxx['usuaridx']);
            } else {
                $queryxxx->where('id',  Auth::id());
            }
        })
            ->get(['users.id as valuexxx', 'users.name as optionxx', 'users.s_documento']);
        $respuest = $this->getCuerpoUsuarioCT($dataxxxx);
        return $respuest;
    }

    public function getGradoAsignaturasCT($dataxxxx)
    {
        $dataxxxx = $this->getCampoCT($dataxxxx, 'nombre');
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = EdaAsignatu::where(function ($queryxxx) use ($dataxxxx) {
            $queryxxx->where('eda_asignatus.sis_esta_id', 1);
            // $queryxxx->whereNotIn('eda_asignatus.id', EduPresaber::where('edu_pruediag_id', $dataxxxx['pruediag'])->get(['eda_asignatu_id']));
        })
            // * encontrar la asignatura que se le asignó
            ->orWhere(function ($queryxxx) {
                if (!is_null($this->opciones['modeloxx'])) {
                    $queryxxx->where('eda_asignatus.id',   $this->opciones['modeloxx']->eda_asignatu_id);
                }
            })
            ->get(['eda_asignatus.id as valuexxx', 'eda_asignatus.s_asignatura as optionxx']);
        $respuest = $this->getCuerpoComboSinValueCT($dataxxxx);
        return $respuest;
    }

    public function getAsignaturaPresaberesCT($dataxxxx)
    {

        $dataxxxx = $this->getCampoCT($dataxxxx, 'nombre');
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = EdaPresaber::where(function ($queryxxx) use ($dataxxxx) {
            $notinxxx = EduPresaber::where('edu_pruediag_id', $dataxxxx['pruediag'])
                ->where('edu_pruediag_id', $dataxxxx['pruediag'])
                ->get(['eda_presaber_id']);
            $queryxxx->where('eda_presabers.sis_esta_id', 1);
            $queryxxx->whereNotIn('eda_presabers.id', $notinxxx);
        })

            ->join('eda_asignatu_eda_presaber', 'eda_presabers.id', '=', 'eda_asignatu_eda_presaber.eda_presaber_id')
            ->where('eda_asignatu_eda_presaber.eda_asignatu_id', $dataxxxx['asignatu'])

            // * encontrar la asignatura que se le asignó
            ->orWhere(function ($queryxxx) {
                if (!is_null($this->opciones['modeloxx'])) {
                    $queryxxx->where('eda_presabers.id',   $this->opciones['modeloxx']->eda_presaber_id);
                }
            })
            ->get(['eda_presabers.id as valuexxx', 'eda_presabers.s_presaber as optionxx']);
        $respuest = $this->getCuerpoComboSinValueCT($dataxxxx);
        return $respuest;
    }

    public function getResponsableUpiSinCargosCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        // $selected=['users.name as optionxx', 'users.id as valuexxx','users.s_documento'];
        $selected = ['users.id as valuexxx', 'users.s_documento', DB::raw("users.name||' ('||sis_cargos.s_cargo||')' AS optionxx")];
        if ($dataxxxx['usersele'] == 0) {
            $dataxxxx['dataxxxx'] = User::join('sis_depen_user', 'sis_depen_user.user_id', 'users.id')
                ->join('sis_cargos', 'users.sis_cargo_id', '=', 'sis_cargos.id')
                ->where(
                    function ($queryxxx) use ($dataxxxx) {
                        $whereinx = [2];
                        if (isset($dataxxxx['whereinx'])) {
                            $whereinx = $dataxxxx['whereinx'];
                        }
                        $queryxxx->whereIn('sis_depen_user.sis_depen_id', $whereinx);
                    }
                )
                ->get($selected);
        } else {
            // $dataxxxx['dataxxxx'] = User::where('users.id',$dataxxxx['usersele'])->get($selected);
            $dataxxxx['dataxxxx'] = User::join('sis_cargos', 'users.sis_cargo_id', '=', 'sis_cargos.id')
                ->where('users.id', $dataxxxx['usersele'])->get($selected);
        }
        $respuest = $this->getCuerpoUsuarioCT($dataxxxx);
        return    $respuest;
    }

    /**
     * grado que se asigna en la prueba diagnóstica
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getGradoPruebaDiagnosticaCT($dataxxxx)
    {
        $dataxxxx = $this->getCampoCT($dataxxxx, 's_grado');
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = EdaGrado::where('id', $dataxxxx['gradoidx'])
            ->get(['eda_grados.id as valuexxx', 'eda_grados.s_grado as optionxx']);
        $respuest = $this->getCuerpoComboSinValueCT($dataxxxx);
        return $respuest;
    }

    public function getUpiUsuarios($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $selected = ['users.name as optionxx', 'users.id as valuexxx', 'users.s_documento'];
        $dataxxxx['dataxxxx'] = SisDepen::select($selected)
            ->join('sis_depen_user', 'sis_depens.id', '=', 'sis_depen_user.sis_depen_id')
            ->join('users', 'sis_depen_user.user_id', '=', 'users.id')
            ->where('sis_depen_user.sis_esta_id', 1)
            ->get();
        $respuest = $this->getCuerpoUsuarioCT($dataxxxx);
        return    $respuest;
    }


    public function getDependenciasNnajUsuarioCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);


        $notinxxy = SisDepen::join('nnaj_upis', 'sis_depens.id', '=', 'nnaj_upis.sis_depen_id')
            ->where('nnaj_upis.sis_nnaj_id', $dataxxxx['padrexxx'])
            ->where('nnaj_upis.sis_esta_id', 1)
            ->get(['sis_depens.id']);
        $dataxxxx['dataxxxx'] = SisDepen::select(['sis_depens.id as valuexxx', 'sis_depens.nombre as optionxx', 's_direccion', 's_telefono'])->join('sis_depen_user', 'sis_depens.id', '=', 'sis_depen_user.sis_depen_id')
            ->where('sis_depen_user.user_id', Auth::user()->id)
            ->wherein('sis_depen_user.sis_depen_id', $notinxxy->toArray())
            ->where('sis_depen_user.sis_esta_id', 1)
            ->get();
        $respuest = $this->getCuerpoComboSinValueCT($dataxxxx);
        return $respuest;
    }


    //Consulta dependencia por su tipo (Territorio, externa,interna, convenio)
    public function getSisDepenComboTipoT($dataxxxx)
    {
        $dataxxxx['dataxxxx'] = SisDepen::whereIn('i_prm_tdependen_id', $dataxxxx['inxxxxxx'])
            ->where('sis_esta_id', 1)
            ->orderby($dataxxxx['campoxxx'], $dataxxxx['orderxxx'])
            ->get(['sis_depens.nombre as optionxx', 'sis_depens.id as valuexxx']);
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

    /**
     * listado de upzs de la localidad
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getSisLocalupzCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = SisLocalupz::select('sis_upzs.s_upz as optionxx', 'sis_localupzs.id as valuexxx')
            ->join('sis_upzs', 'sis_localupzs.sis_upz_id', '=', 'sis_upzs.id')
            ->where(function ($queryxxx) use ($dataxxxx) {
                $queryxxx->where('sis_localidad_id', $dataxxxx['padrexxx']);
                if (isset($dataxxxx['whereinx']) && count($dataxxxx['whereinx'])) {
                    $queryxxx->whereIN('id', $dataxxxx['whereinx']);
                }
                if (isset($dataxxxx['wherenot']) && count($dataxxxx['wherenot'])) {
                    $queryxxx->whereNotIn('id', $dataxxxx['wherenot']);
                }
            })
            ->get();
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

    /**
     * listado de barrios de la upz
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getSisUpzBarriCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = SisUpzbarri::select('sis_barrios.s_barrio as optionxx', 'sis_upzbarris.id as valuexxx')
            ->join('sis_barrios', 'sis_upzbarris.sis_barrio_id', '=', 'sis_barrios.id')
            ->where(function ($queryxxx) use ($dataxxxx) {
                $queryxxx->where('sis_localupz_id', $dataxxxx['padrexxx']);
                if (isset($dataxxxx['whereinx']) && count($dataxxxx['whereinx'])) {
                    $queryxxx->whereIN('id', $dataxxxx['whereinx']);
                }
                if (isset($dataxxxx['wherenot']) && count($dataxxxx['wherenot'])) {
                    $queryxxx->whereNotIn('id', $dataxxxx['wherenot']);
                }
            })
            ->get();
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }


    /**
     * listado de departamentos del pais
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getSisDepartamCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = SisDepartam::select('sis_departams.s_departamento as optionxx', 'sis_departams.id as valuexxx')
            ->where(function ($queryxxx) use ($dataxxxx) {
                $queryxxx->where('sis_pai_id', $dataxxxx['padrexxx']);
                if (isset($dataxxxx['whereinx']) && count($dataxxxx['whereinx'])) {
                    $queryxxx->whereIN('id', $dataxxxx['whereinx']);
                }
                if (isset($dataxxxx['wherenot']) && count($dataxxxx['wherenot'])) {
                    $queryxxx->whereNotIn('id', $dataxxxx['wherenot']);
                }
            })
            ->get();
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }

     /**
     * listado de municipios del departamento
     *
     * @param array $dataxxxx
     * @return array $respuest
     */
    public function getSisMunicipioCT($dataxxxx)
    {
        $dataxxxx = $this->getDefaultCT($dataxxxx);
        $dataxxxx['dataxxxx'] = SisMunicipio::select('sis_municipios.s_municipio as optionxx', 'sis_municipios.id as valuexxx')
            ->where(function ($queryxxx) use ($dataxxxx) {
                $queryxxx->where('sis_departam_id', $dataxxxx['padrexxx']);
                if (isset($dataxxxx['whereinx']) && count($dataxxxx['whereinx'])) {
                    $queryxxx->whereIN('id', $dataxxxx['whereinx']);
                }
                if (isset($dataxxxx['wherenot']) && count($dataxxxx['wherenot'])) {
                    $queryxxx->whereNotIn('id', $dataxxxx['wherenot']);
                }
            })
            ->get();
        $respuest = ['comboxxx' => $this->getCuerpoComboSinValueCT($dataxxxx)];
        return $respuest;
    }
}
//

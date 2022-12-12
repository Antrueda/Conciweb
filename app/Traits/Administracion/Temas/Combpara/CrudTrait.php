<?php

namespace App\Traits\Administracion\Temas\Combpara;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait CrudTrait
{
    /**
     * grabar o actualizar registros para paises
     *
     * @param array $dataxxxx
     * @return $usuariox
     */
    public function setComboParametro($dataxxxx)
    {
        $respuest = DB::transaction(function () use ($dataxxxx) {
            $datacrea=$dataxxxx['requestx']->all();
            unset($datacrea['_method']);
            unset($datacrea['_token']);
            $datacrea['user_edita_id'] = Auth::user()->id;
            switch ($dataxxxx['accionxx']) {
                case 1: // crear
                    $datacrea['user_crea_id'] = Auth::user()->id;
                    $dataxxxx['modeloxx'] = $dataxxxx['padrexxx']->parametros()->attach([$dataxxxx['requestx']->parametro_id => $datacrea]);
                    break;
                case 2: // editar
                    $datacrea['sis_esta_id'] = $dataxxxx['padrexxx']
                    ->parametros()
                    ->find($dataxxxx['modeloxx']->id)
                    ->pivot
                    ->sis_esta_id;
                    $dataxxxx['padrexxx']->parametros()->updateExistingPivot($dataxxxx['modeloxx']->id, $datacrea);
                    break;
                case 3: // inactivar o activar
                    $datacrea['sis_esta_id'] = $dataxxxx['padrexxx']
                    ->parametros()
                    ->find($dataxxxx['modeloxx']->id)
                    ->pivot
                    ->sis_esta_id;
                    $datacrea['sis_esta_id']=$datacrea['sis_esta_id']==1?2:1;
                    $dataxxxx['padrexxx']->parametros()->updateExistingPivot($dataxxxx['modeloxx']->id, $datacrea);
                    break;
            }
            $this->getActualizaCacheTCT(['temaxxxx'=>$dataxxxx['padrexxx']->id]);
            return $dataxxxx['modeloxx'];
        }, 5);
        return  $respuest;
    }
}

<?php

namespace App\Traits\Administracion\Correos;


use App\Models\Asunto;
use App\Models\ConciCorreoinv;
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
    public function setCorreos($dataxxxx)
    {
        
        $respuest = DB::transaction(function () use ($dataxxxx) {
            
            if (isset($dataxxxx['modeloxx']->id)) {
                $dataxxxx['modeloxx']->update($dataxxxx['requestx']->all());
            } else {
                $dataxxxx['modeloxx'] = ConciCorreoinv::create($dataxxxx['requestx']->all());
            }
            
            return $dataxxxx['modeloxx'];
        }, 5);
        return redirect()
            ->route($dataxxxx['routxxxx'], [$respuest->id])
            ->with('info', $dataxxxx['infoxxxx']);
    }
}

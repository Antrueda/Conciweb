<?php

namespace App\Traits\TextoAdmin\Texto;

use App\Models\Acciones\Grupales\Traslado\MotivoEgreso;
use App\Models\Acciones\Grupales\Traslado\MotivoEgresoSecu;
use App\Models\fichaobservacion\FosTse;
use App\Models\Texto;
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
    public function setTexto($dataxxxx)
    {
        $respuest = DB::transaction(function () use ($dataxxxx) {
            $dataxxxx['requestx']->request->add(['user_edita_id' => Auth::user()->id]);
            if (isset($dataxxxx['modeloxx']->id)) {
                $dataxxxx['modeloxx']->update($dataxxxx['requestx']->all());
            } else {
                $dataxxxx['requestx']->request->add(['user_crea_id' => Auth::user()->id]);
                $dataxxxy = $dataxxxx['requestx']->all();
                $arrayxx =
                    [
                        "texto" => $dataxxxy['texto'],
                        "tipotexto_id" =>  $dataxxxy['tipotexto_id'],
                        "sis_esta_id" =>  $dataxxxy['sis_esta_id'],
                        "user_edita_id" =>  $dataxxxy['user_edita_id'],
                        "user_crea_id" =>  $dataxxxy['user_crea_id']
                    ];


                $dataxxxx['modeloxx'] = Texto::create($arrayxx);
            }
            return $dataxxxx['modeloxx'];
        }, 5);
        return redirect()
            ->route($dataxxxx['routxxxx'], [$respuest->id])
            ->with('info', $dataxxxx['infoxxxx']);
    }
}

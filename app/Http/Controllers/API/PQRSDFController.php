<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

//Models
use App\Models\Tramite\Tramite;

use App\Models\Peticionario\{
    Peticionario,
    CondicionPeticionario,
    DesplegableCondicionPeticionario,
    AcudientePeticionario,
};

class PQRSDFController extends Controller
{
    public function getInformacion(Request $request){
        $validator = Validator::make($request->all(), [
            'id_sinproc' => 'required|numeric|exists:tramites,id_sinproc',
        ]);
 
        if ($validator->fails()) {
            return response([
                'message' => 'El SINPROC ingresado no existe',
            ], 400);
        }
        $validated = $validator->validated();

        // $tramite = Tramite::where('id_sinproc', $validated['id_sinproc'])->first();
        $tramite = DB::table('PETICIONES.tramites as t')
            ->join('PETICIONES.tipostramite as tt', 't.tipo_tramite', 'tt.id')
            ->leftJoin('PETICIONES.dependencias as d', 't.dependencia', 'd.id')
            ->select('t.id', 't.id_sinproc', 't.id_peticionario', 'tt.nombre as tipo_tramite', 't.identifica_dependencia', 'd.nombre as dependencia', 't.identifica_funcionario', 't.funcionario', 't.info_tramite', 't.radico_previamente_dp', 't.created_at')
            ->where('t.id_sinproc', $validated['id_sinproc'])
            ->first();    
        $peticionario = DB::table('PETICIONES.peticionarios as p')
            ->leftJoin('PETICIONES.combo_parametros as cp1', 'p.tipo_documento', '=', 'cp1.id')
            ->leftJoin('PETICIONES.rangosedad as re', 'p.rango_edad', '=', 're.id')
            ->leftJoin('PETICIONES.combo_parametros as cp3', 'p.nivel_escolaridad', '=', 'cp3.id')
            ->leftJoin('PETICIONES.combo_parametros as cp4', 'p.identidad_genero', '=', 'cp4.id')
            ->leftJoin('PETICIONES.combo_parametros as cp5', 'p.orientacion_genero', '=', 'cp5.id')
            ->leftJoin('PETICIONES.combo_parametros as cp6', 'p.sexo', '=', 'cp6.id')
            ->leftJoin('PETICIONES.nacionalidades as n', 'p.nacionalidad', '=', 'n.id')
            ->leftJoin('PETICIONES.departamentos as dp', 'p.departamento', 'dp.id')
            ->leftJoin('PETICIONES.municipios as mn', 'p.municipio', 'mn.id')
            ->leftJoin('PETICIONES.localidades as l', 'p.localidad', '=', 'l.id')
            ->leftJoin('PETICIONES.gruposafectados as g', 'p.grupo_afectado', '=', 'g.id')
            ->select(
                'p.primer_nombre', 
                'p.segundo_nombre', 
                'p.primer_apellido', 
                'p.segundo_apellido', 
                'cp1.nombre as tipo_documento',
                'p.numero_documento',
                'p.fecha_nacimiento',
                'p.n_celular',
                'p.telefono',
                'l.nombre as localidad',
                'dp.nombre as departamento',
                'mn.nombre as municipio',
                'p.direccion',
                're.nombre as rango_edad',
                'cp3.nombre as nivel_escolaridad',
                'cp4.nombre as identidad_genero',
                'cp5.nombre as orientacion_genero',
                'cp6.nombre as sexo',
                'n.nombre as nacionalidad',
                'g.nombre as grupo_afectado',
                'p.acepta_ley_1581',
                'p.acepta_ley_1437',
                'p.email',
                'p.created_at')
            ->where('p.id', $tramite->id_peticionario)
            ->first();
        $condicionesProteccion = DB::table('PETICIONES.condicionespeticionario as condip')
            ->join('PETICIONES.condicionesproteccion as cp', 'condip.id_condicion', 'cp.id')
            ->select('cp.nombre as condicion')
            ->where('condip.id_peticionario', $tramite->id_peticionario)
            ->get();
        $desplegablesCondiciones = DB::table('PETICIONES.dcondicionespeticionario as dpeti')
            ->join('PETICIONES.dcondicionesproteccion as dcp', 'dpeti.id_desplegable', 'dcp.id')
            ->join('PETICIONES.condicionesproteccion as cp', 'dcp.id_condicion', 'cp.id')
            ->select('cp.nombre as condicion', 'dcp.nombre as desplegable')
            ->where('dpeti.id_peticionario', $tramite->id_peticionario)
            ->get();
        $acudientePeticionario = DB::table('PETICIONES.acudientepeticionario as ap')
            ->join('PETICIONES.combo_parametros as cp', 'ap.parentesco_acudiente', 'cp.id')
            ->select(
                'ap.primer_nombre_acudiente',
                'ap.segundo_nombre_acudiente',
                'ap.primer_apellido_acudiente',
                'ap.segundo_apellido_acudiente',
                'ap.direccion_acudiente',
                'ap.n_celular_acudiente',
                'ap.telefono_acudiente',
                'ap.email_acudiente',
                'cp.nombre as parentesco_acudiente')
            ->where('ap.id_peticionario', $tramite->id_peticionario)
            ->first();
        /**
         * Falta completar consulta peticionario con listas
         * consulta de condiciones de proteccion
         * consulta de desplegables condiciones proteccion
         * consulta acudiente peticionario
         */
        return response([
            'Tramite' => $tramite,
            'Peticionario' => $peticionario,
            'Condiciones Proteccion' => $condicionesProteccion,
            'Desplegables Condiciones Proteccion' => $desplegablesCondiciones,
            'Acudiente Peticionario' => $acudientePeticionario,
        ], 200);
    }
}

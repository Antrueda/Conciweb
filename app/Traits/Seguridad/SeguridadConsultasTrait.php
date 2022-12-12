<?php

namespace App\Traits\Seguridad;

use App\Models\Simianti\Ge\GePersonalIdipron;
use App\Models\User;
use App\Models\Usuario\RolUsuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


/**
 * Este trait permite realizar los calculos para encontrar cuantos días adicionales se le darán
 * terminado el mes para el carge de información
 */
trait SeguridadConsultasTrait
{
    public function getDt($queryxxx, $requestx)
    {
        return DataTables()
            ->of($queryxxx)

            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                   
                    return  view($requestx->botonesx, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }
            )
           
            ->addColumn(
                's_estado',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->estadoxx, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            // ->setTotalRecords($totalxxx)
            ->rawColumns(['botonexx', 's_estado'])
            ->make(true);
    }
    public function getDtTotal($queryxxx, $requestx, $totalxxx)
    {
        return DataTables()
            ->of($queryxxx)

            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    $queryxxx['nuevanti'] = false;
                    $queryxxx = (object)$queryxxx;
                    if (!isset($queryxxx->sis_esta_id)) {
                        $queryxxx->nuevanti = true;
                    }
                    return  view($requestx->botonesx, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }
            )
            ->addColumn(
                's_documento',
                function ($queryxxx) {
                    $queryxxx = (object)$queryxxx;
                    if (!isset($queryxxx->s_documento)) {
                        $queryxxx->s_documento = $queryxxx->id;
                    }
                    return $queryxxx->s_documento;
                }
            )
            ->addColumn(
                's_estado',
                function ($queryxxx) use ($requestx) {

                    if (!isset($queryxxx->sis_esta_id)) {
                        $queryxxx['sis_esta_id'] = 1;
                        $queryxxx['s_estado'] = 'ACTIVO';
                    }
                    $queryxxx = (object)$queryxxx;
                    return  view($requestx->estadoxx, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            // ->setTotalRecords($totalxxx)
            ->rawColumns(['botonexx', 's_estado'])
            ->make(true);
    }



    public function getUsuario(Request $request)
    {

        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'contrase'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  User::select([

                'usuario_rol.consec',
                'usuario_rol.nombre',
                'usuario_rol.apellido',
                'usuario_rol.email',
                'usuario_rol.cedula',
                
            ]);
               

        
            return $this->getDt($dataxxxx, $request);

        }
    }

    public function getUsuarioRoles(Request $request)
    {

        if ($request->ajax()) {
            $request->routexxx = [$this->opciones['routxxxx'], 'contrase'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.botones.botonesapi';
            $request->estadoxx = 'layouts.components.botones.estadosx';
            $dataxxxx =  RolUsuario::select([
                'model_has_roles.role_id',
                'roles.name',
 

                ])
                ->join('roles','model_has_roles.role_id','=','roles.id')

                ->where('model_has_roles.model_id',$request->padrexxx);
                return $this->getDt($dataxxxx, $request);

        }
    }



    
}


<?php

namespace App\Traits;

use App\Traits\GestionTiempos\ManageTimeTrait;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

trait DatatableTrait
{
    use  ManageTimeTrait;

    public  function getDtPermisoRol($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */
                    $role = Role::select('permission_id')
                        ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
                        ->where('role_id', $requestx->padrexxx)
                        ->where('permission_id', $queryxxx->id)->first();
                    $requestx->tieneper = isset($role->permission_id);
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');
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
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }

    public  function getDtAcciones($queryxxx, $requestx)
    {

        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {

                    $puedexxx = $this->getPuedeCargar([
                        'estoyenx' => 1,
                        'fechregi' => explode(' ',$queryxxx->created_at)[0]
                    ]);
                    /**
                     * validaciones para los permisos
                     */
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    if ($requestx->pueditar == false || $puedexxx['tienperm'] == false) {
                        $requestx->pueditar = false;
                    }
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');
                    if ($requestx->puedinac == false || $puedexxx['tienperm'] == false) {
                        $requestx->puedinac = false;
                    }
                    return  view($requestx->botonesx, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                        'puedexxx'=>$puedexxx
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
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }
    public  function getDtAccionesUpi($queryxxx, $requestx)
    {

        $datatabl=DataTables::eloquent($queryxxx);
        $datatabl->setRowId(function ($user) {
            return $user->s_documento;
        });
        $datatabl->setRowClass(function ($user) use($requestx) {
            return !$requestx->actuanti ? 'actuanti' : 'otracosa';
        });
        $datatabl->addColumn(
            'botonexx',
            function ($queryxxx) use ($requestx) {
                // $puedexxx = $this->getPuedeCargar([
                //     'estoyenx' => 1,
                //     'fechregi' => explode(' ',$queryxxx->created_at)[0]
                // ]);
                /**
                 * validaciones para los permisos
                 */
                $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                // if ($requestx->pueditar == false || $puedexxx['tienperm'] == false) {
                //     $requestx->pueditar = false;
                // }
                $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');
                // if ($requestx->puedinac == false || $puedexxx['tienperm'] == false) {
                //     $requestx->puedinac = false;
                // }
                return  view($requestx->botonesx, [
                    'queryxxx' => $queryxxx,
                    'requestx' => $requestx,
                ]);
            }
        );

        $datatabl->addColumn(
            's_estado',
            function ($queryxxx) use ($requestx) {
                return  view($requestx->estadoxx, [
                    'queryxxx' => $queryxxx,
                    'requestx' => $requestx,
                ]);
            }

        );

        $datatabl->addColumn(
            'upiservicio',
            function ($queryxxx) use ($requestx) {
                return  view($requestx->upiservicio, [
                    'queryxxx' => $queryxxx,
                    'requestx' => $requestx,
                ]);
            }

        );

        $datatabl->rawColumns(['botonexx', 's_estado','upiservicio']);
        return $datatabl->toJson();

    }

    public  function getDtAsistencias($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');

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
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }

    public  function getDtDatosVincula($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');

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

            ->addColumn(
                'situacio',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->situacio, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->addColumn(
                'emosione',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->emosione, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->addColumn(
                'personas',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->personas, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }


    public  function getDtAportantes($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');

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

            ->addColumn(
                'diaseman',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->diaseman, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }

    public  function getDtSalidas($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');

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

            ->addColumn(
                'razonesx',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->razonesx, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->addColumn(
                'responsx',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->responsx, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->addColumn(
                'telefono',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->telefono, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->addColumn(
                'edadxxxx',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->edadxxxx, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }


    public  function getDtSalidasIndividuales($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');

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

            ->addColumn(
                'razonesx',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->razonesx, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )

            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }


    //**revisar estos */

    public  function getDt($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */

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
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }


    public  function getDtras($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */

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
            ->addColumn(
                'edadxxxx',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->edadxxxx, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }
    public  function getDtUpi($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */

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
            ->addColumn(
                'upiservicio',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->upiservicio, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }






    public  function getDtSalidaz($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');

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

            ->addColumn(
                'contado',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->contado, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->addColumn(
                'razonesg',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->razonesg, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )


            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }

    public  function getDtTaller($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');

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

            ->addColumn(
                'contado',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->contado, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->addColumn(
                'responsx',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->responsx, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )


            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }




    public  function getDtGeneral($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');

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
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }
    public  function getDtMTaller($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');

                    return  view($requestx->botonesx, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }
            )
            ->addColumn(
                'modulo',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->modulo, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->addColumn(
                'unidads',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->unidads, [
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
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }

    public  function getDtMatri($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');

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
            ->addColumn(
                'contado',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->contado, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }


    public  function getDtGok($queryxxx, $requestx)
    {
        return datatables()
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
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }

    public  function getDtCasoJuridico($queryxxx, $requestx)
    {
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($requestx) {
                    /**
                     * validaciones para los permisos
                     */
                    $requestx->puedever = auth()->user()->can($requestx->routexxx[0] . '-leer');
                    $requestx->pueditar = auth()->user()->can($requestx->routexxx[0] . '-editar');
                    $requestx->puedinac = auth()->user()->can($requestx->routexxx[0] . '-borrar');

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

            ->addColumn(
                'contador',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->contador, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->addColumn(
                'fecha',
                function ($queryxxx) use ($requestx) {
                    return  view($requestx->fecha, [
                        'queryxxx' => $queryxxx,
                        'requestx' => $requestx,
                    ]);
                }

            )
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }
 

   
}

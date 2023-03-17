<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class DatatableHelper
{
    public static function getDatatable($queryxxx, $requestx)
    {
        $botonesx = $requestx->botonesx;
        $estadoxx = $requestx->estadoxx;
        return datatables()
            ->of($queryxxx)
            ->addColumn('botonexx', $requestx->botonesx)
            ->addColumn('s_estado', $requestx->estadoxx)
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }
    public static function getDatatableN($queryxxx, $requestx)
    {
        $botonesx = $requestx->botonesx;
        $estadoxx = $requestx->estadoxx;
        $botodata = json_decode($requestx->botodata);
        return datatables()
            ->of($queryxxx)
            ->addColumn(
                'botonexx',
                function ($queryxxx) use ($botonesx, $botodata) {
                    return  view($botonesx, [
                        'dataxxxx' => $queryxxx,
                        'botodata' => $botodata,
                    ]);
                }
            )
            ->addColumn(
                's_estado',
                function ($queryxxx) use ($estadoxx) {
                    return  view($estadoxx, [
                        'sis_esta_id' => $queryxxx->sis_esta_id,
                        's_estado' => $queryxxx->s_estado,
                    ]);
                }

            )
            ->rawColumns(['botonexx', 's_estado'])
            ->toJson();
    }

    public static function getDt($queryxxx, $requestx)
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

    public static function getDtGeneral($queryxxx, $requestx)
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
}

<?php

namespace App\Services\Dashboard\Ciudadano;

use App\Models\Administraccion\AdmformatoCertificado;
use App\Models\Fallo;
use App\Traits\Ciudadano\NumeroConvertirTextoTrait;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class CertificadoCiudadanoService
{
    use NumeroConvertirTextoTrait;

    //generar certificado ordinario de ciudadano
    public function generarCertificadoOrdinario($ciudaadno)
    {
        //traer informacion de administracion formato pdf certifivados
        $infocertificado = $this->getInfoFormatocertificado();

        $sanciones = Fallo::select(
            'id',
            'cedula',
            'tipo_documento',
            'entidad_emite',
            'cargo',
            'acto_numero',
            'acto_fecha',
            'acto_adminejecuto',
            'acto_fechaejecuto',
            'acto_administrativo',
            'acto_entidadejecuto',
            'acto_recurso',
            'actoseg_numero',
            'actoseg_fecha',
            'actoseg_administrativo'
        )
            ->with(
                'Sancion:id,fallo_id,clase_sancion,observacion',
                'EntidadEmite:identidad,nombre',
                'ActoAdministrativo:id,nombre',
                'ActoSegundaAdministrativo:id,nombre'
            )
            ->where('CEDULA', $ciudaadno->cedula)
            ->where('TIPO_DOCUMENTO', $ciudaadno->tipo_documento)
            ->where('sis_estado', 1)
            ->whereHas('Sancion', function ($query) {
                $query->where('estado_sancion', 1);
            })->get();

        $data = [
            'ciudadano' => $ciudaadno,
            'documento_letras' => $this->ConvertirNumerodocTexto($ciudaadno->cedula),
            'sanciones' => $sanciones,
            'infocertificado' => $infocertificado
        ];
        // dd($data);

        $context = stream_context_create(array(
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ));

        $pdf = new Dompdf();
        $pdf->setHttpContext($context);
        $options = $pdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $pdf->setOptions($options);

        $pdf->loadHtml(View::make('export.certificados.ordinario', ['data' => $data])->render());
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'archivo.pdf');
    }

    //generar certificado especial de ciudadano
    public function generarCertificadoEspecial($ciudaadno)
    {
        //traer informacion de administracion formato pdf certifivados
        $infocertificado = $this->getInfoFormatocertificado();

        $sanciones = Fallo::select(
            'id',
            'cedula',
            'tipo_documento',
            'entidad_emite',
            'cargo',
            'acto_numero',
            'acto_fecha',
            'acto_adminejecuto',
            'acto_fechaejecuto',
            'acto_administrativo',
            'acto_entidadejecuto',
            'acto_recurso',
            'actoseg_numero',
            'actoseg_fecha',
            'actoseg_administrativo'
        )
            ->with(
                'Sancion:id,fallo_id,clase_sancion,observacion',
                'EntidadEmite:identidad,nombre',
                'ActoAdministrativo:id,nombre',
                'ActoSegundaAdministrativo:id,nombre'
            )
            ->where('CEDULA', $ciudaadno->cedula)
            ->where('TIPO_DOCUMENTO', $ciudaadno->tipo_documento)
            ->where('sis_estado', 1)
            ->whereHas('Sancion', function ($query) {
                $query->whereIn('estado_sancion', [1, 2]);
            })->get();

        $data = [
            'ciudadano' => $ciudaadno,
            'documento_letras' => $this->ConvertirNumerodocTexto($ciudaadno->cedula),
            'sanciones' => $sanciones,
            'infocertificado' => $infocertificado
        ];
        // dd($data);

        $context = stream_context_create(array(
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ));

        $pdf = new Dompdf();
        $pdf->setHttpContext($context);
        $options = $pdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $pdf->setOptions($options);

        $pdf->loadHtml(View::make('export.certificados.especial', ['data' => $data])->render());
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'archivo.pdf');
    }


    public function getInfoFormatocertificado()
    {
        //como es informacion estatitico con cambios muy pocos se deja en cache
        //consultar si la info ya esta en cache
        $value = Cache::get('formato_certificado');

        if ($value) {
            return $value;
        } else {
            // Los datos no están en caché, realiza la consulta a la base de datos
            $value = AdmformatoCertificado::find(1);

            // Almacena los datos en caché
            Cache::put('formato_certificado', $value);

            return $value;
        }
    }
}

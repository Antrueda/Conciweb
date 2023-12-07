<?php

namespace App\Traits\ConsultaConci;

use App\Models\Acciones\Grupales\Traslado\MotivoEgreso;
use App\Models\Acciones\Grupales\Traslado\MotivoEgresoSecu;
use App\Models\Acciones\Grupales\Traslado\MotivoEgreu;
use App\Models\fichaobservacion\FosSeguimiento;
use App\Models\fichaobservacion\FosStse;
use App\Models\fichaobservacion\FosStsesTest;
use App\Models\fichaobservacion\FosTse;
use App\Models\Texto;
use App\Models\Tramiteusuario;
use App\Models\Usuario\Estusuario;
use App\Traits\DatatableTrait;
use App\tramiteusuario as AppTramiteusuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Border;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * Este trait permite armar las consultas para ubicacion que arman las datatable
 */
trait ListadosTrait
{
    use DatatableTrait;

    /**
     * 
     */

    // public function listaConciliaciones(Request $request)
    // {

    //     if ($request->ajax()) {
    //         // ddd($request);
    //         $request->routexxx = [$this->opciones['routxxxx'],'textos'];
    //         $request->botonesx = $this->opciones['rutacarp'] .
    //             $this->opciones['carpetax'] . '.Botones.botonesapi';
    //         $request->estadoxx = 'layouts.components.botones.estadosx';
    //         $dataxxxx = Tramiteusuario::select(
	// 			[
	// 				'conci_tramiteusuarios.num_solicitud',
	// 				'conci_tramiteusuarios.id_tramite',
    //                 'conci_tramiteusuarios.fec_solicitud_tramite',
	// 				'conci_tramiteusuarios.sis_esta_id',
	// 				'conci_sis_estas.s_estado'
	// 			]
	// 		)
    //             ->where('conci_tramiteusuarios.id_tramite', 335)
	// 			->join('conci_sis_estas', 'conci_tramiteusuarios.sis_esta_id', '=', 'conci_sis_estas.id')->orderBy('num_solicitud', 'desc');;

    //         return $this->getDt($dataxxxx, $request);
    //     }
    // }

    public function listaConciliacionesFinalizados(Request $request)
    {

        if ($request->ajax()) {
            // ddd($request);
            $request->routexxx = [$this->opciones['routxxxx'],'textos'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $dataxxxx = Tramiteusuario::select(
				[
					'conci_tramiteusuarios.num_solicitud',
                    'conci_tramiteusuarios.primernombre',
                    'conci_tramiteusuarios.segundonombre',
                    DB::raw("conci_tramiteusuarios.primernombre || ' ' || conci_tramiteusuarios.segundonombre as nombre_completo"),
                    DB::raw("TO_CHAR(updated_at, 'YYYY-MM-DD HH24:MI:SS') as fecha_actualizacion_formateada"),
                    'conci_tramiteusuarios.fec_solicitud_tramite',
                    'conci_tramiteusuarios.updated_at',
					'conci_tramiteusuarios.estadodoc',
				] 
			)
                ->where('conci_tramiteusuarios.id_tramite', 335)
                ->whereNotNull('conci_tramiteusuarios.estadodoc')
                ->whereDate('fec_solicitud_tramite', '>=', '2023-10-02');

            return $this->getDts($dataxxxx, $request);
        }
    }



    public function listaConciliacionesGeneral(Request $request)
    {

        if ($request->ajax()) {
            // ddd($request);
            $request->routexxx = [$this->opciones['routxxxx'],'textos'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $dataxxxx = Tramiteusuario::select(
				[
					'conci_tramiteusuarios.num_solicitud',
                    'conci_tramiteusuarios.primernombre',
                    'conci_tramiteusuarios.segundonombre',
                    DB::raw("conci_tramiteusuarios.primernombre || ' ' || conci_tramiteusuarios.segundonombre as nombre_completo"),
                    'conci_tramiteusuarios.fec_solicitud_tramite',
                    'conci_tramiteusuarios.updated_at',
					'conci_tramiteusuarios.estadodoc',
				] 
			)
                ->where('conci_tramiteusuarios.id_tramite', 335)
                
                ->whereDate('fec_solicitud_tramite', '>=', '2023-10-02');

            return $this->getDts($dataxxxx, $request);
        }
    }


    public function listaConciliacionesDias(Request $request)
    {

        if ($request->ajax()) {
            // ddd($request);
            $request->routexxx = [$this->opciones['routxxxx'],'textos'];
            $request->botonesx = $this->opciones['rutacarp'] .
                $this->opciones['carpetax'] . '.Botones.botonesapi';
            $dataxxxx = Tramiteusuario::select(
				[
					'conci_tramiteusuarios.num_solicitud',
                    'conci_tramiteusuarios.primernombre',
                    'conci_tramiteusuarios.segundonombre',
                    DB::raw("conci_tramiteusuarios.primernombre || ' ' || conci_tramiteusuarios.segundonombre as nombre_completo"),
                    'conci_tramiteusuarios.fec_solicitud_tramite',
                    'conci_tramiteusuarios.updated_at',
                    DB::raw("TO_CHAR(updated_at, 'YYYY-MM-DD HH24:MI:SS') as fecha_actualizacion_formateada"),
                    DB::raw('TRUNC((CAST(updated_at AS DATE) - fec_solicitud_tramite)) AS dias_de_diferencia'),
					'conci_tramiteusuarios.estadodoc',
				] 
			)
                ->where('conci_tramiteusuarios.id_tramite', 335)
                ->whereNotNull('updated_at')
                ->whereDate('fec_solicitud_tramite', '>=', '2023-10-02');

            return $this->getDts($dataxxxx, $request);
        }
    }

    /*
          'PRIMERNOMBRE',
      'SEGUNDONOMBRE',
      'PRIMERAPELLIDO',
      'SEGUNDOAPELLIDO',
*/
    // public function listaConciliaciones(Request $request)
    // {

    //     if ($request->ajax()) {
    //         // ddd($request);
    //         $request->routexxx = [$this->opciones['routxxxx'],'textos'];
    //         $request->botonesx = $this->opciones['rutacarp'] .
    //             $this->opciones['carpetax'] . '.Botones.botonesapi';
    //         $request->estadoxx = 'layouts.components.botones.estadosx';
    //         $dataxxxx = AppTramiteusuario::where('id_tramite',330);
	// 			//->join('conci_sis_estas', 'conci_tramiteusuarios.sis_esta_id', '=', 'conci_sis_estas.id');

    //         return $this->getDt($dataxxxx, $request);
    //     }
    // }

    // public function generateExcelGeneral()
    // {
    //     // Realizar la consulta a Oracle y obtener los datos
    //     $oracleData = $this->getOracleData();

    //     // Crear una instancia de PhpSpreadsheet
    //     $spreadsheet = new Spreadsheet();

    //     // Seleccionar la hoja activa y establecer los datos
    //     $spreadsheet->setActiveSheetIndex(0);
    //     $sheet = $spreadsheet->getActiveSheet();
    //     $sheet->fromArray($oracleData, null, 'A1');

    //     // Crear una respuesta HTTP para descargar el archivo Excel
    //     $response = response()->stream(
    //         function () use ($spreadsheet) {
    //             $writer = new Xlsx($spreadsheet);
    //             $writer->save('php://output');
    //         },
    //         200,
    //         [
    //             'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    //             'Content-Disposition' => 'attachment; filename="oracle_data.xlsx"',
    //         ]
    //     );

    //     return $response;
    // }

    public function generateExcelGeneral()
    {
        // Obtener datos desde Oracle (ajusta la consulta según tu esquema y necesidades)
        $oracleData = Tramiteusuario::select(
            [
                'conci_tramiteusuarios.num_solicitud',
                'conci_tramiteusuarios.primernombre',
                'conci_tramiteusuarios.segundonombre',
                DB::raw("conci_tramiteusuarios.primernombre || ' ' || conci_tramiteusuarios.segundonombre as nombre_completo"),
                'conci_tramiteusuarios.fec_solicitud_tramite',
                'conci_tramiteusuarios.updated_at',
                'conci_tramiteusuarios.estadodoc',
            ] 
        )
            ->where('conci_tramiteusuarios.id_tramite', 335)->get();
        // Crear una instancia de PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $nuevafecha = now();
        $nuevafecha=Carbon::parse($nuevafecha)->format('d/m/Y H:i:s');
        // Seleccionar la hoja activa
        $sheet = $spreadsheet->getActiveSheet();

         // Establecer estilos para los encabezados
         $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,

                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];
        //dd($nuevafecha);
        // Aplicar estilos a los encabezados
        $sheet->getStyle('A1:D1')->applyFromArray($headerStyle);
        // Agregar datos al informe
        $sheet->setCellValue('A1', 'Numero Solicitud');
        $sheet->setCellValue('B1', 'Nombre Completo');
        $sheet->setCellValue('C1', 'Fecha de Solicitud');
        $sheet->setCellValue('D1', 'Estado');

        $row = 2;
        //dd($oracleData);
        foreach ($oracleData as $data) {
            $sheet->setCellValue('A' . $row, $data->num_solicitud);
            $sheet->setCellValue('B' . $row, $data->nombre_completo);
            $sheet->setCellValue('C' . $row, $data->fec_solicitud_tramite);
            $sheet->setCellValue('D' . $row, $data->estadodoc);
            $row++;
        }
      // Congelar la primera fila (encabezados)
        $sheet->freezePane('A2');
                // Establecer anchos de columna
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);

        // Crear una respuesta HTTP para descargar el archivo Excel
        $response = response()->stream(
            function () use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="ReporteGeneral '.$nuevafecha.'.xlsx"',
            ]
        );

        return $response;
    }


    public function generateExcelFinalizado()
    {
        // Obtener datos desde Oracle (ajusta la consulta según tu esquema y necesidades)
        $oracleData =  Tramiteusuario::select(
            [
                'conci_tramiteusuarios.num_solicitud',
                'conci_tramiteusuarios.primernombre',
                'conci_tramiteusuarios.segundonombre',
                DB::raw("conci_tramiteusuarios.primernombre || ' ' || conci_tramiteusuarios.segundonombre as nombre_completo"),
                DB::raw("TO_CHAR(updated_at, 'YYYY-MM-DD HH24:MI:SS') as fecha_actualizacion_formateada"),
                'conci_tramiteusuarios.fec_solicitud_tramite',
                'conci_tramiteusuarios.updated_at',
                'conci_tramiteusuarios.estadodoc',
            ] 
        )
            ->where('conci_tramiteusuarios.id_tramite', 335)
            ->whereNotNull('conci_tramiteusuarios.estadodoc')
            ->whereDate('fec_solicitud_tramite', '>=', '2023-10-02')->get();

        // Crear una instancia de PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $nuevafecha = now();
        $nuevafecha=Carbon::parse($nuevafecha)->format('d/m/Y H:i:s');
        // Seleccionar la hoja activa
        $sheet = $spreadsheet->getActiveSheet();

         // Establecer estilos para los encabezados
         $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,

                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];

        // Aplicar estilos a los encabezados
        $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);
        // Agregar datos al informe
        $sheet->setCellValue('A1', 'Numero Solicitud');
        $sheet->setCellValue('B1', 'Nombre Completo');
        $sheet->setCellValue('C1', 'Fecha de Solicitud');
        $sheet->setCellValue('D1', 'Fecha de Actualización');
        $sheet->setCellValue('E1', 'Estado');

        $row = 2;
        //dd($oracleData);
        foreach ($oracleData as $data) {
            $sheet->setCellValue('A' . $row, $data->num_solicitud);
            $sheet->setCellValue('B' . $row, $data->nombre_completo);
            $sheet->setCellValue('C' . $row, $data->fec_solicitud_tramite);
            $sheet->setCellValue('D' . $row, $data->fecha_actualizacion_formateada);
            $sheet->setCellValue('E' . $row, $data->estadodoc);
            $row++;
        }

                // Establecer anchos de columna
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(25);

        // Crear una respuesta HTTP para descargar el archivo Excel
        $response = response()->stream(
            function () use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="ReporteFinalizados '.$nuevafecha.'.xlsx"',
            ]
        );

        return $response;
    }

    public function generateExcelDias()
    {
        // Obtener datos desde Oracle (ajusta la consulta según tu esquema y necesidades)
        $oracleData =  Tramiteusuario::select(
            [
                'conci_tramiteusuarios.num_solicitud',
                'conci_tramiteusuarios.primernombre',
                'conci_tramiteusuarios.segundonombre',
                DB::raw("conci_tramiteusuarios.primernombre || ' ' || conci_tramiteusuarios.segundonombre as nombre_completo"),
                'conci_tramiteusuarios.fec_solicitud_tramite',
                'conci_tramiteusuarios.updated_at',
                DB::raw("TO_CHAR(updated_at, 'YYYY-MM-DD HH24:MI:SS') as fecha_actualizacion_formateada"),
                DB::raw('TRUNC((CAST(updated_at AS DATE) - fec_solicitud_tramite)) AS dias_de_diferencia'),
                'conci_tramiteusuarios.estadodoc',
            ] 
        )
            ->where('conci_tramiteusuarios.id_tramite', 335)
            ->whereNotNull('updated_at')
            ->whereDate('fec_solicitud_tramite', '>=', '2023-10-02')->get();


        // Crear una instancia de PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $nuevafecha = now();
        $nuevafecha=Carbon::parse($nuevafecha)->format('d/m/Y H:i:s');
        // Seleccionar la hoja activa
        $sheet = $spreadsheet->getActiveSheet();

         // Establecer estilos para los encabezados
         $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,

                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $columstyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,

                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];

        // Aplicar estilos a los encabezados
        $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);
  
        // Agregar datos al informe
        $sheet->setCellValue('A1', 'Numero Solicitud');
        $sheet->setCellValue('B1', 'Nombre Completo');
        $sheet->setCellValue('C1', 'Fecha de Solicitud');
        $sheet->setCellValue('D1', 'Fecha de Actualización');
        $sheet->setCellValue('E1', 'Días de diferencia');
        $sheet->setCellValue('F1', 'Estado');

        $row = 2;
        //dd($oracleData);
        foreach ($oracleData as $data) {
            $sheet->setCellValue('A' . $row, $data->num_solicitud);
            $sheet->setCellValue('B' . $row, $data->nombre_completo);
            $sheet->setCellValue('C' . $row, $data->fec_solicitud_tramite);
            $sheet->setCellValue('D' . $row, $data->fecha_actualizacion_formateada);
            $sheet->setCellValue('E' . $row, $data->dias_de_diferencia);
            $sheet->setCellValue('F' . $row, $data->estadodoc);
            $sheet->getStyle('A'.$row.':F'.$row)->applyFromArray($columstyle);
            $row++;
        }

                // Establecer anchos de columna
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(25);

        // Crear una respuesta HTTP para descargar el archivo Excel
        $response = response()->stream(
            function () use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="ReporteFinalizados '.$nuevafecha.'.xlsx"',
            ]
        );

        return $response;
    }


   


}

<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\ConciReferente;
use App\Models\Soportecon;
use App\Models\Subdescripcion;
use App\Models\Texto;
use App\Models\Tramiteusuario;
use App\Traits\Reportes\Reportes\CrudTrait;
use App\Traits\Reportes\Reportes\DataTablesTrait;
use App\Traits\Reportes\Reportes\ParametrizarTrait;
use App\Traits\Reportes\Reportes\VistasTrait;
use App\Traits\Reportes\ListadosTrait;
use App\Traits\Reportes\PestaniasTrait;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DB;
use Carbon\Carbon;

/**
 * FOS Tipo de seguimiento
 */
class ReportesConciController extends Controller
{

    use ListadosTrait; // trait que arma las consultas para las datatables
    use CrudTrait; // trait donde se hace el crud de localidades
    use ParametrizarTrait; // trait donde se inicializan las opciones de configuracion
    use DataTablesTrait; // trait donde se arman las datatables que se van a utilizar
    use VistasTrait; // trait que arma la logica para lo metodos: crud
    use PestaniasTrait; // trit que construye las pestañas que va a tener el modulo con respectiva logica
    public function __construct()
    {
        $this->opciones['permisox'] = 'consultac';
        $this->opciones['routxxxx'] = 'reportes';
        $this->getOpciones();
        $this->middleware($this->getMware());
    }



    public function general()
    {
        $this->opciones['tituloxx'] = "Reportes Solicitudes";
        $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view(
            $this->getBotones(['crear', [], 1, 'GUARDAR', 'btn btn-sm btn-success']),
            ['modeloxx' => '', 'accionxx' => ['general', 'formulario']]
        );
    }


    public function finalizados()
    {
        $this->opciones['tituloxx'] = "Reportes Solicitudes Finalizadas";
          $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view(
            $this->getBotones(['crear', [], 1, 'GUARDAR', 'btn btn-sm btn-success']),
            ['modeloxx' => '', 'accionxx' => ['finalizado', 'finalizado']]
        );
    }


    public function dias()
    {
        $this->opciones['tituloxx'] = "Reportes Solicitudes Diferencia de días";
           $this->opciones['pestania'] = $this->getPestanias($this->opciones);
        return $this->view(
            $this->getBotones(['crear', [], 1, 'GUARDAR', 'btn btn-sm btn-success']),
            ['modeloxx' => '', 'accionxx' => ['dias', 'dias']]
        );
    }

    /*

    SELECT NUM_SOLICITUD,
       FEC_SOLICITUD_TRAMITE,
       UPDATED_AT,
       ESTADODOC,
        TRUNC((CAST(UPDATED_AT AS DATE) - FEC_SOLICITUD_TRAMITE)) AS dias_de_diferencia
FROM CONCI_TRAMITEUSUARIOS WHERE UPDATED_AT IS NOT NULL and FEC_SOLICITUD_TRAMITE >= TO_DATE('02-10-2023', 'DD-MM-YYYY');


    */

/*

- Mostrar total de registros en reporte
- Simplificar campos para consulta (Basarse en autosearch)
- arreglar correo
- agregar boton de salida en validacion de usuario



*/



    public function generateExcelGeneral(Request $request)
    {

        // Obtener fechas desde el formulario
        $fechainicio = $request->input('start_date');
        $fechafin = $request->input('end_date');

        // Validar y formatear las fechas según sea necesario
        $formatofechain = date('Y-m-d', strtotime($fechainicio));
        $formatofechafin = date('Y-m-d', strtotime($fechafin));

        $query = Tramiteusuario::query();

        if ($formatofechain && $formatofechafin) {
            // Si ambas fechas están presentes, aplicar el rango
            $query->whereBetween('conci_tramiteusuarios.fec_solicitud_tramite', [$formatofechain, $formatofechafin]);
        }

        // Seleccionar los campos necesarios
        $oracleData = $query->select(
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
        $nuevafecha = Carbon::parse($nuevafecha)->format('d/m/Y H:i:s');
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
                'Content-Disposition' => 'attachment; filename="ReporteGeneral ' . $nuevafecha . '.xlsx"',
            ]
        );

        return $response;
    }


    public function generateExcelFinalizado(Request $request)
    {


        // Obtener fechas desde el formulario
        $fechainicio = $request->input('start_date');
        $fechafin = $request->input('end_date');
        $estado = [$request->input('estado')];

        // Validar y formatear las fechas según sea necesario
        $formatofechain = date('Y-m-d', strtotime($fechainicio));
        $formatofechafin = date('Y-m-d', strtotime($fechafin));

        $query = Tramiteusuario::query();

        if ($formatofechain && $formatofechafin) {
            // Si ambas fechas están presentes, aplicar el rango
            $query->whereBetween('conci_tramiteusuarios.fec_solicitud_tramite', [$formatofechain, $formatofechafin]);
        }
        
        if($estado[0]==null){
            $estado=[  'Desistimiento Automatico',
            'Finalizado Adjuntos',
            'Desistimiento Voluntario'];
        };

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
            ->whereIn('conci_tramiteusuarios.estadodoc',$estado)
            ->whereDate('fec_solicitud_tramite', '>=', '2023-10-02')->get();

        // Crear una instancia de PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $nuevafecha = now();
        $nuevafecha = Carbon::parse($nuevafecha)->format('d/m/Y H:i:s');
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
                'Content-Disposition' => 'attachment; filename="ReporteFinalizados ' . $nuevafecha . '.xlsx"',
            ]
        );

        return $response;
    }

    public function generateExcelDias(Request $request)
    {


        // Obtener fechas desde el formulario
        $fechainicio = $request->input('start_date');
        $fechafin = $request->input('end_date');

        // Validar y formatear las fechas según sea necesario
        $formatofechain = date('Y-m-d', strtotime($fechainicio));
        $formatofechafin = date('Y-m-d', strtotime($fechafin));

        $query = Tramiteusuario::query();

        if ($formatofechain && $formatofechafin) {
            // Si ambas fechas están presentes, aplicar el rango
            $query->whereBetween('conci_tramiteusuarios.fec_solicitud_tramite', [$formatofechain, $formatofechafin]);
        }

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
        $nuevafecha = Carbon::parse($nuevafecha)->format('d/m/Y H:i:s');
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
            $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray($columstyle);
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
                'Content-Disposition' => 'attachment; filename="ReporteDifD ' . $nuevafecha . '.xlsx"',
            ]
        );

        return $response;
    }
}

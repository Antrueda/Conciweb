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
                'conci_tramiteusuarios.asunto',
                'conci_tramiteusuarios.subasunto',
                'conci_tramiteusuarios.tiposolicitud',
                'conci_tramiteusuarios.cuantia',
                'conci_tramiteusuarios.detalle',
                DB::raw("conci_tramiteusuarios.primernombre || ' ' || conci_tramiteusuarios.segundonombre || ' ' || conci_tramiteusuarios.primerapellido|| ' ' || conci_tramiteusuarios.segundoapellido as nombre_completo"),
                'conci_tramiteusuarios.fec_solicitud_tramite',
                'conci_tramiteusuarios.updated_at',
                'conci_tramiteusuarios.estadodoc',
            ]
        )
                ->join('conci_asuntos', 'conci_tramiteusuarios.asunto', '=', 'conci_asuntos.id')
                ->join('conci_sub_asuntos', 'conci_tramiteusuarios.subasunto', '=', 'conci_sub_asuntos.id')
                ->where('conci_tramiteusuarios.id_tramite', 335)
                ->with(
                    'asuntos:id,nombre',
                    'subasuntos:id,nombre',
                    )
            ->whereDate('fec_solicitud_tramite', '>=', '2023-10-02')->get();


        // Crear una instancia de PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $nuevafecha = now();
        $nuevafecha = Carbon::parse($nuevafecha)->format('d/m/Y H:i:s');
        // Seleccionar la hoja activa
        a;
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
        $Conteo = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'black'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];
        // Aplicar estilos a los encabezados
        $sheet->getStyle('A2:G2')->applyFromArray($headerStyle);
        // Aplicar estilos al conteo
        $sheet->getStyle('A1:B1')->applyFromArray($Conteo);
        // Aplicar estilos a los encabezados
        // Agregar datos al informe
        $sheet->setCellValue('A1', 'Numero de Registros: ');
        $sheet->setCellValue('B1', $oracleData->count());
        $sheet->setCellValue('A2', 'Numero Solicitud');
        $sheet->setCellValue('B2', 'Nombre Completo');
        $sheet->setCellValue('C2', 'Asunto');
        $sheet->setCellValue('D2', 'Sub Asunto');
        $sheet->setCellValue('E2', 'Tipo de Solicitud');
        $sheet->setCellValue('F2', 'Fecha de Solicitud');
        $sheet->setCellValue('G2', 'Estado');

        $row = 3;
        
        //dd($oracleData);
        foreach ($oracleData as $data) {
            $tiposolicitud='';
            if($data->tiposolicitud==0){
                $tiposolicitud='DIRECTO POR EL SOLICITANTE';
            }else{
                $tiposolicitud='MEDIANTE APODERADO';
            }
            $sheet->setCellValue('A' . $row, $data->num_solicitud);
            $sheet->setCellValue('B' . $row, $data->nombre_completo);
            $sheet->setCellValue('C' . $row, $data->asuntos->nombre);
            $sheet->setCellValue('D' . $row, $data->subasuntos->nombre);
            $sheet->setCellValue('E' . $row, $tiposolicitud);
            $sheet->setCellValue('F' . $row, $data->fec_solicitud_tramite);
            $sheet->setCellValue('G' . $row, $data->estadodoc);
            $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray($columstyle);
            $row++;
        }
        // Congelar la primera fila (encabezados)
        $sheet->freezePane('A2');
        // Establecer anchos de columna
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(35);
        $sheet->getColumnDimension('C')->setWidth(35);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(25);
        $sheet->getColumnDimension('H')->setWidth(25);

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
                'conci_tramiteusuarios.asunto',
                'conci_tramiteusuarios.subasunto',
                'conci_tramiteusuarios.tiposolicitud',
                'conci_tramiteusuarios.cuantia',
                'conci_tramiteusuarios.detalle',
                DB::raw("conci_tramiteusuarios.primernombre || ' ' || conci_tramiteusuarios.segundonombre || ' ' || conci_tramiteusuarios.primerapellido|| ' ' || conci_tramiteusuarios.segundoapellido as nombre_completo"),
                'conci_tramiteusuarios.fec_solicitud_tramite',
                'conci_tramiteusuarios.updated_at',
                DB::raw("TO_CHAR(conci_tramiteusuarios.updated_at, 'YYYY-MM-DD HH24:MI:SS') as fecha_actualizacion_formateada"),
                'conci_tramiteusuarios.estadodoc',
            ]
        )
                ->join('conci_asuntos', 'conci_tramiteusuarios.asunto', '=', 'conci_asuntos.id')
                ->join('conci_sub_asuntos', 'conci_tramiteusuarios.subasunto', '=', 'conci_sub_asuntos.id')
                ->where('conci_tramiteusuarios.id_tramite', 335)
                ->whereIn('conci_tramiteusuarios.estadodoc',$estado)
                ->whereNotNull('conci_tramiteusuarios.updated_at')
                ->with(
                    'asuntos:id,nombre',
                    'subasuntos:id,nombre',
                    )
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
        $Conteo = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'black'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];
        // Aplicar estilos a los encabezados
        $sheet->getStyle('A2:I2')->applyFromArray($headerStyle);
        // Aplicar estilos al conteo
        $sheet->getStyle('A1:B1')->applyFromArray($Conteo);
        // Agregar datos al informe
        $sheet->setCellValue('A1', 'Numero de Registros: ');
        $sheet->setCellValue('B1', $oracleData->count());
        $sheet->setCellValue('A2', 'Numero Solicitud');
        $sheet->setCellValue('B2', 'Nombre Completo');
        $sheet->setCellValue('C2', 'Asunto');
        $sheet->setCellValue('D2', 'Sub Asunto');
        $sheet->setCellValue('E2', 'Tipo de Solicitud');
        $sheet->setCellValue('F2', 'Fecha de Solicitud');
        $sheet->setCellValue('G2', 'Fecha de Actualización');
        $sheet->setCellValue('H2', 'Estado');

        $row = 3;

        foreach ($oracleData as $data) {
            $tiposolicitud='';
            if($data->tiposolicitud==0){
                $tiposolicitud='DIRECTO POR EL SOLICITANTE';
            }else{
                $tiposolicitud='MEDIANTE APODERADO';
            }
            $sheet->setCellValue('A' . $row, $data->num_solicitud);
            $sheet->setCellValue('B' . $row, $data->nombre_completo);
            $sheet->setCellValue('C' . $row, $data->asuntos->nombre);
            $sheet->setCellValue('D' . $row, $data->subasuntos->nombre);
            $sheet->setCellValue('E' . $row, $tiposolicitud);
            $sheet->setCellValue('F' . $row, $data->fec_solicitud_tramite);
            $sheet->setCellValue('G' . $row, $data->fecha_actualizacion_formateada);
            $sheet->setCellValue('H' . $row, $data->estadodoc);
            $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray($columstyle);
            $row++;
        }
        $sheet->freezePane('A3');
        // Establecer anchos de columna
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(35);
        $sheet->getColumnDimension('C')->setWidth(35);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(25);
        $sheet->getColumnDimension('H')->setWidth(25);

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
        $estado = [$request->input('estado')];

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
                'conci_tramiteusuarios.asunto',
                'conci_tramiteusuarios.subasunto',
                'conci_tramiteusuarios.tiposolicitud',
                DB::raw("conci_tramiteusuarios.primernombre || ' ' || conci_tramiteusuarios.segundonombre || ' ' || conci_tramiteusuarios.primerapellido|| ' ' || conci_tramiteusuarios.segundoapellido as nombre_completo"),
                'conci_tramiteusuarios.fec_solicitud_tramite',
                'conci_tramiteusuarios.updated_at',
                DB::raw("TO_CHAR(conci_tramiteusuarios.updated_at, 'YYYY-MM-DD HH24:MI:SS') as fecha_actualizacion_formateada"),
                DB::raw('TRUNC((CAST(conci_tramiteusuarios.updated_at AS DATE) - fec_solicitud_tramite)) AS dias_de_diferencia'),
                'conci_tramiteusuarios.estadodoc',
            ]
        )
            ->join('conci_asuntos', 'conci_tramiteusuarios.asunto', '=', 'conci_asuntos.id')
            ->join('conci_sub_asuntos', 'conci_tramiteusuarios.subasunto', '=', 'conci_sub_asuntos.id')
            ->where('conci_tramiteusuarios.id_tramite', 335)
            ->whereIn('conci_tramiteusuarios.estadodoc',$estado)
            ->whereNotNull('conci_tramiteusuarios.updated_at')
            ->with(
                'asuntos:id,nombre',
                'subasuntos:id,nombre',
                )
            ->whereDate('conci_tramiteusuarios.fec_solicitud_tramite', '>=', '2023-10-02')->get();


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

        $Conteo = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'black'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];
        // Aplicar estilos a los encabezados
        $sheet->getStyle('A2:I2')->applyFromArray($headerStyle);
        // Aplicar estilos al conteo
        $sheet->getStyle('A1:B1')->applyFromArray($Conteo);
        // Agregar datos al informe
        $sheet->setCellValue('A1', 'Numero de Registros: ');
        $sheet->setCellValue('B1', $oracleData->count());
        $sheet->setCellValue('A2', 'Numero Solicitud');
        $sheet->setCellValue('B2', 'Nombre Completo');
        $sheet->setCellValue('C2', 'Asunto');
        $sheet->setCellValue('D2', 'Sub Asunto');
        $sheet->setCellValue('E2', 'Tipo de Solicitud');
        $sheet->setCellValue('F2', 'Fecha de Solicitud');
        $sheet->setCellValue('G2', 'Días');
        $sheet->setCellValue('H2', 'Fecha de Actualización');
        $sheet->setCellValue('I2', 'Estado');

        $row = 3;

        foreach ($oracleData as $data) {
            $tiposolicitud='';
            if($data->tiposolicitud==0){
                $tiposolicitud='DIRECTO POR EL SOLICITANTE';
            }else{
                $tiposolicitud='MEDIANTE APODERADO';
            }
            $sheet->setCellValue('A' . $row, $data->num_solicitud);
            $sheet->setCellValue('B' . $row, $data->nombre_completo);
            $sheet->setCellValue('C' . $row, $data->asuntos->nombre);
            $sheet->setCellValue('D' . $row, $data->subasuntos->nombre);
            $sheet->setCellValue('E' . $row, $tiposolicitud);
            $sheet->setCellValue('F' . $row, $data->fec_solicitud_tramite);
            $sheet->setCellValue('G' . $row, $data->dias_de_diferencia);
            $sheet->setCellValue('H' . $row, $data->fecha_actualizacion_formateada);
            $sheet->setCellValue('I' . $row, $data->estadodoc);
            $sheet->getStyle('A' . $row . ':I' . $row)->applyFromArray($columstyle);
            $row++;
        }

        //Fijar encabezados
        $sheet->freezePane('A3');
        // Establecer anchos de columna
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(35);
        $sheet->getColumnDimension('C')->setWidth(35);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(25);
        $sheet->getColumnDimension('H')->setWidth(25);
        $sheet->getColumnDimension('I')->setWidth(25);


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

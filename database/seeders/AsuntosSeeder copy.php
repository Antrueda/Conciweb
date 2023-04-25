<?php
namespace Database\Seeders;

use App\Models\ASubasunto;
use App\Models\Asunto;
use App\Models\Descripciona;
use Illuminate\Database\Seeder;
use App\Models\Parametro;
use App\Models\Salario;
use App\Models\SubAsunto;
use App\Models\subdescripcion;
use App\Models\User;

class AsuntosSeeder extends Seeder
{



    public function run()
    {
        Asunto::create(['id' => 1, 'sis_esta_id' => 1, 'nombre' => 'CIVIL, COMERCIAL Y POLICIVO']);
        Asunto::create(['id' => 2, 'sis_esta_id' => 1, 'nombre' => 'CONVIVENCIA ESCOLAR']);
        Asunto::create(['id' => 3, 'sis_esta_id' => 1, 'nombre' => 'FAMILIA']);
        Asunto::create(['id' => 4, 'sis_esta_id' => 1, 'nombre' => 'PENALES']);

        Salario::create(['id' => 1, 'numero' => 1160000, 'maximo'=>116000000, 'sis_esta_id' => 1,]);

        //CIVIL, COMERCIAL Y POLICIVO 1
        SubAsunto::create(['id' => 1, 'sis_esta_id' => 1, 'nombre' => 'ARRENDAMIENTOS / RESTITUCIÓN DE INMUEBLE ARRENDADO.']);
        SubAsunto::create(['id' => 2, 'sis_esta_id' => 1, 'nombre' => 'COMPRAVENTA Y/O PERMUTA DE BIEN INMUEBLE']);
        SubAsunto::create(['id' => 3, 'sis_esta_id' => 1, 'nombre' => 'COMPRAVENTA Y/O PERMUTA DE VEHICULO.']);
        SubAsunto::create(['id' => 4, 'sis_esta_id' => 1, 'nombre' => 'INCUMPLIMIENTOS DE OBLIGACIONES CONTRACTUALES']);
        SubAsunto::create(['id' => 5, 'sis_esta_id' => 1, 'nombre' => 'ACCIDENTE DE TRANSITO: DAÑO A VEHICULO']);
        SubAsunto::create(['id' => 6, 'sis_esta_id' => 1, 'nombre' => 'ACCIDENTE DE TRANSITO: PERSONA LESIONADA']);
        SubAsunto::create(['id' => 7, 'sis_esta_id' => 1, 'nombre' => 'ACCIDENTE DE TRANSITO:PERSONA FALLECIDA']);
        SubAsunto::create(['id' => 8, 'sis_esta_id' => 1, 'nombre' => 'DAÑO O HURTO DE AUTOMOVILES O MOTOS']);
        SubAsunto::create(['id' => 9, 'sis_esta_id' => 1, 'nombre' => 'SEGUROS.']);
        SubAsunto::create(['id' => 10, 'sis_esta_id' => 1, 'nombre' => 'RESPONSABILIDAD MEDICA']);
        SubAsunto::create(['id' => 11, 'sis_esta_id' => 1, 'nombre' => 'ADMINISTRACIÓN DE INMUEBLES.']);
        SubAsunto::create(['id' => 12, 'sis_esta_id' => 1, 'nombre' => 'RENDICIÓN DE CUENTAS DE BIENES DE COMUNIDAD']);
        SubAsunto::create(['id' => 13, 'sis_esta_id' => 1, 'nombre' => 'DEUDAS ENTRE PERSONAS NATURALES Y/O JURÍDICAS']);
        SubAsunto::create(['id' => 14, 'sis_esta_id' => 1, 'nombre' => 'PROPIEDAD HORIZONTAL']);
        SubAsunto::create(['id' => 15, 'sis_esta_id' => 1, 'nombre' => 'SERVIDUMBRES']);
        SubAsunto::create(['id' => 16, 'sis_esta_id' => 1, 'nombre' => 'POSESIÓN']);
        SubAsunto::create(['id' => 17, 'sis_esta_id' => 1, 'nombre' => 'PERTURBACION A LA POSESIÓN o A LA TENENCIA']);
        SubAsunto::create(['id' => 18, 'sis_esta_id' => 1, 'nombre' => 'RELACIONES DE VECINDAD / PROBLEMAS CON MASCOTAS']);

        //CONVIVENCIA ESCOLAR 2
        SubAsunto::create(['id' => 19, 'sis_esta_id' => 1, 'nombre' => 'ACOSO ESCOLAR (BULLYING).']);

        //FAMILIA 3
        SubAsunto::create(['id' => 20, 'sis_esta_id' => 1, 'nombre' => 'CONVIVENCIA EN UNIÓN LIBRE: DECLARACIÓN DE LA UNIÓN  MARITAL DE  HECHO']);
        SubAsunto::create(['id' => 21, 'sis_esta_id' => 1, 'nombre' => 'CONVIVENCIA EN UNIÓN LIBRE: DISOLUCIÓN Y LIQUIDACIÓN DE LA SOCIEDAD PATRIMONIAL']);
        SubAsunto::create(['id' => 22, 'sis_esta_id' => 1, 'nombre' => 'MATRIMONIO: SEPARACIÓN DE CUERPOS, DISOLUCIÓN Y LIQUIDACIÓN DE LA SOCIEDAD CONYUGAL EN MATRIMONIOS CIVIL Y RELIGIOSO']);
        SubAsunto::create(['id' => 23, 'sis_esta_id' => 1, 'nombre' => 'CUSTODIA, TENENCIA Y CUIDADO DE MENORES DE EDAD']);
        SubAsunto::create(['id' => 24, 'sis_esta_id' => 1, 'nombre' => 'CUOTA ALIMENTARIA PARA MENORES DE EDAD']);
        SubAsunto::create(['id' => 25, 'sis_esta_id' => 1, 'nombre' => 'CUOTA ALIMENTARIA PARA MAYORES DE EDAD QUE SE ENCUENTRAN ESTUDIANDO']);
        SubAsunto::create(['id' => 26, 'sis_esta_id' => 1, 'nombre' => 'MODIFICACION CUOTA ALIMENTARIA Y/O CUSTODIA']);
        SubAsunto::create(['id' => 27, 'sis_esta_id' => 1, 'nombre' => 'EXONERACIÓN DE CUOTA ALIMENTARIA']);
        SubAsunto::create(['id' => 28, 'sis_esta_id' => 1, 'nombre' => 'ACUERDO PARA SALIDA DEL PAÍS']);
        SubAsunto::create(['id' => 29, 'sis_esta_id' => 1, 'nombre' => 'ALIMENTOS PARA ADULTO MAYOR']);
        SubAsunto::create(['id' => 30, 'sis_esta_id' => 1, 'nombre' => 'MODIFICACION ALIMENTOS PARA ADULTO MAYOR']);
        SubAsunto::create(['id' => 31, 'sis_esta_id' => 1, 'nombre' => 'ALIMENTOS PARA CONYUGUE O COMPAÑERO PERMANENTE']);
        SubAsunto::create(['id' => 32, 'sis_esta_id' => 1, 'nombre' => 'SUCESIONES']);
        

        //PENALES 4

        SubAsunto::create(['id' => 33, 'sis_esta_id' => 1, 'nombre' => 'DELITOS QUERELLABLES. LESIONES PERSONALES CULPOSAS. DAÑO EN BIEN AJENO. INJURIA CALUMNIA, CUANDO NO TRASCIENDA Y ABUSO DE CONFIANZA.']);

        //CIVIL
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>1]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>2]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>3]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>5]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>6]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>7]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>8]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>9]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>10]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>11]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>12]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>13]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>14]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>15]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>16]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>17]);
        ASubasunto::create(['asunto_id' =>1 ,'subasu_id' =>18]);

        //ESCOLAR
        ASubasunto::create(['asunto_id' =>2 ,'subasu_id' =>19]);

        //FAMILIAR
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>20]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>21]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>22]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>23]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>24]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>25]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>26]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>27]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>28]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>29]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>30]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>31]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>32]);

        //PENAL
        ASubasunto::create(['asunto_id' =>4 ,'subasu_id' =>33]);


        //Descripcion
        // Descripciona::create(['id' => 1, 'sis_esta_id' => 1, 'nombre' => 'Formulario de solicitud de conciliación debidamente diligenciado y firmado.']);
        // Descripciona::create(['id' => 2, 'sis_esta_id' => 1, 'nombre' => 'Fotocopia cédula de ciudadanía del solicitante.']);
        // Descripciona::create(['id' => 3, 'sis_esta_id' => 1, 'nombre' => 'Otros documentos relacionados con la solicitud.']);
        // Descripciona::create(['id' => 4, 'sis_esta_id' => 1, 'nombre' => 'Contrato o documento donde se acordó la administración o donde conste la comunidad de un bien.']);
        // Descripciona::create(['id' => 5, 'sis_esta_id' => 1, 'nombre' => 'Copia de registro civil de nacimiento de los menores.']);
        // Descripciona::create(['id' => 6, 'sis_esta_id' => 1, 'nombre' => 'Contrato de arrendamiento (si fue de forma escrita).']);
        // Descripciona::create(['id' => 7, 'sis_esta_id' => 1, 'nombre' => 'Copia de certificado de tradición y libertad del inmueble menor 30 dias (si quien solicita no fue parte dentro del contrato).']);
        // Descripciona::create(['id' => 8, 'sis_esta_id' => 1, 'nombre' => 'Si se pretende citar a una persona jurídica aportar certificado de existencia y representacion legal de cámara de comercio (de contar con el).']);
        // Descripciona::create(['id' => 9, 'sis_esta_id' => 1, 'nombre' => 'Contrato de compraventa.']);
        // Descripciona::create(['id' => 10, 'sis_esta_id' => 1, 'nombre' => 'Documentos que complementen su solicitud.']);
        // Descripciona::create(['id' => 11, 'sis_esta_id' => 1, 'nombre' => 'Título valor / Soporte de la obligación.']);
        // Descripciona::create(['id' => 12, 'sis_esta_id' => 1, 'nombre' => 'Soportes del conflicto.']);
        // Descripciona::create(['id' => 13, 'sis_esta_id' => 1, 'nombre' => 'Fotocopia del contrato objeto de discusión.']);
        // Descripciona::create(['id' => 14, 'sis_esta_id' => 1, 'nombre' => 'Contrato de permuta.']);
        // Descripciona::create(['id' => 15, 'sis_esta_id' => 1, 'nombre' => 'Los documentos que acrediten la perturbación.']);
        // Descripciona::create(['id' => 16, 'sis_esta_id' => 1, 'nombre' => 'Fotocopia recibos de pago de impuestos, certificado de tradición y libertad, máximo con un mes de expedición, según corresponda.']);
        // Descripciona::create(['id' => 17, 'sis_esta_id' => 1, 'nombre' => 'Documentos que acrediten el conflicto que se ocasionen al interior de la propiedad horizontal, entre propietarios, poseedores o tenedores, entre ellos y los órganos de dirección o aquellos conflictos en materia.']);
        // Descripciona::create(['id' => 18, 'sis_esta_id' => 1, 'nombre' => 'Fotocopia del documento de representación legal de la PH expedido por la Alcaldía local que corresponda.']);
        // Descripciona::create(['id' => 19, 'sis_esta_id' => 1, 'nombre' => 'Documentos que demuestren los hechos que se someten a conciliación.']);
        // Descripciona::create(['id' => 20, 'sis_esta_id' => 1, 'nombre' => 'Contrato o documento donde se acordó la administración o donde conste la comunidad de un bien .']);
        // Descripciona::create(['id' => 21, 'sis_esta_id' => 1, 'nombre' => 'Documento que demuestren la ocurrencia de un hecho por el cual se pide una indemnización.']);
        // Descripciona::create(['id' => 22, 'sis_esta_id' => 1, 'nombre' => 'Si el daño es con ocasión de un accidente de tránsito aportar copia del informe de tránsito o croquis.']);
        // Descripciona::create(['id' => 23, 'sis_esta_id' => 1, 'nombre' => 'Fotocopia recibos de pago de impuestos, certificado de tradición y libertad, máximo con un mes de expedición..']);
        // Descripciona::create(['id' => 24, 'sis_esta_id' => 1, 'nombre' => 'Copia de registro civil del adulto mayor.']);
        // Descripciona::create(['id' => 25, 'sis_esta_id' => 1, 'nombre' => 'Fotocopia cédula de ciudadanía del adulto mayor.']);
        // Descripciona::create(['id' => 26, 'sis_esta_id' => 1, 'nombre' => 'Si han realizado anteriores conciliaciones sobre el tema, adjuntar copia del acta y/o sentencia judicial vigente.']);
        // Descripciona::create(['id' => 27, 'sis_esta_id' => 1, 'nombre' => 'En caso de matrimonio anterior: el documento mediante el cual llevó a cabo la disolución y/o en estado de liquidación de la sociedad conyugal, y registro civil de matrimonio anterior con las anotaciones pertinentes.']);
        // Descripciona::create(['id' => 28, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de nacimiento de los compañeros permanentes CON NOTAS MARGINALES y con fecha de Expedición inferior a TRES MESES.']);
        // Descripciona::create(['id' => 29, 'sis_esta_id' => 1, 'nombre' => 'Si alguno de los compañeros permanentes tiene hijos de unión marital de hecho o matrimonio anterior y administra bienes de hijo(as) menores de edad, el inventario solemne de bienes.']);
        // Descripciona::create(['id' => 30, 'sis_esta_id' => 1, 'nombre' => 'Copia de registro civil de nacimiento del hijo/a.']);
        // Descripciona::create(['id' => 31, 'sis_esta_id' => 1, 'nombre' => 'Documentos de procesos de alimentos y/o medidas de embargo, si los hay.']);
        // Descripciona::create(['id' => 32, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de matrimonio CON NOTAS MARGINALES y con fecha de Expedición inferior a TRES MESES.']);
        // Descripciona::create(['id' => 33, 'sis_esta_id' => 1, 'nombre' => 'SI TIENEN BIENES INMUEBLES: Fotocopia recibos de pago de impuestos, certificado de tradición y libertad, máximo con un mes de expedición.']);
        // Descripciona::create(['id' => 34, 'sis_esta_id' => 1, 'nombre' => 'SI TIENEN OBLIGACIONES CREDITICIAS: Certificado reciente del saldo y el estado actual de la obligación.']);
        // Descripciona::create(['id' => 35, 'sis_esta_id' => 1, 'nombre' => 'SI TIENEN VEHICULOS: Fotocopia de tarjeta de propiedad, certificado de tradición y libertad del vehículo menor a 30 días y recibo de pago de impuestos.']);
        // Descripciona::create(['id' => 36, 'sis_esta_id' => 1, 'nombre' => 'Poder especial para conciliar dirigido al centro de conciliación de la personería de Bogota D.C.']);

        Descripciona::create(['id' => 1, 'sis_esta_id' => 1, 'nombre' => 'Formulario de solicitud de conciliación completamente diligenciado y firmado']); //1
        Descripciona::create(['id' => 2, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de nacimiento de los dos compañeros permanentes CON NOTAS MARGINALES y con fecha de expedición inferior a TRES (3) MESES']); //2
        Descripciona::create(['id' => 3, 'sis_esta_id' => 1, 'nombre' => 'Cédulas de ciudadanía de los dos compañeros permanentes']); //3
        Descripciona::create(['id' => 4, 'sis_esta_id' => 1, 'nombre' => 'SI TIENE un matrimonio anterior, el documento mediante el cual se llevó a cabo la disolución y/o liquidación  de la sociedad conyugal.']); //4"
        Descripciona::create(['id' => 5, 'sis_esta_id' => 1, 'nombre' => 'Cédula (s) ciudadanía solicitante (s)']); //5
        Descripciona::create(['id' => 6, 'sis_esta_id' => 1, 'nombre' => 'SI TIENEN Declarada la unión Marital de Hecho Acta de conciliacion o escritura publica con la que se declaro la union marital de hecho']); //6
        Descripciona::create(['id' => 7, 'sis_esta_id' => 1, 'nombre' => 'SI TIENEN BIENES INMUEBLES: Impuesto predial del último año y Certificado de tradicion y libertad con fecha de expedicion inferior a TRES (3) MESES. ']); //7
        Descripciona::create(['id' => 8, 'sis_esta_id' => 1, 'nombre' => 'SI TIENEN VEHÍCULOS:  Impuesto vehicular del último año y Tarjeta de propiedad o certificado de libertad y tradicion.']); //8
        Descripciona::create(['id' => 9, 'sis_esta_id' => 1, 'nombre' => 'SI TIENEN ESTABLECIMIENTOS COMERCIALES: Certificado de existencia y representación legal, expedido por la Cámara de Comercio con fecha de expedicion inferior a TRES (3) MESES']); //9
        Descripciona::create(['id' => 10, 'sis_esta_id' => 1, 'nombre' => 'SI TIENEN OBLIGACIONES CREDITICIAS: Certificado reciente del saldo y el estado actual de la obligación. ']); //10
        Descripciona::create(['id' => 11, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de matrimonio CON NOTAS MARGINALES y con fecha de expedición inferior a TRES MESES']); //11
        Descripciona::create(['id' => 12, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de nacimiento de los dos esposos CON NOTAS MARGINALES y con fecha de expedición inferior a TRES (3) MESES']); //12
        Descripciona::create(['id' => 13, 'sis_esta_id' => 1, 'nombre' => 'Registro (s) civil (es) de nacimiento del menor (es) de edad (NO TARJETA DE IDENTIDAD)']); //13
        Descripciona::create(['id' => 14, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de nacimiento del solicitante']); //14
        Descripciona::create(['id' => 15, 'sis_esta_id' => 1, 'nombre' => 'Certificado de estudios vigente, emitido por la institucion donde se encuentra adelantando sus estudios']); //15
        Descripciona::create(['id' => 16, 'sis_esta_id' => 1, 'nombre' => 'Acta de conciliación o sentencia judicial mediante la cual se fijó la cuota de alimentos y/o la custodia']); //16
        Descripciona::create(['id' => 17, 'sis_esta_id' => 1, 'nombre' => 'Registro (s) civil (es) alimentado (os) (NO TARJETA DE IDENTIDAD)']); //17
        Descripciona::create(['id' => 18, 'sis_esta_id' => 1, 'nombre' => 'Cédula de ciudadanía del adulto mayor']); //18
        Descripciona::create(['id' => 19, 'sis_esta_id' => 1, 'nombre' => 'Registro (s) civil (es) de nacimiento que permitan establecer el parentesco entre el (los) solicitante (s) y el adulto mayor']); //19
        Descripciona::create(['id' => 20, 'sis_esta_id' => 1, 'nombre' => 'Acta de conciliación o sentencia judicial mediante la cual se fijó la cuota de alimentos']); //20
        Descripciona::create(['id' => 21, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de matrimonio CON NOTAS MARGINALES y con fecha de expedición inferior a TRES (3) MESES o Acta de conciliacion o escritura publica con la que se declaro la union marital de hecho']); //21
        Descripciona::create(['id' => 22, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de defuncion del causante']); //22
        Descripciona::create(['id' => 23, 'sis_esta_id' => 1, 'nombre' => 'Registro (s) civil (es) de nacimiento que permitan establecer el parentesco entre el (los) solicitante (s) y el causante']); //23
        Descripciona::create(['id' => 24, 'sis_esta_id' => 1, 'nombre' => 'Cédula (s) de ciudadanía solicitante (s) (Si actua como Representante Legal deberá aportar Certificado de existencia y representación legal, expedido por la Cámara de Comercio con fecha de expedicion inferior a TRES (3) MESES)']); //24
        Descripciona::create(['id' => 25, 'sis_esta_id' => 1, 'nombre' => 'Contrato de arrendamiento (En caso de Contrato de arrendamiento verbal, se deberá informar en los HECHOS del formulario de Solicitud)']); //25
        Descripciona::create(['id' => 26, 'sis_esta_id' => 1, 'nombre' => 'Certificado de tradicion y libertad con fecha de expedicion inferior a TRES (3) MESES (Solo en caso de que quien haga la solicitud sea el ARRENDADOR)']); //26
        Descripciona::create(['id' => 27, 'sis_esta_id' => 1, 'nombre' => 'Contrato de compraventa y/o permuta']); //27
        Descripciona::create(['id' => 28, 'sis_esta_id' => 1, 'nombre' => 'Certificado de tradicion y libertad del inmueble con fecha de expedicion inferior a TRES (3) MESES']); //28
        Descripciona::create(['id' => 29, 'sis_esta_id' => 1, 'nombre' => 'Tarjeta de propiedad o certificado de libertad y tradicion del vehiculo']); //29
        Descripciona::create(['id' => 30, 'sis_esta_id' => 1, 'nombre' => 'Contrato objeto de discusión']); //30
        Descripciona::create(['id' => 31, 'sis_esta_id' => 1, 'nombre' => 'Cotizaciones o factura de la reparación del vehiculo']); //31
        Descripciona::create(['id' => 32, 'sis_esta_id' => 1, 'nombre' => 'Informe policial o croquis del accidente de tránsito']); //32
        Descripciona::create(['id' => 33, 'sis_esta_id' => 1, 'nombre' => 'Informe pericial de clinica forense']); //33
        Descripciona::create(['id' => 34, 'sis_esta_id' => 1, 'nombre' => 'Registro (s) civil (es) de nacimiento que permitan establecer el parentesco entre el (los) solicitante (s) y la persona lesionada']); //34
        Descripciona::create(['id' => 35, 'sis_esta_id' => 1, 'nombre' => 'Informe pericial de necropsia medico legal']); //35
        Descripciona::create(['id' => 36, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de nacimiento de la persona fallecida']); //36
        Descripciona::create(['id' => 37, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de defuncion ']); //37
        Descripciona::create(['id' => 38, 'sis_esta_id' => 1, 'nombre' => 'Registro (s) civil (es) de nacimiento que permitan establecer el parentesco entre el (los) solicitante (s) y la persona fallecida']); //38
        Descripciona::create(['id' => 39, 'sis_esta_id' => 1, 'nombre' => 'Reclamación presentada a la aseguradora']); //39
        Descripciona::create(['id' => 40, 'sis_esta_id' => 1, 'nombre' => 'Poliza de seguro']); //40
        Descripciona::create(['id' => 41, 'sis_esta_id' => 1, 'nombre' => 'Epicrisis']); //41
        Descripciona::create(['id' => 42, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de nacimiento de la persona afectada']); //42
        Descripciona::create(['id' => 43, 'sis_esta_id' => 1, 'nombre' => 'Registro (s) civil (es) de nacimiento que permitan establecer el parentesco entre el (los) solicitante (s) y la persona afectada']); //43
        Descripciona::create(['id' => 44, 'sis_esta_id' => 1, 'nombre' => 'Contrato o documento donde se acordó la administración o donde conste la comunidad de un bien']); //44
        Descripciona::create(['id' => 45, 'sis_esta_id' => 1, 'nombre' => 'Certificado (s) de tradicion y libertad de inmueble (s) con fecha de expedicion inferior a TRES (3) MESES']); //45
        Descripciona::create(['id' => 46, 'sis_esta_id' => 1, 'nombre' => 'Certificado (s) de tradicion y libertad de inmueble (s) con fecha de expedicion inferior a TRES (3) MESES y/o Tarjeta de propiedad o certificado de libertad y tradicion del (os) vehiculo (s)']); //46
        Descripciona::create(['id' => 47, 'sis_esta_id' => 1, 'nombre' => 'Título valor y/o soporte de la obligación']); //47
        Descripciona::create(['id' => 48, 'sis_esta_id' => 1, 'nombre' => 'Cédula (s) de ciudadanía solicitante (s)']); //48
        Descripciona::create(['id' => 49, 'sis_esta_id' => 1, 'nombre' => 'Certificado de representación legal de la Propiedad Horizontal, expedido por la Alcaldía Municial o Distrital vigente']); //49
        Descripciona::create(['id' => 50, 'sis_esta_id' => 1, 'nombre' => 'Documentos que acrediten el conflicto que se ocasionen al interior de la propiedad horizontal, entre propietarios, poseedores o tenedores, entre ellos y los órganos de dirección o aquellos conflictos en materia contractual con el constructor, según corresponda']); //50
        Descripciona::create(['id' => 51, 'sis_esta_id' => 1, 'nombre' => ' Impuesto predial del último año']); //51
        Descripciona::create(['id' => 52, 'sis_esta_id' => 1, 'nombre' => 'Documentos que demuestren los hechos que se someten a conciliación']); //52
        Descripciona::create(['id' => 53, 'sis_esta_id' => 1, 'nombre' => 'Documentos relacionados con la solicitud ']); //53


        
        
        //.En caso de matrimonio anterior: el documento mediante el cual llevó a cabo la disolución y/o en estado de liquidación de la sociedad conyugal, y registro civil de matrimonio anterior con las anotaciones pertinentes.
        
       /*
        //ADMINISTRACION
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>1]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>1]);
        //Subdescripcion::create(['descri_id' =>3 ,'subasu_id' =>1]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>1]);

        //ARRENDAMIENTO
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>2]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>2]);
        Subdescripcion::create(['descri_id' =>6 ,'subasu_id' =>2]);
        Subdescripcion::create(['descri_id' =>7 ,'subasu_id' =>2]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>2]);

        //COMPRAVENTA
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>3]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>3]);
        Subdescripcion::create(['descri_id' =>9 ,'subasu_id' =>3]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>3]);

        //DEUDAS
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>4]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>4]);
        Subdescripcion::create(['descri_id' =>8,'subasu_id' =>4]);
        Subdescripcion::create(['descri_id' =>11 ,'subasu_id' =>4]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>4]);


        //ENTREGAS
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>5]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>5]);
        Subdescripcion::create(['descri_id' =>12 ,'subasu_id' =>5]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>5]);
        
        //INCUMPLIMIENTOS
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>6]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>6]);
        Subdescripcion::create(['descri_id' =>13 ,'subasu_id' =>6]);
        Subdescripcion::create(['descri_id' =>8 ,'subasu_id' =>6]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>6]);

        //PERMUTA
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>7]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>7]);
        Subdescripcion::create(['descri_id' =>14 ,'subasu_id' =>7]);
        Subdescripcion::create(['descri_id' =>8 ,'subasu_id' =>7]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>7]);

        
        //PERTURBACION
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>8]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>8]);
        Subdescripcion::create(['descri_id' =>15 ,'subasu_id' =>8]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>8]);

        //POSESION
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>9]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>9]);
        Subdescripcion::create(['descri_id' =>16 ,'subasu_id' =>9]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>9]);

        //PROPIEDAD
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>10]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>10]);
        Subdescripcion::create(['descri_id' =>17 ,'subasu_id' =>10]);
        Subdescripcion::create(['descri_id' =>18 ,'subasu_id' =>10]);


        //RELACIONES
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>11]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>11]);
        Subdescripcion::create(['descri_id' =>19,'subasu_id' =>11]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>11]);

        //RENDICION

        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>12]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>12]);
        Subdescripcion::create(['descri_id' =>20,'subasu_id' =>12]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>12]);
    

        //RESPONSABILIDAD

        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>13]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>13]);
        Subdescripcion::create(['descri_id' =>21,'subasu_id' =>13]);
        Subdescripcion::create(['descri_id' =>22,'subasu_id' =>13]);
        Subdescripcion::create(['descri_id' =>8,'subasu_id' =>13]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>13]);


        //SERVIDUMBRES
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>14]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>14]);
        Subdescripcion::create(['descri_id' =>23,'subasu_id' =>14]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>14]);
    

        //BULLYING
        Subdescripcion::create(['descri_id' =>25 ,'subasu_id' =>19]);
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>19]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>19]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>15]);

        //ACUERDO PARA SALIDA DE MENORES DEL PAÍS
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>16]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>16]);
        Subdescripcion::create(['descri_id' =>4 ,'subasu_id' =>16]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>16]);
        

        //ADULTO MAYOR
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>17]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>17]);
        Subdescripcion::create(['descri_id' =>23 ,'subasu_id' =>17]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>17]);


        //CONFLICTOS SOBRE CAPITULACIONES MATRIMONIALES
        Subdescripcion::create(['descri_id' =>25,'subasu_id' =>18]);
        Subdescripcion::create(['descri_id' =>22,'subasu_id' =>18]);
        Subdescripcion::create(['descri_id' =>23 ,'subasu_id' =>18]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>18]);

        //CONVIVENCIA
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>19]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>19]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>19]);

        //CUOTA
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>20]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>20]);
        Subdescripcion::create(['descri_id' =>5 ,'subasu_id' =>20]);
        Subdescripcion::create(['descri_id' =>26 ,'subasu_id' =>20]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>20]);

        //CUSTODIA, TENENCIA Y CUIDADO DE MENORES

        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>21]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>21]);
        Subdescripcion::create(['descri_id' =>5 ,'subasu_id' =>21]);
        Subdescripcion::create(['descri_id' =>26 ,'subasu_id' =>21]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>21]);

        //DECLARACIÓN DE LA UNIÓN  MARITAL DE HECHO

        Subdescripcion::create(['descri_id' =>27,'subasu_id' =>22]);
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>22]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>22]);
        Subdescripcion::create(['descri_id' =>28 ,'subasu_id' =>22]);
        Subdescripcion::create(['descri_id' =>29 ,'subasu_id' =>22]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>22]);


        //DISOLUCIÓN Y LIQUIDACIÓN DE LA SOCIEDAD PATRIMONIAL ORIGINADA EN LA UNIÓN MARITAL DE HECHO
        Subdescripcion::create(['descri_id' =>25,'subasu_id' =>23]);
        Subdescripcion::create(['descri_id' =>22,'subasu_id' =>23]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>23]);


        //EXONERACIÓN DE CUOTA ALIMENTARIA
        Subdescripcion::create(['descri_id' =>30,'subasu_id' =>24]);
        Subdescripcion::create(['descri_id' =>31,'subasu_id' =>24]);
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>24]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>24]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>24]);

        //SEPARACIÓN DE CUERPOS, DISOLUCIÓN Y LIQUIDACIÓN DE LA SOCIEDAD CONYUGAL EN MATRIMONIO CIVIL Y RELIGIOSO
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>25]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>25]);
        Subdescripcion::create(['descri_id' =>32,'subasu_id' =>25]);
        Subdescripcion::create(['descri_id' =>33,'subasu_id' =>25]);
        Subdescripcion::create(['descri_id' =>34,'subasu_id' =>25]);
        Subdescripcion::create(['descri_id' =>35,'subasu_id' =>25]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>25]);


        
   

        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>26]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>26]);
        //Subdescripcion::create(['descri_id' =>3 ,'subasu_id' =>26]);
       // Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>26]);
*/


    
    }
}







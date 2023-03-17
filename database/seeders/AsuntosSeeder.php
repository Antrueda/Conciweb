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
        SubAsunto::create(['id' => 1, 'sis_esta_id' => 1, 'nombre' => 'ADMINISTRACIÓN DE INMUEBLES.']);
        SubAsunto::create(['id' => 2, 'sis_esta_id' => 1, 'nombre' => 'ARRENDAMIENTOS / RESTITUCIÓN DE INMUEBLE ARRENDADO']);
        SubAsunto::create(['id' => 3, 'sis_esta_id' => 1, 'nombre' => 'COMPRAVENTA.']);
        SubAsunto::create(['id' => 4, 'sis_esta_id' => 1, 'nombre' => 'DEUDAS ENTRE PERSONAS NATURALES Y/O JURÍDICAS']);
        SubAsunto::create(['id' => 5, 'sis_esta_id' => 1, 'nombre' => 'ENTREGA MATERIAL DE LA COSA POR EL TRADENTE AL ADQUIRENTE']);
        SubAsunto::create(['id' => 6, 'sis_esta_id' => 1, 'nombre' => 'INCUMPLIMIENTOS DE OBLIGACIONES CONTRACTUALES']);
        SubAsunto::create(['id' => 7, 'sis_esta_id' => 1, 'nombre' => 'PERMUTA']);
        SubAsunto::create(['id' => 8, 'sis_esta_id' => 1, 'nombre' => 'PERTURBACION A LA POSESIÓN o A LA TENENCIA']);
        SubAsunto::create(['id' => 9, 'sis_esta_id' => 1, 'nombre' => 'POSESIÓN.']);
        SubAsunto::create(['id' => 10, 'sis_esta_id' => 1, 'nombre' => 'PROPIEDAD HORIZONTAL']);
        SubAsunto::create(['id' => 11, 'sis_esta_id' => 1, 'nombre' => 'RELACIONES DE VECINDAD / CONFLICTOS POR TENENCIA DE MASCOTAS.']);
        SubAsunto::create(['id' => 12, 'sis_esta_id' => 1, 'nombre' => 'RENDICIÓN DE CUENTAS DE BIENES DE COMUNIDAD']);
        SubAsunto::create(['id' => 13, 'sis_esta_id' => 1, 'nombre' => 'RESPONSABILIDAD CIVIL EXTRACONTRACTUAL']);
        SubAsunto::create(['id' => 14, 'sis_esta_id' => 1, 'nombre' => 'SERVIDUMBRES']);

     
        
        
        //CONVIVENCIA ESCOLAR 2
        SubAsunto::create(['id' => 15, 'sis_esta_id' => 1, 'nombre' => 'ACOSO ESCOLAR (BULLYING).']);

        //FAMILIA 3
        SubAsunto::create(['id' => 16, 'sis_esta_id' => 1, 'nombre' => 'ACUERDO PARA SALIDA DE MENORES DEL PAÍS']);
        SubAsunto::create(['id' => 17, 'sis_esta_id' => 1, 'nombre' => 'ALIMENTOS PARA ADULTO MAYOR']);
        SubAsunto::create(['id' => 18, 'sis_esta_id' => 1, 'nombre' => 'CONFLICTOS SOBRE CAPITULACIONES MATRIMONIALES']);
        SubAsunto::create(['id' => 19, 'sis_esta_id' => 1, 'nombre' => 'CONVIVENCIA']);
        SubAsunto::create(['id' => 20, 'sis_esta_id' => 1, 'nombre' => 'CUOTA ALIMENTARIA,  VESTUARIO, REGULACIÓN DE VISITAS, EDUCACIÓN Y SALUD']);
        SubAsunto::create(['id' => 21, 'sis_esta_id' => 1, 'nombre' => 'CUSTODIA, TENENCIA Y CUIDADO DE MENORES']);
        SubAsunto::create(['id' => 22, 'sis_esta_id' => 1, 'nombre' => 'DECLARACIÓN DE LA UNIÓN  MARITAL DE HECHO']);
        SubAsunto::create(['id' => 23, 'sis_esta_id' => 1, 'nombre' => 'DISOLUCIÓN Y LIQUIDACIÓN DE LA SOCIEDAD PATRIMONIAL ORIGINADA EN LA UNIÓN MARITAL DE HECHO']);
        SubAsunto::create(['id' => 24, 'sis_esta_id' => 1, 'nombre' => 'EXONERACIÓN DE CUOTA ALIMENTARIA']);
        SubAsunto::create(['id' => 25, 'sis_esta_id' => 1, 'nombre' => 'SEPARACIÓN DE CUERPOS, DISOLUCIÓN Y LIQUIDACIÓN DE LA SOCIEDAD CONYUGAL EN MATRIMONIO CIVIL Y RELIGIOSO']);

        //PENALES 4

        SubAsunto::create(['id' => 26, 'sis_esta_id' => 1, 'nombre' => 'DELITOS QUERELLABLES. LESIONES PERSONALES CULPOSAS. DAÑO EN BIEN AJENO. INJURIA CALUMNIA, CUANDO NO TRASCIENDA Y ABUSO DE CONFIANZA.']);


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

        ASubasunto::create(['asunto_id' =>2 ,'subasu_id' =>15]);

        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>16]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>17]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>18]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>19]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>20]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>21]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>22]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>23]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>24]);
        ASubasunto::create(['asunto_id' =>3 ,'subasu_id' =>25]);

        ASubasunto::create(['asunto_id' =>4 ,'subasu_id' =>26]);
        //Descripcion
        Descripciona::create(['id' => 1, 'sis_esta_id' => 1, 'nombre' => 'Formulario de solicitud de conciliación debidamente diligenciado y firmado.']);
        Descripciona::create(['id' => 2, 'sis_esta_id' => 1, 'nombre' => 'Fotocopia cédula de ciudadanía del solicitante.']);
        Descripciona::create(['id' => 3, 'sis_esta_id' => 1, 'nombre' => 'Otros documentos relacionados con la solicitud.']);
        Descripciona::create(['id' => 4, 'sis_esta_id' => 1, 'nombre' => 'Contrato o documento donde se acordó la administración o donde conste la comunidad de un bien.']);
        Descripciona::create(['id' => 5, 'sis_esta_id' => 1, 'nombre' => 'Copia de registro civil de nacimiento de los menores.']);
        Descripciona::create(['id' => 6, 'sis_esta_id' => 1, 'nombre' => 'Contrato de arrendamiento (si fue de forma escrita).']);
        Descripciona::create(['id' => 7, 'sis_esta_id' => 1, 'nombre' => 'Copia de certificado de tradición y libertad del inmueble menor 30 dias (si quien solicita no fue parte dentro del contrato).']);
        Descripciona::create(['id' => 8, 'sis_esta_id' => 1, 'nombre' => 'Si se pretende citar a una persona jurídica aportar certificado de existencia y representacion legal de cámara de comercio (de contar con el).']);
        Descripciona::create(['id' => 9, 'sis_esta_id' => 1, 'nombre' => 'Contrato de compraventa.']);
        Descripciona::create(['id' => 10, 'sis_esta_id' => 1, 'nombre' => 'Documentos relacionados.']);
        Descripciona::create(['id' => 11, 'sis_esta_id' => 1, 'nombre' => 'Título valor / Soporte de la obligación.']);
        Descripciona::create(['id' => 12, 'sis_esta_id' => 1, 'nombre' => 'Soportes del conflicto.']);
        Descripciona::create(['id' => 13, 'sis_esta_id' => 1, 'nombre' => 'Fotocopia del contrato objeto de discusión.']);
        Descripciona::create(['id' => 14, 'sis_esta_id' => 1, 'nombre' => 'Contrato de permuta.']);
        Descripciona::create(['id' => 15, 'sis_esta_id' => 1, 'nombre' => 'Los documentos que acrediten la perturbación.']);
        Descripciona::create(['id' => 16, 'sis_esta_id' => 1, 'nombre' => 'Fotocopia recibos de pago de impuestos, certificado de tradición y libertad, máximo con un mes de expedición, según corresponda.']);
        Descripciona::create(['id' => 17, 'sis_esta_id' => 1, 'nombre' => 'Documentos que acrediten el conflicto que se ocasionen al interior de la propiedad horizontal, entre propietarios, poseedores o tenedores, entre ellos y los órganos de dirección o aquellos conflictos en materia.']);
        Descripciona::create(['id' => 18, 'sis_esta_id' => 1, 'nombre' => 'Fotocopia del documento de representación legal de la PH expedido por la Alcaldía local que corresponda.']);
        Descripciona::create(['id' => 19, 'sis_esta_id' => 1, 'nombre' => 'Documentos que demuestren los hechos que se someten a conciliación.']);
        Descripciona::create(['id' => 20, 'sis_esta_id' => 1, 'nombre' => 'Contrato o documento donde se acordó la administración o donde conste la comunidad de un bien .']);
        Descripciona::create(['id' => 21, 'sis_esta_id' => 1, 'nombre' => 'Documento que demuestren la ocurrencia de un hecho por el cual se pide una indemnización.']);
        Descripciona::create(['id' => 22, 'sis_esta_id' => 1, 'nombre' => 'Si el daño es con ocasión de un accidente de tránsito aportar copia del informe de tránsito o croquis.']);
        Descripciona::create(['id' => 23, 'sis_esta_id' => 1, 'nombre' => 'Fotocopia recibos de pago de impuestos, certificado de tradición y libertad, máximo con un mes de expedición..']);
        Descripciona::create(['id' => 24, 'sis_esta_id' => 1, 'nombre' => 'Copia de registro civil del adulto mayor.']);
        Descripciona::create(['id' => 25, 'sis_esta_id' => 1, 'nombre' => 'Fotocopia cédula de ciudadanía del adulto mayor.']);
        Descripciona::create(['id' => 26, 'sis_esta_id' => 1, 'nombre' => 'Si han realizado anteriores conciliaciones sobre el tema, adjuntar copia del acta y/o sentencia judicial vigente.']);
        Descripciona::create(['id' => 27, 'sis_esta_id' => 1, 'nombre' => 'En caso de matrimonio anterior: el documento mediante el cual llevó a cabo la disolución y/o en estado de liquidación de la sociedad conyugal, y registro civil de matrimonio anterior con las anotaciones pertinentes.']);
        Descripciona::create(['id' => 28, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de nacimiento de los compañeros permanentes CON NOTAS MARGINALES y con fecha de Expedición inferior a TRES MESES.']);
        Descripciona::create(['id' => 29, 'sis_esta_id' => 1, 'nombre' => 'Si alguno de los compañeros permanentes tiene hijos de unión marital de hecho o matrimonio anterior y administra bienes de hijo(as) menores de edad, el inventario solemne de bienes.']);
        Descripciona::create(['id' => 30, 'sis_esta_id' => 1, 'nombre' => 'Copia de registro civil de nacimiento del hijo/a.']);
        Descripciona::create(['id' => 31, 'sis_esta_id' => 1, 'nombre' => 'Documentos de procesos de alimentos y/o medidas de embargo, si los hay.']);
        Descripciona::create(['id' => 32, 'sis_esta_id' => 1, 'nombre' => 'Registro civil de matrimonio CON NOTAS MARGINALES y con fecha de Expedición inferior a TRES MESES.']);
        Descripciona::create(['id' => 33, 'sis_esta_id' => 1, 'nombre' => 'SI TIENEN BIENES INMUEBLES: Fotocopia recibos de pago de impuestos, certificado de tradición y libertad, máximo con un mes de expedición.']);
        Descripciona::create(['id' => 34, 'sis_esta_id' => 1, 'nombre' => 'SI TIENEN OBLIGACIONES CREDITICIAS: Certificado reciente del saldo y el estado actual de la obligación.']);
        Descripciona::create(['id' => 35, 'sis_esta_id' => 1, 'nombre' => 'SI TIENEN VEHICULOS: Fotocopia de tarjeta de propiedad, certificado de tradición y libertad del vehículo menor a 30 días y recibo de pago de impuestos.']);
        
        
        //.En caso de matrimonio anterior: el documento mediante el cual llevó a cabo la disolución y/o en estado de liquidación de la sociedad conyugal, y registro civil de matrimonio anterior con las anotaciones pertinentes.
        
        //ADMINISTRACION
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>1]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>1]);
        Subdescripcion::create(['descri_id' =>3 ,'subasu_id' =>1]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>1]);

        //ARRENDAMIENTO
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>2]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>2]);
        Subdescripcion::create(['descri_id' =>6 ,'subasu_id' =>2]);
        Subdescripcion::create(['descri_id' =>7 ,'subasu_id' =>2]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>2]);

        //COMPRAVENTA
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>3]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>3]);
        Subdescripcion::create(['descri_id' =>9 ,'subasu_id' =>3]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>3]);

        //DEUDAS
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>4]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>4]);
        Subdescripcion::create(['descri_id' =>8,'subasu_id' =>4]);
        Subdescripcion::create(['descri_id' =>11 ,'subasu_id' =>4]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>4]);


        //ENTREGAS
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>5]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>5]);
        Subdescripcion::create(['descri_id' =>12 ,'subasu_id' =>5]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>5]);
        
        //INCUMPLIMIENTOS
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>6]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>6]);
        Subdescripcion::create(['descri_id' =>13 ,'subasu_id' =>6]);
        Subdescripcion::create(['descri_id' =>8 ,'subasu_id' =>6]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>6]);

        //PERMUTA
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>7]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>7]);
        Subdescripcion::create(['descri_id' =>14 ,'subasu_id' =>7]);
        Subdescripcion::create(['descri_id' =>8 ,'subasu_id' =>7]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>7]);

        
        //PERTURBACION
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>8]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>8]);
        Subdescripcion::create(['descri_id' =>15 ,'subasu_id' =>8]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>8]);

        //POSESION
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>9]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>9]);
        Subdescripcion::create(['descri_id' =>16 ,'subasu_id' =>9]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>9]);

        //PROPIEDAD
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>10]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>10]);
        Subdescripcion::create(['descri_id' =>17 ,'subasu_id' =>10]);
        Subdescripcion::create(['descri_id' =>18 ,'subasu_id' =>10]);


        //RELACIONES
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>11]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>11]);
        Subdescripcion::create(['descri_id' =>19,'subasu_id' =>11]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>11]);

        //RENDICION

        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>12]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>12]);
        Subdescripcion::create(['descri_id' =>20,'subasu_id' =>12]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>12]);
    

        //RESPONSABILIDAD

        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>13]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>13]);
        Subdescripcion::create(['descri_id' =>21,'subasu_id' =>13]);
        Subdescripcion::create(['descri_id' =>22,'subasu_id' =>13]);
        Subdescripcion::create(['descri_id' =>8,'subasu_id' =>13]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>13]);


        //SERVIDUMBRES
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>14]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>14]);
        Subdescripcion::create(['descri_id' =>23,'subasu_id' =>14]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>14]);
    

        //BULLYING
        Subdescripcion::create(['descri_id' =>25 ,'subasu_id' =>15]);
        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>15]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>15]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>15]);

        //ACUERDO PARA SALIDA DE MENORES DEL PAÍS
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>16]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>16]);
        Subdescripcion::create(['descri_id' =>4 ,'subasu_id' =>16]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>16]);
        

        //ADULTO MAYOR
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>17]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>17]);
        Subdescripcion::create(['descri_id' =>23 ,'subasu_id' =>17]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>17]);


        //CONFLICTOS SOBRE CAPITULACIONES MATRIMONIALES
        Subdescripcion::create(['descri_id' =>25,'subasu_id' =>18]);
        Subdescripcion::create(['descri_id' =>22,'subasu_id' =>18]);
        Subdescripcion::create(['descri_id' =>23 ,'subasu_id' =>18]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>18]);

        //CONVIVENCIA
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>19]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>19]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>19]);

        //CUOTA
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>20]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>20]);
        Subdescripcion::create(['descri_id' =>5 ,'subasu_id' =>20]);
        Subdescripcion::create(['descri_id' =>26 ,'subasu_id' =>20]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>20]);

        //CUSTODIA, TENENCIA Y CUIDADO DE MENORES

        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>21]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>21]);
        Subdescripcion::create(['descri_id' =>5 ,'subasu_id' =>21]);
        Subdescripcion::create(['descri_id' =>26 ,'subasu_id' =>21]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>21]);

        //DECLARACIÓN DE LA UNIÓN  MARITAL DE HECHO

        Subdescripcion::create(['descri_id' =>27,'subasu_id' =>22]);
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>22]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>22]);
        Subdescripcion::create(['descri_id' =>28 ,'subasu_id' =>22]);
        Subdescripcion::create(['descri_id' =>29 ,'subasu_id' =>22]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>22]);


        //DISOLUCIÓN Y LIQUIDACIÓN DE LA SOCIEDAD PATRIMONIAL ORIGINADA EN LA UNIÓN MARITAL DE HECHO
        Subdescripcion::create(['descri_id' =>25,'subasu_id' =>23]);
        Subdescripcion::create(['descri_id' =>22,'subasu_id' =>23]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>23]);


        //EXONERACIÓN DE CUOTA ALIMENTARIA
        Subdescripcion::create(['descri_id' =>30,'subasu_id' =>24]);
        Subdescripcion::create(['descri_id' =>31,'subasu_id' =>24]);
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>24]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>24]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>24]);

        //SEPARACIÓN DE CUERPOS, DISOLUCIÓN Y LIQUIDACIÓN DE LA SOCIEDAD CONYUGAL EN MATRIMONIO CIVIL Y RELIGIOSO
        Subdescripcion::create(['descri_id' =>1,'subasu_id' =>25]);
        Subdescripcion::create(['descri_id' =>2,'subasu_id' =>25]);
        Subdescripcion::create(['descri_id' =>32,'subasu_id' =>25]);
        Subdescripcion::create(['descri_id' =>33,'subasu_id' =>25]);
        Subdescripcion::create(['descri_id' =>34,'subasu_id' =>25]);
        Subdescripcion::create(['descri_id' =>35,'subasu_id' =>25]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>25]);


        
   

        Subdescripcion::create(['descri_id' =>1 ,'subasu_id' =>26]);
        Subdescripcion::create(['descri_id' =>2 ,'subasu_id' =>26]);
        Subdescripcion::create(['descri_id' =>3 ,'subasu_id' =>26]);
        Subdescripcion::create(['descri_id' =>10 ,'subasu_id' =>26]);



    
    }
}







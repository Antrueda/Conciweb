<?php
namespace Database\Seeders;

use App\Models\Estadoform;
use App\Models\Texto;
use Illuminate\Database\Seeder;

class TextosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Texto::create(['texto'=>'<p>Si su solicitud de conciliación está relacionada con asuntos de naturaleza laboral, contratos de prestación de servicios (honorarios), simulación, insolvencia económica o están involucradas entidades del estado, 
         se invita a abstenerse de adelantar su solicitud, ya que, el Centro de Conciliación y MASC de Personería de Bogotá DC NO TIENE COMPETENCIA para conocerla y su solicitud será Inadmitida. </p>
         <p>Lo mismo ocurrirá sí su pretensión es superior a 100 SMMLV salvo que se trate de solicitudes de conciliación promovida por persona natural deudor hipotecario y por persona natural que reclame ser damnificado o victima el pago de indemnización de seguros de responsabilidad civil.</p>
         <p>Lo anterior de conformidad con resolución 1166 de 2018 artículo 3º</p>.
         '
         ,'tipotexto_id'=>20,'user_crea_id'=>1,'user_edita_id'=>1, 'sis_esta_id'=>1]);
         Texto::create(['texto'=>'<p>Señor(a) usuario(a), autoriza a la Personería de Bogotá, D.C., ubicada en la Carrera 7 No. 21 - 24, conmutador: 2820450 o línea de atención 143, para la recolección, consulta, almacenamiento, 
         uso, traslado o eliminación de sus datos personales, con el fin de: adelantar las gestiones, actuaciones e intervenciones que permitan el restablecimiento y goce de sus derechos, invitar a eventos de participación 
         ciudadana u organizados por la entidad, elaborar acciones constitucionales, caracterizar usuarios con fines estadísticos, enviar información a entidades autorizadas, evaluar la calidad del servicio, 
         contactar al titular en los casos que se considere necesario, así como defender el interés y patrimonio público dentro del marco de las funciones legales de la Entidad.</p>
         <p>Recuerde que no es obligatorio para la prestación del servicio, suministrar los datos personales de carácter sensible o de niños, niñas y adolescentes que le sean solicitados. Se exime el tratamiento de datos de 
         niños, niñas y adolescentes, salvo aquellos datos que sean de naturaleza pública.</p>
         <p>Como titular de la información tiene derecho a conocer, actualizar, rectificar sus datos personales y en los casos en que sea procedente, suprimir o revocar la autorización otorgada para su tratamiento, 
         solicitar prueba de la autorización otorgada al responsable del tratamiento y ser informado sobre el uso que le han dado a los mismos, presentar quejas ante la SIC por infracción a la ley y acceder en forma gratuita 
         a sus datos personales.</p>
         <p>Para profundizar sobre sus derechos como titular y otros aspectos relevantes, consulte nuestra Política de Tratamiento de Datos Personales en el siguiente link: <a href="https://www.personeriabogota.gov.co/mecanismos-de-contacto-con-el-sujeto-obligado/proteccion-de-datos-personales/politica-de-proteccion-de-datos-personales" Target="_blank">Politica de tratamiento</a></p>
         
         '
         ,'tipotexto_id'=>19,'user_crea_id'=>1,'user_edita_id'=>1, 'sis_esta_id'=>1]);
         Texto::create(['texto'=>'
         Certifico que he recibido y comprendido que la información que reciba el (a) psicólogo (a) es de carácter confidencial y que la podrá revelar si durante el proceso de valoración y/o atención brindado por el Instituto a través de su Modelo Pedagógico, el (a) psicólogo (a) detecta de manera clara que hay un evidente daño para mí o para terceros (Artículo 2, numeral 5 de la Ley 1090 de septiembre 6 de 2006). Se me indicó que esta valoración busca establecer las áreas de ajuste que es necesario abordar a través de la atención integral que los profesionales del equipo psicosocial brindarán, con el fin de promover el goce efectivo de mis derechos; abordaje que será el adecuado a la situación de vulnerabilidad presentada y se inscribe dentro del marco de la psicología basada en la evidencia. El tiempo previsto para la atención psicosocial corresponde al necesario para el cumplimiento de los objetivos propuestos en el Plan de Atención Individual y Familiar. También se me indicó que puedo revocar el consentimiento o dar por terminada en cualquier momento la relación entre el psicólogo y yo, cuando lo considere pertinente, sin que ello implique ningún tipo de consecuencia para mí; caso en el cual el (a) profesional tratante evaluará si esta interrupción puede ser perjudicial para mí mismo o para terceros, reservándose el derecho de notificar a quien considere responsable. La inasistencia a los encuentros acordados sin que medie un aviso efectivo de mi parte, será interpretada como un abandono del proceso, lo cual será comunicado a la instancia que corresponda.'
         ,'tipotexto_id'=>18,'user_crea_id'=>1,'user_edita_id'=>1, 'sis_esta_id'=>1]);

         Texto::create(['texto'=>'
         Se informa a la ciudadanía que en el periodo comprendido entre el 1 de abril de 2023 al 9 de abril de 2023, no estará habilitada la aplicación CONCIWEB enfocada en <b>Solicitudes de Conciliación Virtual.</b> Este servicio se reactivará a partir del 10 de abril de 2023.
         Agradecemos su comprensión..'
         ,'tipotexto_id'=>22,'user_crea_id'=>1,'user_edita_id'=>1, 'sis_esta_id'=>1]);

        

         Estadoform::create(['estado'=>'ACTIVO'
         ,'texto_id'=>4, 'sis_esta_id'=>1]);

}
}

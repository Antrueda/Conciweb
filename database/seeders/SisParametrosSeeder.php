<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parametro;
use App\Models\User;

class SisParametrosSeeder extends Seeder
{

    public function getR($dataxxxx)
    {
        Parametro::create(['sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => "{$dataxxxx['nombrexx']}"]);
    }
    /**
     * Run the database seeds.
     * Listado de parámetros del sistema
     * @return void
     */
    public function run()
    {
         $registro = ['sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => ''];
         Parametro::create(['id' => 1, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'CIVIL, COMERCIAL Y POLICIVO']);
         Parametro::create(['id' => 2, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'CONVIVENCIA ESCOLAR']);
         Parametro::create(['id' => 3, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'FAMILIA']);
         Parametro::create(['id' => 4, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'PENALES']);
         Parametro::create(['id' => 5, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'CÉDULA DE CIUDADANÍA']);
         Parametro::create(['id' => 6, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'NIT']);
         Parametro::create(['id' => 7, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'T.I.']);
         Parametro::create(['id' => 8, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'CÉDULA DE EXTRANJERÍA.']);
         Parametro::create(['id' => 9, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'NO APLICA (N.A)']);
         Parametro::create(['id' => 10, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'NÚMERO DE IDENTIFICACIÓN DE EXTRANJERO']);
         Parametro::create(['id' => 11, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'NÚMERO IDENTIFICACIÓN SOCIEDAD EXTRANJERA']);
         Parametro::create(['id' => 12, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'PASAPORTE']);
         Parametro::create(['id' => 13, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'PERMISO ESPECIAL DE PERMANENCIA']);
         Parametro::create(['id' => 14, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'PERMISO POR PROTECCIÓN TEMPORAL']);
         Parametro::create(['id' => 15, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'REGISTRO CIVIL']);
         Parametro::create(['id' => 16, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'TARJETA DE IDENTIDAD']);
         Parametro::create(['id' => 18, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'MENSAJE']);
         Parametro::create(['id' => 19, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'TRATAMIENTO DE DATOS']);
         Parametro::create(['id' => 20, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'BIENVENIDA']);



        //  Parametro::create(['id' => 21, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'CONTRATO O DOCUMENTO DONDE SE ACORDÓ LA ADMINISTRACIÓN O DONDE CONSTE LA COMUNIDAD DE UN BIEN']);
        //  Parametro::create(['id' => 22, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'FORMULARIO DE SOLICITUD DE CONCILIACIÓN DEBIDAMENTE DILIGENCIADO Y FIRMADO']);
        //  Parametro::create(['id' => 23, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'FOTOCOPIA CÉDULA DE CIUDADANÍA DEL SOLICITANTE']);
        //  Parametro::create(['id' => 24, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'LOS DOCUMENTOS RELACIONADOS CON LA SOLICITUD']);
        //  Parametro::create(['id' => 25, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'COPIA DE REGISTRO CIVIL DE NACIMIENTO DE LOS MENORES']);


        //  //Arrendamiento
        //  Parametro::create(['id' => 25, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'COPIA DE REGISTRO CIVIL DE NACIMIENTO DE LOS MENORES']);
        //  Parametro::create(['id' => 25, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'COPIA DE REGISTRO CIVIL DE NACIMIENTO DE LOS MENORES']);
        //  Parametro::create(['id' => 25, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'COPIA DE REGISTRO CIVIL DE NACIMIENTO DE LOS MENORES']);
        //  Parametro::create(['id' => 25, 'sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => 'COPIA DE REGISTRO CIVIL DE NACIMIENTO DE LOS MENORES']);
        


        // //ESCOLAR
        // $this->getR(['nombrexx' => 'LOS DOCUMENTOS RELACIONADOS CON LA SOLICITUD']); //26

        // //FAMILIA
        // $this->getR(['nombrexx' => 'COPIA DE REGISTRO CIVIL DE NACIMIENTO DE LOS MENORES']); //27
        

        

    
    }
}


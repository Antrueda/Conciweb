<?php
namespace Database\Seeders;

use App\Models\Sistema\SisDepartam;
use Illuminate\Database\Seeder;

class SisDepartamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        SisDepartam::create(["id" =>1 ,"s_departamento" => "N/A"]);
        SisDepartam::create(["id" =>91, "s_departamento" => "AMAZONAS"]);
        SisDepartam::create(["id" =>5 ,"s_departamento" => "ANTIOQUIA"]);
        SisDepartam::create(["id" =>81 , "s_departamento" => "ARAUCA"]);
        SisDepartam::create(["id" =>8 ,"s_departamento" => "ATLÁNTICO"]);
        SisDepartam::create(["id" =>11 , "s_departamento" => "BOGOTÁ DC"]);
        SisDepartam::create(["id" =>13 , "s_departamento" => "BOLÍVAR"]);
        SisDepartam::create(["id" =>15 , "s_departamento" => "BOYACÁ"]);
        SisDepartam::create(["id" =>17 , "s_departamento" => "CALDAS"]);
        SisDepartam::create(["id" =>18 , "s_departamento" => "CAQUETÁ"]);
        SisDepartam::create(["id" =>85 , "s_departamento" => "CASANARE"]);
        SisDepartam::create(["id" =>19 , "s_departamento" => "CAUCA"]);
        SisDepartam::create(["id" =>20 , "s_departamento" => "CESAR"]);
        SisDepartam::create(["id" =>27 , "s_departamento" => "CHOCÓ"]);
        SisDepartam::create(["id" =>23 , "s_departamento" => "CÓRDOBA"]);
        SisDepartam::create(["id" =>25 , "s_departamento" => "CUNDINAMARCA"]);
        SisDepartam::create(["id" =>94 , "s_departamento" => "GUAINÍA"]);
        SisDepartam::create(["id" =>95 , "s_departamento" => "GUAVIARE"]);
        SisDepartam::create(["id" =>41 , "s_departamento" => "HUILA"]);
        SisDepartam::create(["id" =>44 , "s_departamento" => "LA GUAJIRA"]);
        SisDepartam::create(["id" =>47 , "s_departamento" => "MAGDALENA"]);
        SisDepartam::create(["id" =>50 , "s_departamento" => "META"]);
        SisDepartam::create(["id" =>52 , "s_departamento" => "NARIÑO"]);
        SisDepartam::create(["id" =>54 , "s_departamento" => "NORTE DE SANTANDER"]);
        SisDepartam::create(["id" =>86 , "s_departamento" => "PUTUMAYO"]);
        SisDepartam::create(["id" =>63 , "s_departamento" => "QUINDÍO"]);
        SisDepartam::create(["id" =>66 , "s_departamento" => "RISARALDA"]);
        SisDepartam::create(["id" =>88 , "s_departamento" => "SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA"]);
        SisDepartam::create(["id" =>68 , "s_departamento" => "SANTANDER"]);
        SisDepartam::create(["id" =>70 , "s_departamento" => "SUCRE"]);
        SisDepartam::create(["id" =>73 , "s_departamento" => "TOLIMA"]);
        SisDepartam::create(["id" =>76, "s_departamento" => "VALLE DEL CAUCA"]);
        SisDepartam::create(["id" =>97 , "s_departamento" => "VAUPÉS"]);
        SisDepartam::create(["id" =>99 , "s_departamento" => "VICHADA"]);
        //SisDepartam::create([ "s_departamento" => "DEPARTAMENTO NO IDENTIFICADO EN EL NUEVO DESARROLLO"]);
    }
}

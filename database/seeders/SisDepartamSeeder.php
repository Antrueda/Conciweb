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

        SisDepartam::create(["s_departamento" => "N/A"]);
        SisDepartam::create([ "s_departamento" => "AMAZONAS"]);
        SisDepartam::create(["s_departamento" => "ANTIOQUIA"]);
        SisDepartam::create([ "s_departamento" => "ARAUCA"]);
        SisDepartam::create(["s_departamento" => "ATLÁNTICO"]);
        SisDepartam::create([ "s_departamento" => "BOGOTÁ DC"]);
        SisDepartam::create([ "s_departamento" => "BOLÍVAR"]);
        SisDepartam::create([ "s_departamento" => "BOYACÁ"]);
        SisDepartam::create([ "s_departamento" => "CALDAS"]);
        SisDepartam::create([ "s_departamento" => "CAQUETÁ"]);
        SisDepartam::create([ "s_departamento" => "CASANARE"]);
        SisDepartam::create([ "s_departamento" => "CAUCA"]);
        SisDepartam::create([ "s_departamento" => "CESAR"]);
        SisDepartam::create([ "s_departamento" => "CHOCÓ"]);
        SisDepartam::create([ "s_departamento" => "CÓRDOBA"]);
        SisDepartam::create([ "s_departamento" => "CUNDINAMARCA"]);
        SisDepartam::create([ "s_departamento" => "GUAINÍA"]);
        SisDepartam::create([ "s_departamento" => "GUAVIARE"]);
        SisDepartam::create([ "s_departamento" => "HUILA"]);
        SisDepartam::create([ "s_departamento" => "LA GUAJIRA"]);
        SisDepartam::create([ "s_departamento" => "MAGDALENA"]);
        SisDepartam::create([ "s_departamento" => "META"]);
        SisDepartam::create([ "s_departamento" => "NARIÑO"]);
        SisDepartam::create([ "s_departamento" => "NORTE DE SANTANDER"]);
        SisDepartam::create([ "s_departamento" => "PUTUMAYO"]);
        SisDepartam::create([ "s_departamento" => "QUINDÍO"]);
        SisDepartam::create([ "s_departamento" => "RISARALDA"]);
        SisDepartam::create([ "s_departamento" => "SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA"]);
        SisDepartam::create([ "s_departamento" => "SANTANDER"]);
        SisDepartam::create([ "s_departamento" => "SUCRE"]);
        SisDepartam::create([ "s_departamento" => "TOLIMA"]);
        SisDepartam::create([ "s_departamento" => "VALLE DEL CAUCA"]);
        SisDepartam::create([ "s_departamento" => "VAUPÉS"]);
        SisDepartam::create([ "s_departamento" => "VICHADA"]);
        SisDepartam::create([ "s_departamento" => "DEPARTAMENTO NO IDENTIFICADO EN EL NUEVO DESARROLLO"]);
    }
}

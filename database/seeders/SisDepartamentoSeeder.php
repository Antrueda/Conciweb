<?php
namespace Database\Seeders;

use App\Models\Sistema\SisDepartamento;
use Illuminate\Database\Seeder;

class SisDepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        SisDepartamento::create(["sis_pai_id" => 1,"s_departamento" => "NO APLICA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "AMAZONAS"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "ANTIOQUIA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "ARAUCA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "ATLÁNTICO"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "BOGOTÁ DC"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "BOLÍVAR"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "BOYACÁ"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "CALDAS"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "CAQUETÁ"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "CASANARE"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "CAUCA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "CESAR"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "CHOCÓ"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "CÓRDOBA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "CUNDINAMARCA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "GUAINÍA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "GUAVIARE"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "HUILA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "LA GUAJIRA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "MAGDALENA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "META"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "NARIÑO"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "NORTE DE SANTANDER"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "PUTUMAYO"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "QUINDÍO"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "RISARALDA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "SAN ANDRÉS Y ROVIDENCIA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "SANTANDER"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "SUCRE"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "TOLIMA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "VALLE DEL CAUCA"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "VAUPÉS"]);
        SisDepartamento::create(["sis_pai_id" => 2, "s_departamento" => "VICHADA"]);
    }
}

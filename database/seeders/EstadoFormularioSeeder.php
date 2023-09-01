<?php
namespace Database\Seeders;

use App\Models\ConciTiempo;
use App\Models\Estadoform;
use app\Models\Salario;
use App\Models\Sistema\SisEsta;
use Illuminate\Database\Seeder;

class EstadoFormularioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estadoform::create(["estado"=>"ACTIVO",'sis_esta_id'=>1,'texto_id'=>4]);
    }
}
	

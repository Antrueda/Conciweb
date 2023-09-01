<?php
namespace Database\Seeders;

use App\Models\ConciTiempo;
use app\Models\Salario;
use App\Models\Sistema\SisEsta;
use Illuminate\Database\Seeder;

class SalarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Salario::create(["tiempo"=>1160000,'maximo'=>116000000]);
    }
}
	

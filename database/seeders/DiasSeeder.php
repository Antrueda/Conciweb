<?php
namespace Database\Seeders;

use App\Models\ConciTiempo;
use App\Models\Sistema\SisEsta;
use Illuminate\Database\Seeder;

class DiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConciTiempo::create(["tiempo"=>5]);
    }
}

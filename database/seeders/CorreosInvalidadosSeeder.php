<?php
namespace Database\Seeders;

use App\Models\ConciCorreoinv;
use App\Models\ConciTiempo;
use App\Models\Sistema\SisEsta;
use Illuminate\Database\Seeder;

class CorreosInvalidadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConciCorreoinv::create(["email"=>"test@test.com"]);
        ConciCorreoinv::create(["email"=>"noconozco@gmail.com"]);
        ConciCorreoinv::create(["email"=>"123456@gmail.com"]);
        ConciCorreoinv::create(["email"=>"notiene@gmail.com"]);
    }
}


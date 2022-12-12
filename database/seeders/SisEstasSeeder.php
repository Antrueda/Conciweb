<?php
namespace Database\Seeders;

use App\Models\Sistema\SisEsta;
use Illuminate\Database\Seeder;

class SisEstasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SisEsta::create(["s_estado"=>"ACTIVO","i_estado"=>1,"user_crea_id"=>1,"user_edita_id"=>1]);
        SisEsta::create(["s_estado"=>"INACTIVO","i_estado"=>1,"user_crea_id"=>1,"user_edita_id"=>1]);
    }
}

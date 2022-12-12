<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsuariosSeeder extends Seeder
{
    public function getR($dataxxxx)
    {

        // if ($dataxxxx['document'] == '17496705') {
        //     $dataxxxx['password_change_at'] = date("Y-m-d", strtotime(date('Y-m-d') . "+ 1 month"));
        // }
        // User::create($dataxxxx);
        // ->assignRole(strtoupper($dataxxxx['rolxxxxx']));
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        User::create(["name" => "JORGE ANTONIO RUEDA", "email" => "jaruedag@personeriabogota.gov.co", "password" => "1090412429", "sis_esta_id" => 1, "user_crea_id" => 1, "user_edita_id" => 1, ]);
        

        $user=User::find(1);
        $user->assignRole('super-administrador');
    
    }
}

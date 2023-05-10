<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SisEstasSeeder::class);
        $this->call(SisParametrosSeeder::class);
        $this->call(SisDepartamSeeder::class);
        $this->call(SisMunicipioSeeder::class);
      //  $this->call(SisDepartamSisMunicipioSeeder::class);
        
        $this->call(TemasTableSeeder::class);
        $this->call(RolesYPermisosSeeder::class);
        //$this->call(UsuariosSeeder::class);
        $this->call(SisLocalidadsSeeder::class);
        $this->call(TextosSeeder::class);
        $this->call(AsuntosSeeder::class);
    }
}
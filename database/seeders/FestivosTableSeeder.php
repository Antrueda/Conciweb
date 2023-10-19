<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FestivosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('festivos')->insert([
            ['fecha' => '2023-01-01', 'nombre' => 'Año Nuevo'],
            ['fecha' => '2023-01-06', 'nombre' => 'Día de los Reyes Magos'],
            ['fecha' => '2023-03-19', 'nombre' => 'Día de San José'],
            ['fecha' => '2023-04-06', 'nombre' => 'Jueves Santo'],
            ['fecha' => '2023-04-07', 'nombre' => 'Viernes Santo'],
            ['fecha' => '2023-05-01', 'nombre' => 'Día del Trabajo'],
            ['fecha' => '2023-05-13', 'nombre' => 'Ascensión del Señor'],
            ['fecha' => '2023-05-23', 'nombre' => 'Corpus Christi'],
            ['fecha' => '2023-06-02', 'nombre' => 'Sagrado Corazón de Jesús'],
            ['fecha' => '2023-06-29', 'nombre' => 'San Pedro y San Pablo'],
            ['fecha' => '2023-07-20', 'nombre' => 'Independencia de Colombia'],
            ['fecha' => '2023-08-07', 'nombre' => 'Batalla de Boyacá'],
            ['fecha' => '2023-10-12', 'nombre' => 'Día de la Raza'],
            ['fecha' => '2023-11-01', 'nombre' => 'Todos los Santos'],
            ['fecha' => '2023-11-11', 'nombre' => 'Independencia de Cartagena'],
            ['fecha' => '2023-12-08', 'nombre' => 'Día de la Inmaculada Concepción'],
            ['fecha' => '2023-12-25', 'nombre' => 'Navidad'],
            // Puedes agregar más festivos aquí
        ]);
    }
}

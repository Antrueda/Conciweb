<?php

namespace Database\Seeders\Sistema;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Sistema\DCondicionProteccion;

class DCondicionProteccionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Discapacidad
        DCondicionProteccion::create(['id_condicion' => 4, 'nombre' => 'Discapacidad 1']);
        DCondicionProteccion::create(['id_condicion' => 4, 'nombre' => 'Discapacidad 2']);
        DCondicionProteccion::create(['id_condicion' => 4, 'nombre' => 'Discapacidad 3']);

        //Conflicto armado
        DCondicionProteccion::create(['id_condicion' => 5, 'nombre' => 'Desplazamiento Forzado']);
        DCondicionProteccion::create(['id_condicion' => 5, 'nombre' => 'Amenaza']);
        DCondicionProteccion::create(['id_condicion' => 5, 'nombre' => 'Delitos contra la libertad y la integridad sexual']);
        DCondicionProteccion::create(['id_condicion' => 5, 'nombre' => 'Vinculación de NNA a actividades relacionadas con grupos armados']);
        DCondicionProteccion::create(['id_condicion' => 5, 'nombre' => 'Otros']);

        //Grupo etnico
        DCondicionProteccion::create(['id_condicion' => 6, 'nombre' => 'Grupo Etnico 1']);
        DCondicionProteccion::create(['id_condicion' => 6, 'nombre' => 'Grupo Etnico 2']);
        DCondicionProteccion::create(['id_condicion' => 6, 'nombre' => 'Grupo Etnico 3']);

        //Enfermedad catastrofica
        DCondicionProteccion::create(['id_condicion' => 9, 'nombre' => 'Enfermedad 1']);
        DCondicionProteccion::create(['id_condicion' => 9, 'nombre' => 'Enfermedad 2']);
        DCondicionProteccion::create(['id_condicion' => 9, 'nombre' => 'Enfermedad 3']);
    }
}

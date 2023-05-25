<?php

namespace Database\Seeders\Sistema;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Sistema\RelacionCondicionProteccion;

class RelacionCondicionProteccionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Niños
        RelacionCondicionProteccion::create([
            'condicion' => 1,
            'relacion' => 2,
        ]);

        RelacionCondicionProteccion::create([
            'condicion' => 1,
            'relacion' => 4,
        ]);

        RelacionCondicionProteccion::create([
            'condicion' => 1,
            'relacion' => 5,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 1,
            'relacion' => 6,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 1,
            'relacion' => 9,
        ]);


        //Mujer Emabarazada
        RelacionCondicionProteccion::create([
            'condicion' => 2,
            'relacion' => 1,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 2,
            'relacion' => 3,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 2,
            'relacion' => 4,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 2,
            'relacion' => 5,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 2,
            'relacion' => 6,
        ]);
        // RelacionCondicionProteccion::create([
        //     'condicion' => 2,
        //     'relacion' => 7,
        // ]);
        // RelacionCondicionProteccion::create([
        //     'condicion' => 2,
        //     'relacion' => 8,
        // ]);
        RelacionCondicionProteccion::create([
            'condicion' => 2,
            'relacion' => 9,
        ]);
        
        //Adulto Mayor
        RelacionCondicionProteccion::create([
            'condicion' => 3,
            'relacion' => 2,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 3,
            'relacion' => 4,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 3,
            'relacion' => 5,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 3,
            'relacion' => 6,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 3,
            'relacion' => 9,
        ]);


        //Discapacidad
        RelacionCondicionProteccion::create([
            'condicion' => 4,
            'relacion' => 1,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 4,
            'relacion' => 2,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 4,
            'relacion' => 3,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 4,
            'relacion' => 5,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 4,
            'relacion' => 6,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 4,
            'relacion' => 7,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 4,
            'relacion' => 8,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 4,
            'relacion' => 9,
        ]);


        //Victima Conflicto
        RelacionCondicionProteccion::create([
            'condicion' => 5,
            'relacion' => 1,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 5,
            'relacion' => 2,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 5,
            'relacion' => 3,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 5,
            'relacion' => 4,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 5,
            'relacion' => 6,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 5,
            'relacion' => 7,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 5,
            'relacion' => 8,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 5,
            'relacion' => 9,
        ]);
        
        //Grupo etnico
        RelacionCondicionProteccion::create([
            'condicion' => 6,
            'relacion' => 1,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 6,
            'relacion' => 2,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 6,
            'relacion' => 3,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 6,
            'relacion' => 4,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 6,
            'relacion' => 5,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 6,
            'relacion' => 7,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 6,
            'relacion' => 8,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 6,
            'relacion' => 9,
        ]);

        //Poca instruccion

        RelacionCondicionProteccion::create([
            'condicion' => 7,
            'relacion' => 2,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 7,
            'relacion' => 4,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 7,
            'relacion' => 5,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 7,
            'relacion' => 6,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 7,
            'relacion' => 8,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 7,
            'relacion' => 9,
        ]);


        //Persona desposeida
        RelacionCondicionProteccion::create([
            'condicion' => 8,
            'relacion' => 2,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 8,
            'relacion' => 4,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 8,
            'relacion' => 5,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 8,
            'relacion' => 6,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 8,
            'relacion' => 7,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 8,
            'relacion' => 9,
        ]);

        //Enfermedad catastrofica
        RelacionCondicionProteccion::create([
            'condicion' => 9,
            'relacion' => 1,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 9,
            'relacion' => 2,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 9,
            'relacion' => 3,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 9,
            'relacion' => 4,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 9,
            'relacion' => 5,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 9,
            'relacion' => 6,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 9,
            'relacion' => 7,
        ]);
        RelacionCondicionProteccion::create([
            'condicion' => 9,
            'relacion' => 8,
        ]);
    }
}

<?php

namespace Database\Seeders\Sistema;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Sistema\CondicionProteccion;

class CondicionProteccionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CondicionProteccion::create([ //1
            'nombre' => 'Niños y Niñas',
            'descripcion' => 'Menores de 14 años',
            'imagen_on' => 'storage/Sistema/iconos-condiciones/img1a.png',
            'imagen_off' => 'storage/Sistema/iconos-condiciones/img1b.png',
            'habilitado' => true,
        ]);
        CondicionProteccion::create([ //2
            'nombre' => 'Mujer Embarazada',
            //'descripcion' => 'descripcion 2',
            'imagen_on' => 'storage/Sistema/iconos-condiciones/img2a.png',
            'imagen_off' => 'storage/Sistema/iconos-condiciones/img2b.png',
            'habilitado' => true,
        ]);
        CondicionProteccion::create([ //3
            'nombre' => 'Adulto Mayor',
            'descripcion' => 'Mayores de 60 años (ley 1251 de 2008)',
            'imagen_on' => 'storage/Sistema/iconos-condiciones/img3a.png',
            'imagen_off' => 'storage/Sistema/iconos-condiciones/img3b.png',
            'habilitado' => true,
        ]);
        CondicionProteccion::create([ //4
            'nombre' => 'Persona en Condición de Discapacidad',
            //'descripcion' => 'descripcion 4',
            'imagen_on' => 'storage/Sistema/iconos-condiciones/img4a.png',
            'imagen_off' => 'storage/Sistema/iconos-condiciones/img4b.png',
            'tabla_desplegable' => 'Tipo Discapacidad',
            // 'nombre_tabla_desplegable' => 'Tipo Discapacidad',
            'habilitado' => true,
        ]);
        CondicionProteccion::create([ //5
            'nombre' => 'Victima Conflicto Armado',
            //'descripcion' => 'descripcion 5',
            'imagen_on' => 'storage/Sistema/iconos-condiciones/img5a.png',
            'imagen_off' => 'storage/Sistema/iconos-condiciones/img5b.png',
            'tabla_desplegable' => 'Conflicto Armado Interno',
            // 'nombre_tabla_desplegable' => 'Conflicto Armado Interno',
            'habilitado' => true,
        ]);
        CondicionProteccion::create([ //6
            'nombre' => 'Grupo Étnico',
            //'descripcion' => 'descripcion 5',
            'imagen_on' => 'storage/Sistema/iconos-condiciones/img6a.png',
            'imagen_off' => 'storage/Sistema/iconos-condiciones/img6b.png',
            'tabla_desplegable' => 'Grupo Etnico',
            // 'nombre_tabla_desplegable' => 'Grupo Etnico',
            'habilitado' => true,
        ]);

        CondicionProteccion::create([ //7
            'nombre' => 'Persona con Poca Instrucción',
            'descripcion' => 'Ciudadano que no sabe leer o escribir.',
            'imagen_on' => 'storage/Sistema/iconos-condiciones/img7a.png',
            'imagen_off' => 'storage/Sistema/iconos-condiciones/img7b.png',
            'habilitado' => true,
        ]);

        CondicionProteccion::create([ //8
            'nombre' => 'Persona Desposeída',
            'descripcion' => 'Ciudadano que aparentemente no está en capacidad de asumir los costos de la gestión de su actuación ante las autoridades.',
            'imagen_on' => 'storage/Sistema/iconos-condiciones/img8a.png',
            'imagen_off' => 'storage/Sistema/iconos-condiciones/img8b.png',
            'habilitado' => true,
        ]);

        CondicionProteccion::create([ //9
            'nombre' => 'Enfermedad Castastrófica',
            //'descripcion' => 'descripcion 5',
            'imagen_on' => 'storage/Sistema/iconos-condiciones/img9a.png',
            'imagen_off' => 'storage/Sistema/iconos-condiciones/img9b.png',
            'tabla_desplegable' => 'Enfermedad',
            // 'nombre_tabla_desplegable' => 'Enfermedad',
            'habilitado' => true,
        ]);

        CondicionProteccion::create([ //10
            'nombre' => 'Ninguno',
            'descripcion' => 'Cuando el afectado no cumple con ninguna de las características anteriores.',
            'imagen_on' => 'storage/Sistema/iconos-condiciones/img10a.png',
            'imagen_off' => 'storage/Sistema/iconos-condiciones/img10b.png',
            'habilitado' => true,
        ]);
    }
}

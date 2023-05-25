<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

use App\Models\Sistema\GrupoAfectado;


class GrupoAfectadoSeeder extends Seeder
{



    public function run()
    {
      

        //CIVIL, COMERCIAL Y POLICIVO 1
        GrupoAfectado::create(['id' => 1 , 'sis_esta_id' => 1, 'nombre' => 'ACTIVISTAS DE GRUPOS POLITICOS Y DIRECTIVOS Y MIEMBROS DE ORGANIZACIONES POLÍTICAS']);
        GrupoAfectado::create(['id' => 2 , 'sis_esta_id' => 1, 'nombre' => 'DIRIGENTES O ACTIVISTAS SINDICALES']);
        GrupoAfectado::create(['id' => 3 , 'sis_esta_id' => 1, 'nombre' => 'DOCENTES']);
        GrupoAfectado::create(['id' => 4 , 'sis_esta_id' => 1, 'nombre' => 'ESTUDIANTES']);
        GrupoAfectado::create(['id' => 5 , 'sis_esta_id' => 1, 'nombre' => 'HABITANTE DE CALLE']);
        GrupoAfectado::create(['id' => 6 , 'sis_esta_id' => 1, 'nombre' => 'LÍDERES COMUNALES Y SOCIALES']);
        GrupoAfectado::create(['id' => 7 , 'sis_esta_id' => 1, 'nombre' => 'MANIFESTANTES']);
        GrupoAfectado::create(['id' => 8 , 'sis_esta_id' => 1, 'nombre' => 'MIEMBROS DE LA FUERZA PÚBLICA']);
        GrupoAfectado::create(['id' => 9 , 'sis_esta_id' => 1, 'nombre' => 'PERSONA RETORNADA']);
        GrupoAfectado::create(['id' => 10 , 'sis_esta_id' => 1, 'nombre' => 'MUJER']);
        GrupoAfectado::create(['id' => 11 , 'sis_esta_id' => 1, 'nombre' => 'NINGUNO']);
        GrupoAfectado::create(['id' => 12 , 'sis_esta_id' => 1, 'nombre' => 'NIÑOS,NIÑAS Y ADOLESCENTES']);
        GrupoAfectado::create(['id' => 13 , 'sis_esta_id' => 1, 'nombre' => 'OBJETORES DE CONCIENCIA']);
        GrupoAfectado::create(['id' => 14 , 'sis_esta_id' => 1, 'nombre' => 'ONG/ ORGANISMOS INTERNACIONALES']);
        GrupoAfectado::create(['id' => 15 , 'sis_esta_id' => 1, 'nombre' => 'PERIODISTAS Y COMUNICADORES SOCIALES.']);
        GrupoAfectado::create(['id' => 16 , 'sis_esta_id' => 1, 'nombre' => 'PERSONA CON DISCAPACIDAD']);
        GrupoAfectado::create(['id' => 17 , 'sis_esta_id' => 1, 'nombre' => 'PERSONAL DE LA SALUD']);
        GrupoAfectado::create(['id' => 18 , 'sis_esta_id' => 1, 'nombre' => 'PERSONAS EN SERVICIO MILITAR']);
        GrupoAfectado::create(['id' => 19 , 'sis_esta_id' => 1, 'nombre' => 'PERSONAS LGBTI']);
        GrupoAfectado::create(['id' => 20 , 'sis_esta_id' => 1, 'nombre' => 'PERSONAS MAYORES']);
        GrupoAfectado::create(['id' => 21 , 'sis_esta_id' => 1, 'nombre' => 'PERSONAS QUE REALIZAN ACTIVIDADES SEXUALES PAGAS']);
        GrupoAfectado::create(['id' => 22 , 'sis_esta_id' => 1, 'nombre' => 'POBLACIÓN COLOMBIANA RETORNADA']);
        GrupoAfectado::create(['id' => 23 , 'sis_esta_id' => 1, 'nombre' => 'POBLACIÓN MIGRANTE Y REFUGIADA']);
        GrupoAfectado::create(['id' => 24 , 'sis_esta_id' => 1, 'nombre' => 'POBLACIÓN PRIVADA DE LA LIBERTAD']);
        GrupoAfectado::create(['id' => 25 , 'sis_esta_id' => 1, 'nombre' => 'REINSERTADOS Y DESMOVILIZADOS']);
        GrupoAfectado::create(['id' => 26 , 'sis_esta_id' => 1, 'nombre' => 'REPRESENTANTES DE ORGANIZACIONES DEFENSORAS DE DERECHOS HUMANOS/LIDERES (AS) SOCIALES']);
        GrupoAfectado::create(['id' => 27 , 'sis_esta_id' => 1, 'nombre' => 'REPRESENTANTES DE ORGANIZACIONES GREMIALES']);
        GrupoAfectado::create(['id' => 28 , 'sis_esta_id' => 1, 'nombre' => 'REPRESENTANTES O MIEMBROS DE GRUPOS ÉTNICOS']);
        GrupoAfectado::create(['id' => 29 , 'sis_esta_id' => 1, 'nombre' => 'SERVIDORES PÚBLICOS']);
        GrupoAfectado::create(['id' => 30 , 'sis_esta_id' => 1, 'nombre' => 'VÍCTIMAS DEL CONFLICTO ARMADO INTERNO']);
        GrupoAfectado::create(['id' => 31 , 'sis_esta_id' => 1, 'nombre' => 'COLECTIVOS ANIMALISTAS']);
        GrupoAfectado::create(['id' => 32 , 'sis_esta_id' => 1, 'nombre' => 'AMBIENTALISTAS']);
        GrupoAfectado::create(['id' => 33 , 'sis_esta_id' => 1, 'nombre' => 'RESIDENTES DE BARRIOS']);
        GrupoAfectado::create(['id' => 34 , 'sis_esta_id' => 1, 'nombre' => 'AGRUPACIÓN DE EMPRESARIOS']);
        GrupoAfectado::create(['id' => 35 , 'sis_esta_id' => 1, 'nombre' => 'AGRICULTURES URBANOS']);
        GrupoAfectado::create(['id' => 36 , 'sis_esta_id' => 1, 'nombre' => 'CONTRATISTAS DE ENTIDADES']);
        GrupoAfectado::create(['id' => 37 , 'sis_esta_id' => 1, 'nombre' => 'GREMIO TRANSPORTE']);
        GrupoAfectado::create(['id' => 38 , 'sis_esta_id' => 1, 'nombre' => 'VENDEDORES INFORMALES']);
        GrupoAfectado::create(['id' => 39 , 'sis_esta_id' => 1, 'nombre' => 'RECICLADORES']);
        GrupoAfectado::create(['id' => 40 , 'sis_esta_id' => 1, 'nombre' => 'CONTRAVENTORES TRÁNSITO']);
        
        // Subdescripcion::create(['descri_id' => 1, 'subasu_id' => 19]);
        // Subdescripcion::create(['descri_id' => 5, 'subasu_id' => 19]);
        
        //Subdescripcion::create(['descri_id' => 53, 'subasu_id' => 33]);
    }
}

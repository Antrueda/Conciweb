<?php
namespace Database\Seeders;
use App\Models\Tema;
use Illuminate\Database\Seeder;


class TemasTableSeeder extends Seeder
{
    public function getR($dataxxxx)
    {
        $camposmagicos = ['user_crea_id' => 1, 'user_edita_id' => 1];
        $tema = Tema::create(['sis_esta_id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'nombre' => strtoupper($dataxxxx['nombrexx'])]);
        $parametr = [];
        foreach ($dataxxxx['parametr'] as  $value) {
            $parametr[$value] = $camposmagicos;
        }
        $tema->parametros()->sync($parametr);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $camposmagicos = ['user_crea_id' => 1, 'user_edita_id' => 1];


        $tema = Tema::create(['id' => 1, 'user_crea_id' => 1, 'user_edita_id' => 1, 'sis_esta_id' => 1, 'nombre' => 'Asuntos']);
        $tema->parametros()->sync([
            1 => $camposmagicos,
            2 => $camposmagicos,
            3 => $camposmagicos,
            4 => $camposmagicos,
        ]);
        $tema = Tema::create(['id' => 3, 'user_crea_id' => 1, 'user_edita_id' => 1, 'sis_esta_id' => 1, 'nombre' => 'Tipo de Documento']);
        $tema->parametros()->sync([
            5 => $camposmagicos,
            6 => $camposmagicos,
            //7 => $camposmagicos,
            8 => $camposmagicos,
            9 => $camposmagicos,
            10 => $camposmagicos,
            11 => $camposmagicos,
            12 => $camposmagicos,
            13 => $camposmagicos,
            14 => $camposmagicos,
            15 => $camposmagicos,
            16 => $camposmagicos,
            ]);

        $tema = Tema::create(['id' => 2, 'user_crea_id' => 1, 'user_edita_id' => 1, 'sis_esta_id' => 1, 'nombre' => 'Tipo de textos']);
        $tema->parametros()->sync([
            18 => $camposmagicos,
            19 => $camposmagicos,
            20 => $camposmagicos,
        ]);


        // $tema = Tema::create(['id' => 4, 'user_crea_id' => 1, 'user_edita_id' => 1, 'sis_esta_id' => 1, 'nombre' => 'Sub Asunto']);
        // $tema->parametros()->sync([
        //     21 => $camposmagicos,
        //     22 => $camposmagicos,
        //     23 => $camposmagicos,
        //     24 => $camposmagicos,
        //     25 => $camposmagicos,
        //     26 => $camposmagicos,
        //     27 => $camposmagicos,
        //     28 => $camposmagicos,
        //     29 => $camposmagicos,
        //     30 => $camposmagicos,
        //     31 => $camposmagicos,
        //     32 => $camposmagicos,
        //     33 => $camposmagicos,
        //     34 => $camposmagicos,

        // ]);

    
     
  

      


        // $this->getR([
        //     'nombrexx' => '',
        //     'parametr' => []
        // ]); //359
    }
}

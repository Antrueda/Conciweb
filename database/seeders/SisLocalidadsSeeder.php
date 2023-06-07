<?php
namespace Database\Seeders;

use App\Models\Sistema\SisLocalidad;
use Illuminate\Database\Seeder;

class SisLocalidadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SisLocalidad::create([
            'id'=>1,
            's_localidad' => '01 - USAQUÉN',
        ]);
        SisLocalidad::create([
            'id'=>2,
            's_localidad' => '02 - CHAPINERO',
        ]);
        SisLocalidad::create([
            'id'=>3,
            's_localidad' => '03 - SANTA FE',
        ]);
        SisLocalidad::create([
            'id'=>4,
            's_localidad' => '04 - SAN CRISTÓBAL',
        ]);
        SisLocalidad::create([
            'id'=>5,
            's_localidad' => '05 - USME',
        ]);
        SisLocalidad::create([
            'id'=>6,
            's_localidad' => '06 - TUNJUELITO',
        ]);
        SisLocalidad::create([
            'id'=>7,
            's_localidad' => '07 - BOSA',
        ]);
        SisLocalidad::create([
            'id'=>8,
            's_localidad' => '08 - KENNEDY',
        ]);
        SisLocalidad::create([
            'id'=>9,
            's_localidad' => '09 - FONTIBÓN',
        ]);
        SisLocalidad::create([
            'id'=>10,
            's_localidad' => '10 - ENGATIVÁ',
        ]);
        SisLocalidad::create([
            'id'=>11,
            's_localidad' => '11 - SUBA',
        ]);
        SisLocalidad::create([
            'id'=>12,
            's_localidad' => '12 - BARRIOS UNIDOS',
        ]);
        SisLocalidad::create([
            'id'=>13,
            's_localidad' => '13 - TEUSAQUILLO',
        ]);
        SisLocalidad::create([
            'id'=>14,
            's_localidad' => '14 - LOS MÁRTIRES',
        ]);
        SisLocalidad::create([
            'id'=>15,
            's_localidad' => '15 - ANTONIO NARIÑO',
        ]);
        SisLocalidad::create([
            'id'=>16,
            's_localidad' => '16 - PUENTE ARANDA',
        ]);
        SisLocalidad::create([
            'id'=>17,
            's_localidad' => '17 - LA CANDELARIA',
        ]);
        SisLocalidad::create([
            'id'=>18,
            's_localidad' => '18 - RAFAEL URIBE',
        ]);
        SisLocalidad::create([
            'id'=>19,
            's_localidad' => '19 - CIUDAD BOLÍVAR',
        ]);
        SisLocalidad::create([
            'id'=>20,
            's_localidad' => '20 - SUMAPAZ',
        ]);
        SisLocalidad::create([
            'id'=>23,
            's_localidad' => '23 - SIN REGISTRO',
        ]);
        SisLocalidad::create([
            'id'=>24,
            's_localidad' => '24 - NO SABE / NO RESPONDE',
        ]);

        SisLocalidad::create([
            'id'=>60,
            's_localidad' => '60 - FUERA DE BOGOTA',
        ]);

     
    }
}

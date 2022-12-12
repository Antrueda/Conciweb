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
            's_localidad' => 'USAQUÉN',
        ]);
        SisLocalidad::create([
            'id'=>2,
            's_localidad' => 'CHAPINERO',
        ]);
        SisLocalidad::create([
            'id'=>3,
            's_localidad' => 'SANTA FE',
        ]);
        SisLocalidad::create([
            'id'=>4,
            's_localidad' => 'SAN CRISTÓBAL',
        ]);
        SisLocalidad::create([
            'id'=>5,
            's_localidad' => 'USME',
        ]);
        SisLocalidad::create([
            'id'=>6,
            's_localidad' => 'TUNJUELITO',
        ]);
        SisLocalidad::create([
            'id'=>7,
            's_localidad' => 'BOSA',
        ]);
        SisLocalidad::create([
            'id'=>8,
            's_localidad' => 'KENNEDY',
        ]);
        SisLocalidad::create([
            'id'=>9,
            's_localidad' => 'FONTIBÓN',
        ]);
        SisLocalidad::create([
            'id'=>10,
            's_localidad' => 'ENGATIVÁ',
        ]);
        SisLocalidad::create([
            'id'=>11,
            's_localidad' => 'SUBA',
        ]);
        SisLocalidad::create([
            'id'=>12,
            's_localidad' => 'BARRIOS UNIDOS',
        ]);
        SisLocalidad::create([
            'id'=>13,
            's_localidad' => 'TEUSAQUILLO',
        ]);
        SisLocalidad::create([
            'id'=>14,
            's_localidad' => 'LOS MÁRTIRES',
        ]);
        SisLocalidad::create([
            'id'=>15,
            's_localidad' => 'ANTONIO NARIÑO',
        ]);
        SisLocalidad::create([
            'id'=>16,
            's_localidad' => 'PUENTE ARANDA',
        ]);
        SisLocalidad::create([
            'id'=>17,
            's_localidad' => 'LA CANDELARIA',
        ]);
        SisLocalidad::create([
            'id'=>18,
            's_localidad' => 'RAFAEL URIBE',
        ]);
        SisLocalidad::create([
            'id'=>19,
            's_localidad' => 'CIUDAD BOLÍVAR',
        ]);
        SisLocalidad::create([
            'id'=>20,
            's_localidad' => 'SOACHA',
        ]);
        SisLocalidad::create([
            'id'=>21,
            's_localidad' => 'SUMAPAZ',
        ]);
        SisLocalidad::create([
            'id'=>22,
            's_localidad' => 'NO APLICA',
        ]);

        SisLocalidad::create([
            'id'=>23,
            's_localidad' => 'LOCALIDA INCORRECTA EN LA BASE PLANA',
        ]);
    }
}

<?php

use App\CamposMagicos\CamposMagicos;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSisDepartamSisMunicipioTable extends Migration
{
    private $tablaxxx = 'sis_departam_sis_municipio';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tablaxxx, function (Blueprint $table) {


            $table->increments('id')->start(1)->nocache();
            $table->bigInteger('sis_departam_id')->unsigned();
            $table->bigInteger('sis_municipio_id')->unsigned();
            $table->foreign('sis_departam_id')->references('id')->on('sis_departams');
            $table->foreign('sis_municipio_id')->references('id')->on('sis_municipios');
            $table->integer('sis_esta_id')->unsigned();
            $table->foreign('sis_esta_id')->references('id')->on('conci_sis_estas');


            
            $table->timestamps();
        });
        //DB::statement("ALTER TABLE `{$this->tablaxxx}` comment 'TABLA QUE ALMACENA LA RALACION DE LOS DEPARTAMENTOS CON LOS MUNICIPIOS'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tablaxxx);
    }
}

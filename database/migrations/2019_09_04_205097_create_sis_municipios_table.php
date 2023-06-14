<?php

use App\CamposMagicos\CamposMagicos;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSisMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sis_municipios', function (Blueprint $table) {

            $table->increments('id')->start(1)->nocache()->comment('CAMPO DE LLAVE PRIMARIA DE LA TABLA');
            $table->integer('sis_departam_id')->unsigned()->comment('CAMPO DE ID DEL DEPARTAMENTO');
            $table->string('s_municipio')->comment('CAMPO NOMBRE DEL MUNICIPIO');
            $table->Integer('codigo')->nullable()->comment('IDENTIFICADOR EN EL SIMI ANTIGUO');
            $table->Integer('user_crea_id');
            $table->integer('user_edita_id');
            $table->integer('sis_esta_id')->unsigned();
            $table->foreign('sis_esta_id')->references('id')->on('conci_sis_estas');
            $table->timestamps();
            $table->foreign('sis_departam_id')->references('id')->on('sis_departams');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('h_sis_municipios');
        Schema::dropIfExists('sis_municipios');
    }
}

<?php

use App\CamposMagicos\CamposMagicos;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSisPaissTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sis_pais', function (Blueprint $table) {
            $table->increments('id')->start(1)->nocache()->comment('CAMPO DE LLAVE PRIMARIA DE LA TABLA');
            $table->string('s_iso')->comment('CAMPO DE LAS SIGLAS DEL PAIS');
            $table->string('s_pais')->comment('CAMPO DE NOMBRE DEL PAIS');
            $table->Integer('simianti_id')->nullable()->comment('IDENTIFICADOR EN EL SIMI ANTIGUO');
            $table->Integer('user_crea_id');
            $table->integer('user_edita_id');
            $table->Integer('sis_esta_id')->unsigned();
            $table->foreign('sis_esta_id')->references('id')->on('sis_estas');
            $table->timestamps();
        });

        Schema::create('h_sis_pais', function (Blueprint $table) {
            $table->increments('id')->start(1)->nocache()->comment('CAMPO DE LLAVE PRIMARIA DE LA TABLA');
            $table->string('s_iso')->comment('CAMPO DE LAS SIGLAS DEL PAIS');
            $table->string('s_pais')->comment('CAMPO DE NOMBRE DEL PAIS');
            $table->Integer('simianti_id')->nullable()->comment('IDENTIFICADOR EN EL SIMI ANTIGUO');

            $table = CamposMagicos::h_magicos($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('h_sis_pais');
        Schema::dropIfExists('sis_pais');
    }
}

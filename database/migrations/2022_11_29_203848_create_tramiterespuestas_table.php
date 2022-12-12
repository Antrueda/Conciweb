<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramiterespuestas', function (Blueprint $table) {
            $table->increments('CONSECUTIVO',12)->start(1)->nocache();
            $table->Integer('NUM_SOLICITUD',10)->nullable();
            $table->Integer('ID_TRAMITE',4)->nullable();
            $table->Integer('NUM_PASO',4)->nullable();
            $table->date('FEC_RESPUESTA')->nullable();
            $table->string('TEX_RESPUESTA')->nullable();
            $table->Integer('ID_USU_ADM_CONTESTA')->nullable();
            $table->Integer('ID_USU_ADM')->nullable();
            $table->string('ESTADO_TRAMITE')->nullable();
            $table->Integer('NUM_PASO_ANTERIOR',4)->nullable();
            $table->string('VIGENCIA')->nullable();
            $table->string('CAMBIO')->nullable();
            $table->string('REGRESO')->nullable();
            $table->string('ASIGNADO_POR')->nullable();
            $table->string('ASIGNADO_A')->nullable();
            $table->Integer('ID_DEPENDENCIA_REG')->nullable();
            $table->Integer('ID_DEPENDENCIA_ASIG')->nullable();
            $table->Integer('VAL_DEPENDENCIA')->nullable();
            $table->Integer('RECHAZADO_CASO')->nullable();
            $table->Integer('ID_ENTIDAD_REMITE')->nullable();
            $table->string('CODIGO_ENTIDAD_REMITE')->nullable();
            $table->Integer('ID_TIPO_GESTION')->nullable();
            $table->Integer('ID_MATERIALIZACION')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tramiterespuestas');
    }
};

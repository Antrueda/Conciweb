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
        Schema::create('soportecons', function (Blueprint $table) {
            $table->bigincrements('id',12)->start(1)->nocache();
            $table->string('descripcion')->nullable();
            $table->string('rutaFinalFile')->nullable();
            $table->string('nombreOriginalFile')->nullable();
            $table->bigInteger('NUM_SOLICITUD')->unsigned()->default(1)->nullable();
            $table->foreign('NUM_SOLICITUD')->references('NUM_SOLICITUD')->on('tramiteusuarios');
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
        Schema::dropIfExists('soportecons');
    }
};

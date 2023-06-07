<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        //aleatorio cando hay mas de 1 y tiene repetido el contador
        Schema::create('conci_referentes', function (Blueprint $table) {
            $table->increments('id')->start(1)->nocache();
            $table->bigInteger('consec')->nullable();
            $table->bigInteger('depend_codigo')->nullable();
            $table->bigInteger('ccfuncionario')->nullable();
            $table->bigInteger('contador')->nullable();
            $table->bigInteger('estado')->nullable(); //1 activo  0 inactivo
            $table->date('fechaing')->nullable();
            $table->date('fechafin')->nullable();
            $table->bigInteger('correo')->nullable();
            $table->string('email',200)->nullable();

            //correo
     ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conci_referentes');
    }
};

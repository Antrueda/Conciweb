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
        Schema::create('conci_subdescripcions', function (Blueprint $table) {
            $table->increments('id')->start(1)->nocache();
            $table->bigInteger('descri_id')->unsigned();
            $table->bigInteger('subasu_id')->unsigned();
            $table->foreign('descri_id')->references('id')->on('descripcionas');
            $table->foreign('subasu_id')->references('id')->on('sub_asuntos');
            $table->bigInteger('sis_esta_id')->unsigned()->default(1);
            $table->foreign('sis_esta_id')->references('id')->on('sis_estas');
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
        Schema::dropIfExists('subdescripcions');
    }
};

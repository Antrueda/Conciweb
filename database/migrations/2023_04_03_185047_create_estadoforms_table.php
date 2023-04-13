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
        Schema::create('estadoforms', function (Blueprint $table) {
            $table->increments('id')->start(1)->nocache();
            $table->string('estado')->nullable();
            $table->bigInteger('sis_esta_id')->nullable()->unsigned()->default(1);
            $table->foreign('sis_esta_id')->references('id')->on('conci_sis_estas');
            $table->bigInteger('texto_id')->nullable()->unsigned()->default(1);
            $table->foreign('texto_id')->references('id')->on('conci_textos');
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
        Schema::dropIfExists('estadoforms');
    }
};

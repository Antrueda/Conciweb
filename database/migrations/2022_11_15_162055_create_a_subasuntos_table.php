<?php

use App\CamposMagicos\CamposMagicos;
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
        Schema::create('conci_a_subasuntos', function (Blueprint $table) {
            $table->increments('id')->start(1)->nocache();
            $table->bigInteger('asunto_id')->unsigned();
            $table->bigInteger('subasu_id')->unsigned();
            $table->foreign('asunto_id')->references('id')->on('conci_asuntos');
            $table->foreign('subasu_id')->references('id')->on('conci_sub_asuntos');
            $table->bigInteger('sis_esta_id')->unsigned()->default(1);
            $table->foreign('sis_esta_id')->references('id')->on('conci_sis_estas');
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
        Schema::dropIfExists('conci_a_subasuntos');
    }
};

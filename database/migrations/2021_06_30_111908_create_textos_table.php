<?php

use App\CamposMagicos\CamposMagicos;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextosTable extends Migration
{
    private $tablaxxx = 'conci_textos';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tablaxxx, function (Blueprint $table) {
            $table->increments('id')->start(1)->nocache();
            $table->text('texto')->nullable()->comment('OBSERVACION DE LA SALIDA');
            $table->bigInteger('tipotexto_id')->unsigned()->comment('CAMPO ID NNAJ');
            $table->foreign('tipotexto_id')->references('id')->on('conci_parametros');
            $table->Integer('user_crea_id')->nullable();
            $table->integer('user_edita_id')->nullable();
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

        Schema::dropIfExists($this->tablaxxx);
    }
}

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
        Schema::create('conci_tramiteusuarios', function (Blueprint $table) {
            $table->bigincrements('NUM_SOLICITUD',12)->start(1)->nocache();
            $table->Integer('ID_TRAMITE',4)->nullable();;
            $table->Integer('ID_USUARIO_REG')->nullable();
            $table->date('FEC_SOLICITUD_TRAMITE')->nullable();
            $table->string('ESTADO_TRAMITE')->nullable();
            $table->string('VIGENCIA')->nullable();
            $table->string('OIDO_CODIGO')->nullable();
            $table->string('primerNombre')->nullable();
            $table->string('segundoNombre')->nullable();
            $table->string('primerApellido')->nullable();
            $table->string('segundoApellido')->nullable();
            $table->string('primerTelefono')->nullable();
            $table->string('segundoTelefono')->nullable();
            $table->string('email')->nullable();
            $table->string('direccion')->nullable();
            $table->string('localidad')->nullable();
            $table->string('tipoSolicitud')->nullable();
            $table->string('tipoDocApoderado')->nullable();
            $table->string('numDocApoderado')->nullable();
            $table->string('primerNombreApoderado')->nullable();
            $table->string('segundoNombreApoderado')->nullable();
            $table->string('primerApellidoApoderado')->nullable();
            $table->string('segundoApellidoApoderado')->nullable();
            $table->string('tarjetaProfesional')->nullable();
            $table->string('primerTelefonoApoderado')->nullable();
            $table->string('segundoTelefonoApoderado')->nullable();
            $table->string('emailApoderado')->nullable();
            $table->string('tipoAudiencia')->nullable();
            $table->string('sedePrincipal')->nullable();
            $table->string('sedeSecundaria')->nullable();
            $table->string('asunto')->nullable();
            $table->string('subAsunto')->nullable();
            $table->string('tipoDocumento')->nullable();
            $table->string('detalle')->nullable();
            $table->string('cuantia')->nullable();
            $table->string('code')->nullable();
            $table->bigInteger('sis_esta_id')->unsigned()->default(1)->nullable();
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
        Schema::dropIfExists('tramiteusuarios');
    }
};
/*
   'NUM_SOLICITUD' => $numSolicitud,
                'ID_TRAMITE' => $idTramite,
                'ID_USUARIO_REG' => $numeroDocumento,
                'FEC_SOLICITUD_TRAMITE' => DB::raw("TO_DATE('" . $fechaRegistro . "','DD/MM/YYYY HH24:MI:SS')"),
                'ESTADO_TRAMITE' => DB::raw("'Remitido'"),
                'VIGENCIA' => $vigencia,
                'OIDO_CODIGO' => 0,
                'TEXTO01' => DB::raw("'$primerNombre'"),
                'TEXTO02' => DB::raw("'$segundoNombre'"),
                'TEXTO03' => DB::raw("'$primerApellido'"),
                'TEXTO04' => DB::raw("'$segundoApellido'"),
                'TEXTO05' => DB::raw("'$primerTelefono'"),
                'TEXTO06' => DB::raw("'$segundoTelefono'"),
                'TEXTO07' => DB::raw("'$email'"),
                'TEXTO08' => DB::raw("'$direccion'"),
                'TEXTO09' => DB::raw("$localidad"),
                'NUMERO01' => $tipoSolicitud,
                'TEXTO10' => DB::raw("'$tipoDocApoderado'"),
                'TEXTO11' => DB::raw("'$numDocApoderado'"),
                'TEXTO12' => DB::raw("'$primerNombreApoderado'"),
                'TEXTO13' => DB::raw("'$segundoNombreApoderado'"),
                'TEXTO14' => DB::raw("'$primerApellidoApoderado'"),
                'TEXTO15' => DB::raw("'$segundoApellidoApoderado'"),
                'TEXTO16' => DB::raw("'$tarjetaProfesional'"),
                'TEXTO17' => DB::raw("'$primerTelefonoApoderado'"),
                'TEXTO18' => DB::raw("'$segundoTelefonoApoderado'"),
                'TEXTO19' => DB::raw("'$emailApoderado'"),
                'NUMERO02' => $tipoAudiencia,
                'NUMERO03' => $sedePrincipal,
                'NUMERO04' => $sedeSecundaria,
                'NUMERO05' => $asunto,
                'NUMERO06' => $subAsunto,
                'NUMERO07' => $tipoDocumento,
                'TEXTO21' => DB::raw("'$detalle'"),
                'NUMERO08' => $cuantia,
                'TEXTO22' => DB::raw("'$rutaFinalFile'"),
                'TEXTO23' => DB::raw("'$nombreOriginalFile'")
                */
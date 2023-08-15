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
        Schema::create('conci_documentos', function (Blueprint $table) {
            $table->bigincrements('id',12)->start(1)->nocache();
            $table->string('descripcion',500)->nullable();
            $table->string('rutaFinalFile')->nullable();
            $table->string('nombreOriginalFile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conci_documentos');
    }
};

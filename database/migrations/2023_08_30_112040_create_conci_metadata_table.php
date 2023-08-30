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
        Schema::create('conci_metadata', function (Blueprint $table) {
            $table->id();
            $table->string('ip',500)->nullable();
            $table->Integer('num_solicitud',12)->nullable();
            $table->string('plataforma')->nullable();
            $table->string('explorador')->nullable();
            $table->string('pais')->nullable();
            $table->string('ciudad')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conci_metadata');
    }
};

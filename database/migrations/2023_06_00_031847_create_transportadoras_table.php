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
        Schema::create('transportadoras', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cnpj');
            $table->string('endereco');
            $table->unsignedBigInteger('modoenvio_id');
            $table->timestamps();

            $table->foreign('modoenvio_id')->references('id')->on('modoenvio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportadoras');
    }
};

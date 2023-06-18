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
        Schema::create('medicamentos', function (Blueprint $table) {
    $table->id();
    $table->string('nome');
    $table->string('lote');
    $table->unsignedBigInteger('laboratorios_id');
    $table->date('data_validade');
    $table->date('data_fabricacao');
    $table->decimal('valor');
    $table->integer('quantidade');
    $table->unsignedBigInteger('transportadoras_id');
    $table->timestamps();

    $table->foreign('laboratorios_id')->references('id')->on('laboratorios');
    $table->foreign('transportadoras_id')->references('id')->on('transportadoras');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos');
    }
};

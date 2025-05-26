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
        Schema::create('medicamentos_atendidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cita_id');
            $table->foreign('cita_id')->references('id')->on('citas')->onDelete('cascade');
            $table->unsignedBigInteger('medicamento_id');
            $table->foreign('medicamento_id')->references('id')->on('medicamentos')->onDelete('cascade');
            $table->integer('cantidad')->default(1);
            $table->string('frecuencia')->nullable(); // Nuevo campo para frecuencia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos_atendidos');
    }
};

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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_paciente')->nullable(); // Permitir nulos
            $table->date('fech'); // Mantener el nombre original
            $table->time('hora'); // Nuevo campo para la hora de la cita
            $table->string('obser')->nullable(); // Permitir nulos
            $table->string('estado')->nullable(); // Permitir nulos
            $table->unsignedBigInteger('id_consul')->nullable(); // Permitir nulos
            $table->unsignedBigInteger('id_doc')->nullable(); // Permitir nulos
            $table->unsignedBigInteger('id_espe'); // Especialidad

            // Claves foráneas
            $table->foreign('id_paciente')->references('id')->on('pacientes');
            $table->foreign('id_consul')->references('id')->on('consultorios');
            $table->foreign('id_doc')->references('id')->on('doctores');
            $table->foreign('id_espe')->references('id')->on('especialidades');

            // Índice único compuesto para evitar duplicados en fecha, hora y médico
            $table->unique(['fech', 'hora', 'id_doc']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
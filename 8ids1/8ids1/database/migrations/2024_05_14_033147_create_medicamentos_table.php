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
            $table->timestamps();
            
            // Creamos el campo 'especialidad_id' que hace referencia a la tabla 'especialidades'
            $table->unsignedBigInteger('especialidad_id')->nullable();
            
            // Creamos las otras columnas
            $table->string('descripcion');
            $table->decimal('precio');
            $table->date('fecha_caducidad');
            $table->decimal('existencia');
            
            // Establecemos la relación con la tabla 'especialidades'
            $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('set null');
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

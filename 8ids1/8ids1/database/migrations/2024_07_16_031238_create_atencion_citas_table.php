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
        Schema::create('atencion_citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cita_id');
            $table->foreign('cita_id')->references('id')->on('citas')->onDelete('cascade');
            $table->text('observaciones_doctor')->nullable(); // Observaciones del doctor para la atención de la cita
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atencion_citas');
    }
};

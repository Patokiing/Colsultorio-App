<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autorizar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cita');
            $table->date('fecha');
            $table->unsignedBigInteger('id_espe');
            $table->unsignedBigInteger('id_doc');
            $table->timestamps(); // Añade timestamps si quieres tener created_at y updated_at

            $table->foreign('id_cita')->references('id')->on('citas')->onDelete('cascade');
            $table->foreign('id_espe')->references('id')->on('especialidades')->onDelete('cascade');
            $table->foreign('id_doc')->references('id')->on('doctores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autorizar');
    }
};

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
        Schema::create('materiales_recetado', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_cit');
            $table->unsignedBigInteger('id_medi');
            $table->float('caant');
            $table->decimal('uni');
            $table->double('cada');
            $table->double('pordias');

            $table->foreign('id_cit')->references('id')->on('citas');
            $table->foreign('id_medi')->references('id')->on('medicamentos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales_recetado');
    }
};

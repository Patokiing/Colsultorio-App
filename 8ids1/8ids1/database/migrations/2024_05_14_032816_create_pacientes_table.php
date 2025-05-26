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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre')->nullable();
            $table->string('ApPat')->nullable();
            $table->string('ApMat')->nullable();
            $table->string('tele')->nullable();
            $table->unsignedBigInteger('idusr');
            $table->foreign('idusr')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};

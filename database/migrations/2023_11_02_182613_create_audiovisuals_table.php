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
        Schema::create('audiovisuals', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('titulo_original')->nullable();
            $table->integer('year')->nullable();
            $table->integer('duracion')->nullable();
            $table->string('pais')->nullable();
            $table->text('sinopsis')->nullable();
            $table->string('img')->nullable();
            $table->foreignId('tipo_id')->constrained('tipos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audiovisuals');
    }
};

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
        Schema::create('audiovisual_genero', function (Blueprint $table) {
            $table->foreignId('genero_id')->constrained('generos');
            $table->foreignId('audiovisual_id')->constrained('audiovisuales')->onDelete('cascade');
            $table->primary(['genero_id', 'audiovisual_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audiovisual_genero');
    }
};

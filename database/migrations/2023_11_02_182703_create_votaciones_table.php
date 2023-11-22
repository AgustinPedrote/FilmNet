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
        Schema::create('votaciones', function (Blueprint $table) {
            $table->enum('voto', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10])->default('No vista')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('audiovisual_id')->constrained('audiovisuales');
            $table->primary(['user_id', 'audiovisual_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votaciones');
    }
};

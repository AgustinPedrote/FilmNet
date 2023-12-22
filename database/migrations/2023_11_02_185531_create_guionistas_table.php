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
        Schema::create('guionistas', function (Blueprint $table) {
            $table->foreignId('persona_id')->constrained('personas');
            $table->foreignId('audiovisual_id')->constrained('audiovisuales')->onDelete('cascade');
            $table->primary(['persona_id', 'audiovisual_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guionistas');
    }
};

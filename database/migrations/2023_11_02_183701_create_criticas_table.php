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
        Schema::create('criticas', function (Blueprint $table) {
            $table->text('critica');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('audiovisual_id')->constrained('audiovisuales')->onDelete('cascade');
            $table->timestamps();
            $table->primary(['user_id', 'audiovisual_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criticas');
    }
};

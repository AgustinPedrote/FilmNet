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
        Schema::create('audiovisual_company', function (Blueprint $table) {
            $table->foreignId('audiovisual_id')->constrained('audiovisuales')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies');
            $table->primary(['audiovisual_id', 'company_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audiovisual_company');
    }
};

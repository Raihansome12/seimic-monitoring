<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seismic_readings', function (Blueprint $table) {
            $table->id();
            $table->json('adc_counts');
            $table->float('acceleration')->nullable();
            $table->float('velocity')->nullable();
            $table->float('displacement')->nullable();
            $table->timestamp('reading_times');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seismic_readings');
    }
};

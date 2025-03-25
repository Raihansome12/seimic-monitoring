<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gps_locations', function (Blueprint $table) {
            $table->id();
            $table->float('latitude');
            $table->float('longitude');
            $table->timestamp('reading_times');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('gps_readings');
    }
};

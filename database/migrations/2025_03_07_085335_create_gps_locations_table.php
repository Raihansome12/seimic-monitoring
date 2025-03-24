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
            $table->float('longitude', 10, 6);
            $table->float('latitude', 10, 6);
            $table->timestamp('reading_times');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('gps_readings');
    }
};

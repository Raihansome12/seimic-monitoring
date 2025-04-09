<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ground_motions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seismic_reading_id')->constrained()->onDelete('cascade');
            $table->float('acceleration');
            $table->float('velocity');
            $table->float('displacement');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ground_motions');
    }
};

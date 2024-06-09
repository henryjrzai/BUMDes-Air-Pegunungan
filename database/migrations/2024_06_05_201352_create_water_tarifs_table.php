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
        Schema::create('water_tarifs', function (Blueprint $table) {
            $table->id();
            $table->string('tariff_name');
            $table->enum('tariff_category', ['I', 'II', 'III', 'III A', 'III B', 'IV', 'IV A', 'IV B', 'V Khusus']);
            $table->integer('t0_3_M3');
            $table->integer('t__3_10_M3');
            $table->integer('t__10_20_M3');
            $table->integer('t__20_M3');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_tarifs');
    }
};

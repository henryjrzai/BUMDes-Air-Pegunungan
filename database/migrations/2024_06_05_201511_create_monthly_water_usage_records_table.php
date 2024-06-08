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
        Schema::create('monthly_water_usage_records', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->foreignId('customer_id')->constrained(table:'customers')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('initial_use');
            $table->bigInteger('last_use');
            $table->bigInteger('usage_value');
            $table->foreignId('user_id')->constrained(table:'users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_water_usage_records');
    }
};

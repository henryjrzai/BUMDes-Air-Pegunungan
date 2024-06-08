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
        Schema::create('montly_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained(table:'customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('monthly_water_usage_record_id')->constrained(table:'monthly_water_usage_records')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('billing_costs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('montly_bills');
    }
};

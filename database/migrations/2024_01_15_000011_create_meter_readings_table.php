<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meter_readings', function (Blueprint $table) {
            $table->id();
            $table->string('reading_type');
            $table->string('property_name');
            $table->string('unit_name');
            $table->decimal('previous_reading', 10, 2);
            $table->decimal('current_reading', 10, 2);
            $table->dateTime('recorded_at');
            $table->timestamps();
            $table->index('reading_type');
            $table->index('property_name');
            $table->index('recorded_at');
            $table->index(['property_name', 'unit_name', 'reading_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meter_readings');
    }
};

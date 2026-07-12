<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->string('name');
            $table->integer('floor')->default(0);
            $table->integer('bedrooms')->default(1);
            $table->decimal('monthly_rent', 10, 2);
            $table->string('status')->default('available');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index('property_name');
            $table->index('status');
            $table->index(['property_name', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};

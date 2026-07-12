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
        Schema::table('properties', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['type', 'unit_count', 'occupied_units', 'notes']);
            
            // Add new columns
            $table->string('city')->after('address');
            $table->string('postal_code')->after('city');
            $table->string('property_type')->after('postal_code');
            $table->integer('total_units')->default(1)->after('property_type');
            $table->integer('year_built')->nullable()->after('total_units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn(['city', 'postal_code', 'property_type', 'total_units', 'year_built']);
            
            // Restore old columns
            $table->string('type')->after('name');
            $table->integer('unit_count')->default(0)->after('address');
            $table->integer('occupied_units')->default(0)->after('unit_count');
            $table->text('notes')->nullable()->after('status');
        });
    }
};

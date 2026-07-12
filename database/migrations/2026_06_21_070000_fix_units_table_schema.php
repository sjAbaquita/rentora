<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropIndex('units_property_name_index');
            $table->dropIndex(['property_name', 'name']);
        });

        Schema::table('units', function (Blueprint $table) {
            // Add new columns first
            $table->foreignId('property_id')->after('id')->nullable()->constrained('properties')->onDelete('cascade');
            $table->string('unit_number')->after('property_id')->nullable();
            $table->string('unit_type')->after('unit_number')->nullable();
            $table->decimal('area_sqm', 10, 2)->after('floor')->nullable();
            $table->renameColumn('floor', 'floor_number');
            $table->integer('bathrooms')->after('bedrooms')->default(1);

            // Add indexes for foreign key
            $table->index('property_id');
        });

        // Drop old columns in a separate migration to avoid conflicts
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn(['property_name', 'name', 'monthly_rent', 'notes']);
        });
    }

    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->string('property_name');
            $table->string('name')->after('property_name');
            $table->decimal('monthly_rent', 10, 2)->after('bedrooms');
            $table->text('notes')->nullable()->after('monthly_rent');
            
            $table->index('property_name');
            $table->index(['property_name', 'name']);
        });
        
        Schema::table('units', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
            $table->dropIndex('property_id');
            $table->dropColumn(['property_id', 'unit_number', 'unit_type', 'area_sqm', 'bathrooms']);
            $table->renameColumn('floor_number', 'floor');
        });
    }
};

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
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropIndex('tenants_property_name_index');
            $table->dropIndex('tenants_lease_status_index');
        });

        Schema::table('tenants', function (Blueprint $table) {
            // Drop old columns that don't match form
            $table->dropColumn(['property_name', 'unit_name', 'lease_status', 'balance', 'name']);

            // Add new columns matching form fields
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->string('nationality')->after('date_of_birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'date_of_birth', 'nationality']);
            
            // Add back old columns
            $table->string('name')->after('id');
            $table->string('property_name')->nullable();
            $table->string('unit_name')->nullable();
            $table->string('lease_status')->default('active');
            $table->decimal('balance', 10, 2)->default(0);
        });
    }
};

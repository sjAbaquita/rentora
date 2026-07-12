<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leases', function (Blueprint $table) {
            $table->dropIndex('leases_tenant_name_index');
            $table->dropIndex('leases_property_name_index');
        });

        Schema::table('leases', function (Blueprint $table) {
            // Add new foreign keys and columns first
            $table->foreignId('unit_id')->after('id')->nullable()->constrained('units')->onDelete('cascade');
            $table->foreignId('tenant_id')->after('unit_id')->nullable()->constrained('tenants')->onDelete('cascade');
            $table->renameColumn('start_date', 'lease_start');
            $table->renameColumn('end_date', 'lease_end');
            $table->decimal('deposit', 10, 2)->after('lease_end')->nullable();

            // Add indexes
            $table->index('unit_id');
            $table->index('tenant_id');
        });

        // Drop old columns
        Schema::table('leases', function (Blueprint $table) {
            $table->dropColumn(['tenant_name', 'property_name', 'unit_name', 'security_deposit']);
        });
    }

    public function down(): void
    {
        Schema::table('leases', function (Blueprint $table) {
            $table->string('tenant_name');
            $table->string('property_name');
            $table->string('unit_name');
            $table->decimal('security_deposit', 10, 2)->after('end_date');
            
            $table->index('tenant_name');
            $table->index('property_name');
        });
        
        Schema::table('leases', function (Blueprint $table) {
            $table->dropForeign(['unit_id', 'tenant_id']);
            $table->dropIndex('unit_id');
            $table->dropIndex('tenant_id');
            $table->dropColumn(['unit_id', 'tenant_id', 'deposit']);
            $table->renameColumn('lease_start', 'start_date');
            $table->renameColumn('lease_end', 'end_date');
        });
    }
};

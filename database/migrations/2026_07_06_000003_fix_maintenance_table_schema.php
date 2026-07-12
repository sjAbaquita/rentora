<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('maintenance', function (Blueprint $table) {
            if (Schema::hasColumn('maintenance', 'tenant_name')) {
                $table->dropIndex('maintenance_tenant_name_index');
            }

            if (Schema::hasColumn('maintenance', 'property_name')) {
                $table->dropIndex('maintenance_property_name_index');
            }
        });

        Schema::table('maintenance', function (Blueprint $table) {
            if (!Schema::hasColumn('maintenance', 'tenant_id')) {
                $table->foreignId('tenant_id')->after('id')->nullable()->constrained('tenants')->onDelete('set null');
                $table->index('tenant_id');
            }

            if (!Schema::hasColumn('maintenance', 'unit_id')) {
                $table->foreignId('unit_id')->after('tenant_id')->nullable()->constrained('units')->onDelete('cascade');
                $table->index('unit_id');
            }

            if (!Schema::hasColumn('maintenance', 'description')) {
                $table->text('description')->after('title')->nullable();
            }

            if (!Schema::hasColumn('maintenance', 'assigned_to')) {
                $table->string('assigned_to')->after('status')->nullable();
            }
        });

        Schema::table('maintenance', function (Blueprint $table) {
            $columns = array_filter([
                Schema::hasColumn('maintenance', 'tenant_name') ? 'tenant_name' : null,
                Schema::hasColumn('maintenance', 'property_name') ? 'property_name' : null,
                Schema::hasColumn('maintenance', 'unit_name') ? 'unit_name' : null,
            ]);

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }

    public function down(): void
    {
        Schema::table('maintenance', function (Blueprint $table) {
            if (!Schema::hasColumn('maintenance', 'tenant_name')) {
                $table->string('tenant_name')->after('id');
                $table->index('tenant_name');
            }

            if (!Schema::hasColumn('maintenance', 'property_name')) {
                $table->string('property_name')->after('tenant_name');
                $table->index('property_name');
            }

            if (!Schema::hasColumn('maintenance', 'unit_name')) {
                $table->string('unit_name')->after('property_name');
            }
        });

        Schema::table('maintenance', function (Blueprint $table) {
            if (Schema::hasColumn('maintenance', 'tenant_id')) {
                $table->dropForeign(['tenant_id', 'unit_id']);
                $table->dropIndex('tenant_id');
                $table->dropIndex('unit_id');
                $table->dropColumn(['tenant_id', 'unit_id', 'description', 'assigned_to']);
            }
        });
    }
};

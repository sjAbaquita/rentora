<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            if (Schema::hasColumn('invoices', 'tenant_name')) {
                $table->dropIndex('invoices_tenant_name_index');
            }

            if (Schema::hasColumn('invoices', 'property_name')) {
                $table->dropIndex('invoices_property_name_index');
            }
        });

        Schema::table('invoices', function (Blueprint $table) {
            if (!Schema::hasColumn('invoices', 'lease_id')) {
                $table->foreignId('lease_id')->after('id')->nullable()->constrained('leases')->onDelete('cascade');
                $table->index('lease_id');
            }

            if (!Schema::hasColumn('invoices', 'description')) {
                $table->text('description')->after('late_fee')->nullable();
            }

            if (!Schema::hasColumn('invoices', 'amount_paid')) {
                $table->decimal('amount_paid', 10, 2)->after('amount_due')->default(0);
            }
        });

        Schema::table('invoices', function (Blueprint $table) {
            $columns = array_filter([
                Schema::hasColumn('invoices', 'tenant_name') ? 'tenant_name' : null,
                Schema::hasColumn('invoices', 'property_name') ? 'property_name' : null,
                Schema::hasColumn('invoices', 'unit_name') ? 'unit_name' : null,
                Schema::hasColumn('invoices', 'lease_reference') ? 'lease_reference' : null,
            ]);

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            if (!Schema::hasColumn('invoices', 'tenant_name')) {
                $table->string('tenant_name')->after('invoice_number');
                $table->index('tenant_name');
            }

            if (!Schema::hasColumn('invoices', 'property_name')) {
                $table->string('property_name')->after('tenant_name');
                $table->index('property_name');
            }

            if (!Schema::hasColumn('invoices', 'unit_name')) {
                $table->string('unit_name')->after('property_name');
            }

            if (!Schema::hasColumn('invoices', 'lease_reference')) {
                $table->string('lease_reference')->after('unit_name')->nullable();
            }
        });

        Schema::table('invoices', function (Blueprint $table) {
            if (Schema::hasColumn('invoices', 'lease_id')) {
                $table->dropForeign(['lease_id']);
                $table->dropIndex('lease_id');
                $table->dropColumn(['lease_id', 'description', 'amount_paid']);
            }
        });
    }
};

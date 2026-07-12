<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'invoice_number')) {
                $table->dropIndex('payments_invoice_number_index');
            }

            if (Schema::hasColumn('payments', 'tenant_name')) {
                $table->dropIndex('payments_tenant_name_index');
            }
        });

        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'invoice_id')) {
                $table->foreignId('invoice_id')->after('id')->nullable()->constrained('invoices')->onDelete('cascade');
                $table->index('invoice_id');
            }

            if (!Schema::hasColumn('payments', 'tenant_id')) {
                $table->foreignId('tenant_id')->after('invoice_id')->nullable()->constrained('tenants')->onDelete('set null');
                $table->index('tenant_id');
            }
        });

        Schema::table('payments', function (Blueprint $table) {
            $columns = array_filter([
                Schema::hasColumn('payments', 'invoice_number') ? 'invoice_number' : null,
                Schema::hasColumn('payments', 'tenant_name') ? 'tenant_name' : null,
                Schema::hasColumn('payments', 'property_name') ? 'property_name' : null,
            ]);

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'invoice_number')) {
                $table->string('invoice_number')->after('reference_number');
                $table->index('invoice_number');
            }

            if (!Schema::hasColumn('payments', 'tenant_name')) {
                $table->string('tenant_name')->after('invoice_number');
                $table->index('tenant_name');
            }

            if (!Schema::hasColumn('payments', 'property_name')) {
                $table->string('property_name')->after('tenant_name');
            }
        });

        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'invoice_id')) {
                $table->dropForeign(['invoice_id', 'tenant_id']);
                $table->dropIndex('invoice_id');
                $table->dropIndex('tenant_id');
                $table->dropColumn(['invoice_id', 'tenant_id']);
            }
        });
    }
};

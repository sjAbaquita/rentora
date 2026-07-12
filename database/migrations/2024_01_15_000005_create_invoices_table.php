<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->string('lease_reference')->nullable();
            $table->string('tenant_name');
            $table->string('property_name');
            $table->string('unit_name');
            $table->string('billing_period');
            $table->date('due_date');
            $table->decimal('amount_due', 10, 2);
            $table->decimal('late_fee', 10, 2)->default(0);
            $table->string('status')->default('unpaid');
            $table->timestamps();
            $table->index('invoice_number');
            $table->index('tenant_name');
            $table->index('status');
            $table->index('due_date');
            $table->index('property_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

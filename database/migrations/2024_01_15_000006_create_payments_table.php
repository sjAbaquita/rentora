<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('invoice_number');
            $table->string('tenant_name');
            $table->string('property_name');
            $table->string('method');
            $table->dateTime('paid_at');
            $table->decimal('amount', 10, 2);
            $table->string('proof_status')->default('pending');
            $table->timestamps();
            $table->index('reference_number');
            $table->index('invoice_number');
            $table->index('tenant_name');
            $table->index('paid_at');
            $table->index('proof_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

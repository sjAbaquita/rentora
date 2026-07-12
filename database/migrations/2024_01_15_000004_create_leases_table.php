<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leases', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_name');
            $table->string('property_name');
            $table->string('unit_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('security_deposit', 10, 2);
            $table->decimal('monthly_rent', 10, 2);
            $table->string('status')->default('active');
            $table->timestamps();
            $table->index('tenant_name');
            $table->index('property_name');
            $table->index('status');
            $table->index('start_date');
            $table->index('end_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leases');
    }
};

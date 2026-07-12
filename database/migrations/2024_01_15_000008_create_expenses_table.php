<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->date('expense_date');
            $table->string('category');
            $table->text('description')->nullable();
            $table->string('property_name');
            $table->decimal('amount', 10, 2);
            $table->string('reference_number')->nullable();
            $table->timestamps();
            $table->index('expense_date');
            $table->index('category');
            $table->index('property_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};

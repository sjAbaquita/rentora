<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_name');
            $table->string('property_name');
            $table->string('unit_name');
            $table->string('title');
            $table->string('priority')->default('normal');
            $table->string('status')->default('open');
            $table->integer('photo_count')->default(0);
            $table->timestamps();
            $table->index('tenant_name');
            $table->index('property_name');
            $table->index('status');
            $table->index('priority');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};

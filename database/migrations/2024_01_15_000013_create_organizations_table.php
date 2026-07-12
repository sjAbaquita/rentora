<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('billing_email');
            $table->string('country')->nullable();
            $table->string('timezone')->default('UTC');
            $table->timestamps();
            $table->index('slug');
            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};

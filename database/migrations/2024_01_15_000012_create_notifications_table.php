<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('channel');
            $table->string('recipient');
            $table->dateTime('sent_at')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->index('recipient');
            $table->index('status');
            $table->index('channel');
            $table->index('sent_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

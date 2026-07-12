<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('audience');
            $table->dateTime('publish_at')->nullable();
            $table->string('status')->default('draft');
            $table->text('content')->nullable();
            $table->timestamps();
            $table->index('status');
            $table->index('audience');
            $table->index('publish_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};

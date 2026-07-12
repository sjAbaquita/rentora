<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            if (Schema::hasColumn('expenses', 'property_name')) {
                $table->dropIndex('expenses_property_name_index');
            }
        });

        Schema::table('expenses', function (Blueprint $table) {
            if (!Schema::hasColumn('expenses', 'property_id')) {
                $table->foreignId('property_id')->after('id')->nullable()->constrained('properties')->onDelete('cascade');
                $table->index('property_id');
            }
        });

        Schema::table('expenses', function (Blueprint $table) {
            if (Schema::hasColumn('expenses', 'property_name')) {
                $table->dropColumn(['property_name']);
            }
        });
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            if (!Schema::hasColumn('expenses', 'property_name')) {
                $table->string('property_name')->after('description');
                $table->index('property_name');
            }
        });

        Schema::table('expenses', function (Blueprint $table) {
            if (Schema::hasColumn('expenses', 'property_id')) {
                $table->dropForeign(['property_id']);
                $table->dropIndex('property_id');
                $table->dropColumn(['property_id']);
            }
        });
    }
};

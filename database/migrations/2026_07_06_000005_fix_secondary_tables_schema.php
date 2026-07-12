<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            if (!Schema::hasColumn('announcements', 'property_id')) {
                $table->foreignId('property_id')->after('id')->nullable()->constrained('properties')->onDelete('cascade');
                $table->index('property_id');
            }

            if (!Schema::hasColumn('announcements', 'priority')) {
                $table->string('priority')->after('content')->default('medium');
            }
        });

        Schema::table('documents', function (Blueprint $table) {
            if (Schema::hasColumn('documents', 'owner')) {
                $table->dropIndex('documents_owner_index');
            }
        });

        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'property_id')) {
                $table->foreignId('property_id')->after('id')->nullable()->constrained('properties')->onDelete('cascade');
            }

            if (!Schema::hasColumn('documents', 'tenant_id')) {
                $table->foreignId('tenant_id')->after('property_id')->nullable()->constrained('tenants')->onDelete('set null');
            }

            if (!Schema::hasColumn('documents', 'file_path')) {
                $table->string('file_path')->after('document_type')->nullable();
            }

            if (!Schema::hasColumn('documents', 'description')) {
                $table->text('description')->after('file_path')->nullable();
            }

            if (Schema::hasColumn('documents', 'owner')) {
                $table->dropColumn('owner');
            }

            $table->index(['property_id', 'tenant_id']);
        });

        Schema::table('meter_readings', function (Blueprint $table) {
            if (Schema::hasColumn('meter_readings', 'property_name')) {
                $table->dropIndex('meter_readings_property_name_index');
                $table->dropIndex(['property_name', 'unit_name', 'reading_type']);
            }
        });

        Schema::table('meter_readings', function (Blueprint $table) {
            if (!Schema::hasColumn('meter_readings', 'property_id')) {
                $table->foreignId('property_id')->after('id')->nullable()->constrained('properties')->onDelete('cascade');
            }

            if (!Schema::hasColumn('meter_readings', 'unit_id')) {
                $table->foreignId('unit_id')->after('property_id')->nullable()->constrained('units')->onDelete('cascade');
            }

            $table->index(['property_id', 'unit_id']);
        });

        Schema::table('meter_readings', function (Blueprint $table) {
            if (Schema::hasColumn('meter_readings', 'property_name')) {
                $table->dropColumn(['property_name', 'unit_name']);
            }
        });
    }

    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            if (Schema::hasColumn('announcements', 'property_id')) {
                $table->dropForeign(['property_id']);
                $table->dropIndex('property_id');
                $table->dropColumn(['property_id']);
            }
        });

        Schema::table('documents', function (Blueprint $table) {
            if (Schema::hasColumn('documents', 'property_id')) {
                $table->dropForeign(['property_id', 'tenant_id']);
                $table->dropIndex(['property_id', 'tenant_id']);
                $table->dropColumn(['property_id', 'tenant_id', 'file_path']);
            }
        });

        Schema::table('meter_readings', function (Blueprint $table) {
            if (!Schema::hasColumn('meter_readings', 'property_name')) {
                $table->string('property_name')->after('reading_type');
                $table->string('unit_name')->after('property_name');

                $table->index('property_name');
                $table->index(['property_name', 'unit_name', 'reading_type']);
            }
        });

        Schema::table('meter_readings', function (Blueprint $table) {
            if (Schema::hasColumn('meter_readings', 'property_id')) {
                $table->dropForeign(['property_id', 'unit_id']);
                $table->dropIndex(['property_id', 'unit_id']);
                $table->dropColumn(['property_id', 'unit_id']);
            }
        });
    }
};

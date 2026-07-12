<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'organization_id')) {
                $table->foreignId('organization_id')->after('id')->nullable()->constrained('organizations')->onDelete('set null');
                $table->index('organization_id');
            }

            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->after('email')->default('owner');
                $table->index('role');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'organization_id')) {
                $table->dropForeign(['organization_id']);
                $table->dropIndex('organization_id');
            }

            if (Schema::hasColumn('users', 'role')) {
                $table->dropIndex('role');
            }

            $columns = array_filter([
                Schema::hasColumn('users', 'organization_id') ? 'organization_id' : null,
                Schema::hasColumn('users', 'role') ? 'role' : null,
            ]);

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};

<?php

namespace App\Domains\Tenant\Actions;

use App\Domains\Tenant\Models\Tenant;
use Illuminate\Support\Facades\DB;

class DeleteTenantAction
{
    public function handle(Tenant $tenant): void
    {
        DB::transaction(function () use ($tenant) {
            $tenant->delete();
        });
    }
}

<?php

namespace App\Domains\Tenant\Actions;

use App\Domains\Tenant\Models\Tenant;
use Illuminate\Support\Facades\DB;

class UpdateTenantAction
{
    public function handle(Tenant $tenant, array $validatedData): Tenant
    {
        return DB::transaction(function () use ($tenant, $validatedData) {
            $tenant->update($validatedData);
            return $tenant->refresh();
        });
    }
}

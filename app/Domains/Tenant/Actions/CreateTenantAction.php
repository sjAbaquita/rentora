<?php

namespace App\Domains\Tenant\Actions;

use App\Domains\Tenant\Models\Tenant;
use Illuminate\Support\Facades\DB;

class CreateTenantAction
{
    public function handle(array $validatedData): Tenant
    {
        return DB::transaction(function () use ($validatedData) {
            return Tenant::create($validatedData);
        });
    }
}

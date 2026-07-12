<?php

namespace App\Domains\Tenant\Services;

use App\Domains\Tenant\Models\Tenant;
use App\Domains\Tenant\Requests\StoreTenantRequest;
use App\Domains\Tenant\Requests\UpdateTenantRequest;

class CreateTenantService
{
    /**
     * @param StoreTenantRequest $request
     * @return Tenant
     */
    public function store(StoreTenantRequest $request): Tenant
    {
        return Tenant::create($request->validated());
    }

    /**
     * @param Tenant $tenant
     * @param UpdateTenantRequest $request
     * @return Tenant
     */
    public function update(Tenant $tenant, UpdateTenantRequest $request): Tenant
    {
        $tenant->update($request->validated());

        return $tenant;
    }

    /**
     * @param Tenant $tenant
     * @return bool|null
     */
    public function destroy(Tenant $tenant): ?bool
    {
        return $tenant->delete();
    }
}

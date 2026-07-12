<?php

namespace App\Domains\Maintenance\Services;

use App\Domains\Maintenance\Models\Maintenance;
use App\Domains\Maintenance\Requests\StoreMaintenanceRequest;
use App\Domains\Maintenance\Requests\UpdateMaintenanceRequest;

class CreateMaintenanceService
{
    /**
     * @param StoreMaintenanceRequest $request
     * @return Maintenance
     */
    public function store(StoreMaintenanceRequest $request): Maintenance
    {
        return Maintenance::create($request->validated());
    }

    /**
     * @param Maintenance $maintenance
     * @param UpdateMaintenanceRequest $request
     * @return Maintenance
     */
    public function update(Maintenance $maintenance, UpdateMaintenanceRequest $request): Maintenance
    {
        $maintenance->update($request->validated());

        return $maintenance;
    }

    /**
     * @param Maintenance $maintenance
     * @return bool|null
     */
    public function destroy(Maintenance $maintenance): ?bool
    {
        return $maintenance->delete();
    }
}

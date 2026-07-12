<?php

namespace App\Domains\Maintenance\Actions;

use App\Domains\Maintenance\Models\MaintenanceRequest;
use Illuminate\Support\Facades\DB;

class UpdateMaintenanceAction
{
    public function handle(MaintenanceRequest $maintenance, array $validatedData): MaintenanceRequest
    {
        return DB::transaction(function () use ($maintenance, $validatedData) {
            $maintenance->update($validatedData);
            return $maintenance->refresh();
        });
    }
}

<?php

namespace App\Domains\Maintenance\Actions;

use App\Domains\Maintenance\Models\MaintenanceRequest;
use Illuminate\Support\Facades\DB;

class CreateMaintenanceAction
{
    public function handle(array $validatedData): MaintenanceRequest
    {
        return DB::transaction(function () use ($validatedData) {
            return MaintenanceRequest::create($validatedData);
        });
    }
}

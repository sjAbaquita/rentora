<?php

namespace App\Domains\Maintenance\Actions;

use App\Domains\Maintenance\Models\MaintenanceRequest;
use Illuminate\Support\Facades\DB;

class DeleteMaintenanceAction
{
    public function handle(MaintenanceRequest $maintenance): void
    {
        DB::transaction(function () use ($maintenance) {
            $maintenance->delete();
        });
    }
}

<?php

namespace App\Domains\Maintenance\Services;

use App\Domains\Maintenance\Enums\MaintenanceStatus;
use App\Domains\Maintenance\Models\MaintenanceRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class MaintenanceService
{
    public function getMaintenances(int $perPage = 15): LengthAwarePaginator
    {
        return MaintenanceRequest::with(['unit.property', 'tenant'])
            ->latest()
            ->paginate($perPage);
    }

    public function getMaintenanceById(int $id): ?MaintenanceRequest
    {
        return MaintenanceRequest::with(['unit.property', 'tenant'])->find($id);
    }

    /**
     * @return array<string, int>
     */
    public function getStats(): array
    {
        return [
            'total' => MaintenanceRequest::count(),
            'open' => MaintenanceRequest::where('status', MaintenanceStatus::Open)->count(),
            'in_progress' => MaintenanceRequest::where('status', MaintenanceStatus::InProgress)->count(),
            'completed' => MaintenanceRequest::where('status', MaintenanceStatus::Completed)->count(),
        ];
    }
}

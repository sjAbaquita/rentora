<?php

namespace App\Domains\Tenant\Services;

use App\Domains\Tenant\Models\Tenant;
use Illuminate\Pagination\LengthAwarePaginator;

class TenantService
{
    public function getTenants(int $perPage = 15): LengthAwarePaginator
    {
        return Tenant::withCount(['leases', 'payments'])->latest()->paginate($perPage);
    }

    public function getTenantById(int $id): ?Tenant
    {
        return Tenant::with(['leases.unit.property', 'payments'])->find($id);
    }

    /**
     * @return array<string, int>
     */
    public function getStats(): array
    {
        return [
            'total' => Tenant::count(),
            'active' => Tenant::whereHas('leases', function ($q): void {
                $q->where('status', 'active');
            })->count(),
        ];
    }
}
